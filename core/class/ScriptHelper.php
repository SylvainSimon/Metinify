<?php

class ScriptHelper extends CoreHelper {

    public $template;
    public $arrayTemplate = array();
    public $strTemplate = null;
    public $isScript = true;

    public function __construct() {

        parent::__construct();
        
        //Chargement du template//
        if ($this->strTemplate !== null) {
            $this->template = $this->objTwig->loadTemplate($this->strTemplate);
        }
        
    }

}
