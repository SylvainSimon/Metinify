<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LogAchats
 *
 * @ORM\Table(name="site.log_achats")
 * @ORM\Entity(repositoryClass="Site\Repository\LogAchatsRepository")
 */
class LogAchats {

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
     * @var integer
     *
     * @ORM\Column(name="vnum_item", type="integer", nullable=true)
     */
    private $vnumItem;

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
     * @var string
     *
     * @ORM\Column(name="monnaie", type="string", length=50, nullable=true)
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
     * @return LogAchats
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
     * @return LogAchats
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
     * Set vnumItem
     *
     * @param integer $vnumItem
     *
     * @return LogAchats
     */
    public function setVnumItem($vnumItem) {
        $this->vnumItem = $vnumItem;

        return $this;
    }

    /**
     * Get vnumItem
     *
     * @return integer
     */
    public function getVnumItem() {
        return $this->vnumItem;
    }

    /**
     * Set item
     *
     * @param string $item
     *
     * @return LogAchats
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
     * @return LogAchats
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
     * @return LogAchats
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
     * @return LogAchats
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
     * @return LogAchats
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
     * @return LogAchats
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
     * @param string $monnaie
     *
     * @return LogAchats
     */
    public function setMonnaie($monnaie) {
        $this->monnaie = $monnaie;

        return $this;
    }

    /**
     * Get monnaie
     *
     * @return string
     */
    public function getMonnaie() {
        return $this->monnaie;
    }

}
