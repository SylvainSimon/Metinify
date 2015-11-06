<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SuppressionPersonnage
 *
 * @ORM\Table(name="site.suppression_personnage")
 * @ORM\Entity
 */
class SuppressionPersonnage {

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
     * @ORM\Column(name="id_personnage", type="integer", nullable=true)
     */
    private $idPersonnage;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=true)
     */
    private $email;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero_verif", type="integer", nullable=true)
     */
    private $numeroVerif;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=20, nullable=true)
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
     * @return SuppressionPersonnage
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
     * Set idPersonnage
     *
     * @param integer $idPersonnage
     *
     * @return SuppressionPersonnage
     */
    public function setIdPersonnage($idPersonnage) {
        $this->idPersonnage = $idPersonnage;

        return $this;
    }

    /**
     * Get idPersonnage
     *
     * @return integer
     */
    public function getIdPersonnage() {
        return $this->idPersonnage;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return SuppressionPersonnage
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set numeroVerif
     *
     * @param integer $numeroVerif
     *
     * @return SuppressionPersonnage
     */
    public function setNumeroVerif($numeroVerif) {
        $this->numeroVerif = $numeroVerif;

        return $this;
    }

    /**
     * Get numeroVerif
     *
     * @return integer
     */
    public function getNumeroVerif() {
        return $this->numeroVerif;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return SuppressionPersonnage
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
     * @return SuppressionPersonnage
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
