<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SupportTicketObjets
 *
 * @ORM\Table(name="site.support_ticket_objets")
 * @ORM\Entity
 */
class SupportTicketObjets {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="objets", type="string", length=50, nullable=true)
     */
    private $objets;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set objets
     *
     * @param string $objets
     *
     * @return SupportTicketObjets
     */
    public function setObjets($objets) {
        $this->objets = $objets;

        return $this;
    }

    /**
     * Get objets
     *
     * @return string
     */
    public function getObjets() {
        return $this->objets;
    }

}
