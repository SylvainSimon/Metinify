<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LogsMarcheAchats
 *
 * @ORM\Table(name="site.logs_marche_achats")
 * @ORM\Entity
 */
class LogsMarcheAchats {

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
     * @ORM\Column(name="id_vendeur", type="integer", nullable=true)
     */
    private $idVendeur;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_acheteur", type="integer", nullable=true)
     */
    private $idAcheteur;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_personnage", type="integer", nullable=true)
     */
    private $idPersonnage;

    /**
     * @var integer
     *
     * @ORM\Column(name="prix", type="integer", nullable=true)
     */
    private $prix;

    /**
     * @var integer
     *
     * @ORM\Column(name="devise", type="integer", nullable=true)
     */
    private $devise;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=50, nullable=true)
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
     * Set idVendeur
     *
     * @param integer $idVendeur
     *
     * @return LogsMarcheAchats
     */
    public function setIdVendeur($idVendeur) {
        $this->idVendeur = $idVendeur;

        return $this;
    }

    /**
     * Get idVendeur
     *
     * @return integer
     */
    public function getIdVendeur() {
        return $this->idVendeur;
    }

    /**
     * Set idAcheteur
     *
     * @param integer $idAcheteur
     *
     * @return LogsMarcheAchats
     */
    public function setIdAcheteur($idAcheteur) {
        $this->idAcheteur = $idAcheteur;

        return $this;
    }

    /**
     * Get idAcheteur
     *
     * @return integer
     */
    public function getIdAcheteur() {
        return $this->idAcheteur;
    }

    /**
     * Set idPersonnage
     *
     * @param integer $idPersonnage
     *
     * @return LogsMarcheAchats
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
     * Set prix
     *
     * @param integer $prix
     *
     * @return LogsMarcheAchats
     */
    public function setPrix($prix) {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return integer
     */
    public function getPrix() {
        return $this->prix;
    }

    /**
     * Set devise
     *
     * @param integer $devise
     *
     * @return LogsMarcheAchats
     */
    public function setDevise($devise) {
        $this->devise = $devise;

        return $this;
    }

    /**
     * Get devise
     *
     * @return integer
     */
    public function getDevise() {
        return $this->devise;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return LogsMarcheAchats
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
     * @return LogsMarcheAchats
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
