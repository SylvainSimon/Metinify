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
        define('API_BASE_URL', 'https://api.allopass.com/rest');
        define('API_KEY', '2955bb0ffd36a187359fb3f51ecb7904');
        define('API_SECRET_KEY', 'ff014ce9b93f163b73660bf09f629bcf');
        define('API_HASH_FUNCTION', 'sha1');
        date_default_timezone_set('UTC');

        // STEPS 1 and 2: Construction of query parameters
        $queryParameters = array(
            'site_id' => 330033,
            'product_id' => 1449149,
            'api_key' => API_KEY,
            'api_hash' => API_HASH_FUNCTION,
            'api_ts' => time(),
            'format' => "json"
        );

        // STEP 3 : Sort parameters by ascending alphabetical order by name ofparameter
        ksort($queryParameters);

        /* STEP 4
         * Prepare a string to hash
         * with the hash function "API_HASH_FUNCTION"
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

        $data = file_get_contents($url);
        $dataDecode = json_decode($data);
        
        foreach ($dataDecode->response as $response) {
            if ($response->code == 0 and $response->message == "OK") {
                $paymentResult = true;
                $codeResult = "Réussi";
            }
        }
                
        /*
          if ($request->query->get("RECALL") !== null) {

          $RECALL = urlencode($_GET['RECALL']);
          $r = @file("http://payment.allopass.com/api/checkcode.apu?code=$RECALL&auth=227909/898935/4188626");
          if (substr($r[0], 0, 2) == "OK") {
          $paymentResult = true;
          } else {
          $codeResult = "Raté";
          }
          }
         */
        $objAccount = \Account\AccountHelper::getAccountRepository()->find($request->query->get("data"));

        if ($paymentResult) {

            $codeResult = "Réussi";

            $objAccount->setCash($objAccount->getCash() + $config->itemShopReloadCash);
            $em->persist($objAccount);

            $session->set("VamoNaies", $objAccount->getCash());

            $objLogsRechargement = new \Site\Entity\LogsRechargements();
            $objLogsRechargement->setIdCompte($objAccount->getId());
            $objLogsRechargement->setCompte($objAccount->getLogin());
            $objLogsRechargement->setEmailCompte($objAccount->getEmail());
            $objLogsRechargement->setCode($request->query->get("RECALL"));
            $objLogsRechargement->setNombreVamonaies($config->itemShopReloadCash);
            $objLogsRechargement->setResultat($codeResult);
            $objLogsRechargement->setDate(new \DateTime(date("Y-m-d H:i:s")));
            $objLogsRechargement->setIp($this->ipAdresse);
            $em->persist($objLogsRechargement);
            $em->flush();
                        
            if ($this->isConnected) {
                header('Location: ../../ItemShopRechargementTerm.php?Resultat=Reussi&id_compte=' . $request->query->get("data") . '&id=' . $objLogsRechargement->getId() . '&compteur=oui');
                exit;
            } else {
                header('Location: ../../ItemShopRechargementTerm.php?Resultat=Reussi&id_compte=' . $request->query->get("data") . '&id=' . $objLogsRechargement->getId() . '&compteur=non');
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

            header('Location: ../../ItemShopRechargementTerm.php?Resultat=Rate&Raison=ClesMauvaise&id_compte=' . $request->query->get("data") . '&id=' . $objLogsRechargement->getId() . '');
            exit;
        }
    }

}

$class = new payement();
$class->run();
