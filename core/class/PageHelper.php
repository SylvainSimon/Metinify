<?php

use Symfony\Component\HttpFoundation\Response;

class PageHelper extends CoreHelper {

    public $template;
    public $arrayTemplate = array();
    public $response;
    public $strTemplate = null;

    public function __construct() {

        parent::__construct();
        
        if ($this->strTemplate !== null) {
            $this->template = $this->objTwig->loadTemplate($this->strTemplate);
        }
        
        $this->response = new Response();
    }

}
