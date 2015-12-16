<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LogsItemshopAchats
 *
 * @ORM\Table(name="site.logs_itemshop_achats")
 * @ORM\Entity(repositoryClass="Site\Repository\LogsItemshopAchatsRepository")
 */
class LogsItemshopAchats {

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
     * @ORM\Column(name="vnum", type="integer", nullable=true)
     */
    private $vnum;

    /**
     * @var string
     *
     * @ORM\Column(name="item", type="string", length=50, nullable=true)
     */
    private $item;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantite", type="integer", nullable=true)
     */
    private $quantite;

    /**
     * @var integer
     *
     * @ORM\Column(name="prix", type="integer", nullable=true)
     */
    private $prix;

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
     * @var string
     *
     * @ORM\Column(name="resultat", type="string", length=50, nullable=true)
     */
    private $resultat;

    /**
     * @var integer
     *
     * @ORM\Column(name="monnaie", type="integer", length=50, nullable=true)
     */
    private $monnaie;

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
     * @return LogsItemshopAchats
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
     * Set vnum
     *
     * @param integer $vnum
     *
     * @return LogsItemshopAchats
     */
    public function setVnum($vnum) {
        $this->vnum = $vnum;

        return $this;
    }

    /**
     * Get vnum
     *
     * @return integer
     */
    public function getVnum() {
        return $this->vnum;
    }

    /**
     * Set item
     *
     * @param string $item
     *
     * @return LogsItemshopAchats
     */
    public function setItem($item) {
        $this->item = $item;

        return $this;
    }

    /**
     * Get item
     *
     * @return string
     */
    public function getItem() {
        return $this->item;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return LogsItemshopAchats
     */
    public function setQuantite($quantite) {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return integer
     */
    public function getQuantite() {
        return $this->quantite;
    }

    /**
     * Set prix
     *
     * @param integer $prix
     *
     * @return LogsItemshopAchats
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return LogsItemshopAchats
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
     * @return LogsItemshopAchats
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

    /**
     * Set resultat
     *
     * @param string $resultat
     *
     * @return LogsItemshopAchats
     */
    public function setResultat($resultat) {
        $this->resultat = $resultat;

        return $this;
    }

    /**
     * Get resultat
     *
     * @return string
     */
    public function getResultat() {
        return $this->resultat;
    }

    /**
     * Set monnaie
     *
     * @param integer $monnaie
     *
     * @return LogsItemshopAchats
     */
    public function setMonnaie($monnaie) {
        $this->monnaie = $monnaie;

        return $this;
    }

    /**
     * Get monnaie
     *
     * @return integer
     */
    public function getMonnaie() {
        return $this->monnaie;
    }

}
