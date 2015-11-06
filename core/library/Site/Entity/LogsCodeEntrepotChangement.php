<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LogsCodeEntrepotChangement
 *
 * @ORM\Table(name="site.logs_code_entrepot_changement")
 * @ORM\Entity
 */
class LogsCodeEntrepotChangement {

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
     * @var string
     *
     * @ORM\Column(name="compte", type="string", length=20, nullable=true)
     */
    private $compte;

    /**
     * @var string
     *
     * @ORM\Column(name="ancien_code", type="string", length=8, nullable=true)
     */
    private $ancienCode;

    /**
     * @var string
     *
     * @ORM\Column(name="nouveau_code", type="string", length=8, nullable=true)
     */
    private $nouveauCode;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=15, nullable=true)
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
     * @return LogsCodeEntrepotChangement
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
     * Set compte
     *
     * @param string $compte
     *
     * @return LogsCodeEntrepotChangement
     */
    public function setCompte($compte) {
        $this->compte = $compte;

        return $this;
    }

    /**
     * Get compte
     *
     * @return string
     */
    public function getCompte() {
        return $this->compte;
    }

    /**
     * Set ancienCode
     *
     * @param string $ancienCode
     *
     * @return LogsCodeEntrepotChangement
     */
    public function setAncienCode($ancienCode) {
        $this->ancienCode = $ancienCode;

        return $this;
    }

    /**
     * Get ancienCode
     *
     * @return string
     */
    public function getAncienCode() {
        return $this->ancienCode;
    }

    /**
     * Set nouveauCode
     *
     * @param string $nouveauCode
     *
     * @return LogsCodeEntrepotChangement
     */
    public function setNouveauCode($nouveauCode) {
        $this->nouveauCode = $nouveauCode;

        return $this;
    }

    /**
     * Get nouveauCode
     *
     * @return string
     */
    public function getNouveauCode() {
        return $this->nouveauCode;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return LogsCodeEntrepotChangement
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
     * @return LogsCodeEntrepotChangement
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
