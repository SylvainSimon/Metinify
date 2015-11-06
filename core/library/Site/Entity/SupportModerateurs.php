<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SupportModerateurs
 *
 * @ORM\Table(name="site.support_moderateurs")
 * @ORM\Entity
 */
class SupportModerateurs {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_compte", type="integer", nullable=true)
     */
    private $idCompte;

    /**
     * @var integer
     *
     * @ORM\Column(name="support_ticket", type="integer", nullable=true)
     */
    private $supportTicket;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set idCompte
     *
     * @param integer $idCompte
     *
     * @return SupportModerateurs
     */
    public function setIdCompte($idCompte) {
        $this->idCompte = $idCompte;

        return $this;
    }

    /**
     * Get idCompte
     *
     * @return integer
     */
    public function getIdCompte() {
        return $this->idCompte;
    }

    /**
     * Set supportTicket
     *
     * @param integer $supportTicket
     *
     * @return SupportModerateurs
     */
    public function setSupportTicket($supportTicket) {
        $this->supportTicket = $supportTicket;

        return $this;
    }

    /**
     * Get supportTicket
     *
     * @return integer
     */
    public function getSupportTicket() {
        return $this->supportTicket;
    }

}
