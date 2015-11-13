<?php

class reCaptchaVerify {

    public function run() {
        
        $return = [
            "granted" => false,
            "error" => ""
        ];

        $googleResponse = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfT8xATAAAAAMidtkQuBLpv4xhy7o4ADW-GL7Yk&response=" . $_POST["reCaptchaVerify"]);
        $googleResponseArray = (array) json_decode($googleResponse);

        if ($googleResponseArray["success"]) {
            $return["granted"] = $googleResponseArray["success"];
        }

        if (isset($googleResponseArray["error-codes"])) {

            if (count($googleResponseArray["error-codes"]) > 0) {

                foreach ($googleResponseArray["error-codes"] AS $errorCode) {
                    
                    switch ($errorCode) {
                        case "invalid-input-response":
                            $return["error"] .= "La vérification anti-robot à échoué.<br/>";
                            break;
                        case "missing-input-response":
                            $return["error"] .= "La vérification anti-robot n'a pas été faite.<br/>";
                            break;
                    }
                }
            }
        }
        
        echo json_encode($return);
    }

}

$class = new reCaptchaVerify();
$class->run();
