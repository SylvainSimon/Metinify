<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AdministrationPannelJetons
 *
 * @ORM\Table(name="site.administration_pannel_jetons")
 * @ORM\Entity
 */
class AdministrationPannelJetons {

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
     * @ORM\Column(name="jeton", type="bigint", nullable=true)
     */
    private $jeton;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=255, nullable=true)
     */
    private $ip;

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
     * @return AdministrationPannelJetons
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
     * Set jeton
     *
     * @param integer $jeton
     *
     * @return AdministrationPannelJetons
     */
    public function setJeton($jeton) {
        $this->jeton = $jeton;

        return $this;
    }

    /**
     * Get jeton
     *
     * @return integer
     */
    public function getJeton() {
        return $this->jeton;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return AdministrationPannelJetons
     */
    public function setDate($date) {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * Set ip
     *
     * @param string $ip
     *
     * @return AdministrationPannelJetons
     */
    public function setIp($ip) {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp() {
        return $this->ip;
    }

}
