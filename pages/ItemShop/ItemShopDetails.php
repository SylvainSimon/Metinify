<?php

namespace Includes;

require __DIR__ . '../../../core/initialize.php';

class ItemShopDetails extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "ItemShopDetails.html5.twig";

    public function run() {
        
        global $request;
        $idItemshop = $request->query->get("id_recu");
        
        $objItemShop = \Site\SiteHelper::getItemshopRepository()->find($idItemshop);
        
        $this->arrayTemplate["objItemShop"] = $objItemShop;
        $this->arrayTemplate["imgItem"] = getimagesize("../../images/items/" . $objItemShop->getIdItem() . ".png");
        
        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new ItemShopDetails();
$class->run();
