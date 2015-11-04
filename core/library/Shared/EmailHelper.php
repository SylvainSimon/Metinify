<?php

class EmailHelper {

    protected $dateTimeNow = null;

    public static function getTransport() {

        global $config;

        $transport = Swift_SmtpTransport::newInstance($config->objInstance->smtpHost, $config->objInstance->smtpPort);
        $transport->setUsername($config->objInstance->smtpUser);
        $transport->setPassword($config->objInstance->smtpPassword);

        return $transport;
    }

    public static function getMailer() {
        $mailer = Swift_Mailer::newInstance(self::getTransport());
        return $mailer;
    }

    public static function sendEmail($receiver, $obj = "Aucun objet", $content = "", $urlFile = "", $nameFile = "") {

        global $config;

        $message = Swift_Message::newInstance();

        $message->setSubject($obj);
        $message->setFrom($config->objInstance->smtpSender);
        $message->setTo($receiver);

        $message->setBody($content);

        if ($urlFile !== "") {
            $message->attach(Swift_Attachment::fromPath($urlFile)->setFilename($nameFile));
        }
        
        $mailer = self::getMailer();
        $mailer->send($message);
    }

}

