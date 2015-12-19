<?php

namespace Includes;

require __DIR__ . '../../../../../core/initialize.php';

class payement extends \PageHelper {

    public function run() {

        global $request;
        global $config;
        global $session;
        $em = \Shared\DoctrineHelper::getEntityManager();
        $paymentResult = false;

        // Script to create a signature
        define('API_BASE_URL', $config["item_shop"]["rechargement"]["hipay"]["apiBaseUrl"]);
        define('API_KEY', $config["item_shop"]["rechargement"]["hipay"]["apiKey"]);
        define('API_SECRET_KEY', $config["item_shop"]["rechargement"]["hipay"]["apiSecretKey"]);
        define('API_HASH_FUNCTION', 'sha1');
        date_default_timezone_set('UTC');

        // STEPS 1 and 2: Construction of query parameters
        $queryParameters = array(
            'site_id' => $config["item_shop"]["rechargement"]["hipay"]["siteId"],
            'product_id' => $config["item_shop"]["rechargement"]["hipay"]["productId"],
            'api_key' => API_KEY,
            'api_hash' => API_HASH_FUNCTION,
            'api_ts' => time(),
            'format' => "json"
        );

        // STEP 3 : Sort parameters by ascending alphabetical order by name ofparameter
        ksort($queryParameters);

        /* STEP 4
         * Prepare a string to hash with the hash function "API_HASH_FUNCTION"
         */
        $stringToHash = '';
        foreach ($queryParameters as $parameter => $value) {
            $stringToHash .= $parameter . (is_array($value) ? implode('', $value) :
                            $value);
        }
        $stringToHash .= API_SECRET_KEY;

        // STEP 5: Creation of signature
        $signature = hash(API_HASH_FUNCTION, $stringToHash);

        // STEP 6 : Generating URL
        $queryParameters['api_sig'] = $signature;
        $url = API_BASE_URL . '/onetime/pricing?' . http_build_query($queryParameters);
        \Debug::log(time());

        $data = file_get_contents($url);
        $dataDecode = json_decode($data);
        
        foreach ($dataDecode->response as $response) {
            if ($response->code == 0 and $response->message == "OK") {
                $paymentResult = true;
                $codeResult = "Réussi";
            }
        }

        $objAccount = \Account\AccountHelper::getAccountRepository()->find($request->query->get("data"));
        
        if ($paymentResult) {

            $codeResult = "Réussi";

            if ($config["item_shop"]["rechargement"]["hipay"]["devise"] == \DeviseHelper::CASH) {
                $objAccount->setCash($objAccount->getCash() + $config["item_shop"]["rechargement"]["hipay"]["cash"]);
            } else if ($config["item_shop"]["rechargement"]["hipay"]["devise"] == \DeviseHelper::MILEAGE) {
                $objAccount->setMileage($objAccount->getMileage() + $config["item_shop"]["rechargement"]["hipay"]["cash"]);
            }
            $em->persist($objAccount);

            $session->set("Cash", $objAccount->getCash());
            $session->set("TanaNaies", $objAccount->getMileage());

            $objLogsRechargement = new \Site\Entity\LogsRechargements();
            $objLogsRechargement->setIdCompte($objAccount->getId());
            $objLogsRechargement->setCompte($objAccount->getLogin());
            $objLogsRechargement->setEmailCompte($objAccount->getEmail());
            $objLogsRechargement->setCode($request->query->get("RECALL"));
            $objLogsRechargement->setNombreVamonaies($config["item_shop"]["rechargement"]["hipay"]["cash"]);
            $objLogsRechargement->setResultat($codeResult);
            $objLogsRechargement->setDate(new \DateTime(date("Y-m-d H:i:s")));
            $objLogsRechargement->setIp($this->ipAdresse);
            $em->persist($objLogsRechargement);
            $em->flush();
            
            $template = $this->objTwig->loadTemplate("emailItemShopRechargement.html5.twig");
            $result = $template->render([
                "compte" => $objAccount->getLogin(),
                "system" => "Hipay",
                "nombre" => $config["item_shop"]["rechargement"]["hipay"]["cash"],
                "devise" => $config["item_shop"]["rechargement"]["hipay"]["devise"],
                "identifiantRechargement" => $objLogsRechargement->getId()
            ]);
            $subject = 'VamosMT2 - Rechargement de compte';
            \EmailHelper::sendEmail($objAccount->getEmail(), $subject, $result);

            if ($this->isConnected) {
                header('Location: ../../ItemShopRechargementTerm.php?result=1&id=' . $objLogsRechargement->getId() . '&isConnected=1');
                exit;
            } else {
                header('Location: ../../ItemShopRechargementTerm.php?result=1&id=' . $objLogsRechargement->getId() . '&isConnected=0');
                exit;
            }
        } else {

            $codeResult = "Mauvaise clès";

            $objLogsRechargement = new \Site\Entity\LogsRechargements();
            $objLogsRechargement->setIdCompte($objAccount->getId());
            $objLogsRechargement->setCompte($objAccount->getLogin());
            $objLogsRechargement->setEmailCompte($objAccount->getEmail());
            $objLogsRechargement->setCode($request->query->get("RECALL"));
            $objLogsRechargement->setResultat($codeResult);
            $objLogsRechargement->setDate(new \DateTime(date("Y-m-d H:i:s")));
            $objLogsRechargement->setIp($this->ipAdresse);
            $em->persist($objLogsRechargement);

            $em->flush();

            header('Location: ../../ItemShopRechargementTerm.php?result=0&Raison=ClesMauvaise&id=' . $objLogsRechargement->getId() . '');
            exit;
        }
    }

}

$class = new payement();
$class->run();
