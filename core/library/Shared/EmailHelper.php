<?php

class EmailHelper {

    protected $dateTimeNow = null;

    public static function getTransport() {

        global $config;

        $transport = Swift_SmtpTransport::newInstance($config->smtpHost, $config->smtpPort);
        $transport->setUsername($config->smtpUser);
        $transport->setPassword($config->smtpPassword);

        return $transport;
    }

    public static function getMailer() {
        $mailer = Swift_Mailer::newInstance(self::getTransport());
        return $mailer;
    }

    public static function sendEmail($receiver, $obj = "Aucun objet", $content = "", $urlFile = "", $nameFile = "") {

        global $config;
        global $twig;

        $message = Swift_Message::newInstance();
        
        $template = $twig->loadTemplate("email_generique.html5.twig");
        $view = $template->render([
            "objEmail" => $obj,
            "messageEmail" => $content
        ]);

        $arrMatches = array();
        preg_match_all('/(src=|url\()"([^"]+\.(jpe?g|png|gif|bmp|tiff?|swf))"/Ui', $view, $arrMatches);

        foreach (array_unique($arrMatches[2]) as $url) {

            $src = rawurldecode($url); // see #3713

            if (!preg_match('@^https?://@', $src) && file_exists(BASE_ROOT . '/' . $src)) {
                $cid = $message->embed(Swift_EmbeddedFile::fromPath(BASE_ROOT . '/' . $src));
                $view = str_replace(array(
                    'src="' . $url . '"',
                    'url("' . $url . '"'), array(
                    'src="' . $cid . '"',
                    'url("' . $cid . '"'), $view);
            }
        }

        $message->setSubject($obj);
        $message->setFrom($config->smtpSender);
        $message->setReplyTo($config->smtpReplyTo);
        $message->setTo($receiver);

        $message->setBody($view, 'text/html');

        if ($urlFile !== "") {
            $message->attach(Swift_Attachment::fromPath($urlFile)->setFilename($nameFile));
        }

        $mailer = self::getMailer();
        $mailer->send($message);
    }

}
