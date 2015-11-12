<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Itemshop
 *
 * @ORM\Table(name="site.itemshop")
 * @ORM\Entity(repositoryClass="Site\Repository\ItemshopRepository")
 */
class Itemshop {

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
     * @ORM\Column(name="id_item", type="integer", nullable=true)
     */
    private $idItem;

    /**
     * @var string
     *
     * @ORM\Column(name="name_item", type="string", length=200, nullable=true)
     */
    private $nameItem;

    /**
     * @var string
     *
     * @ORM\Column(name="info_item", type="string", length=255, nullable=true)
     */
    private $infoItem;

    /**
     * @var string
     *
     * @ORM\Column(name="full_description", type="text", length=65535, nullable=true)
     */
    private $fullDescription;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_item", type="smallint", nullable=true)
     */
    private $nbItem;

    /**
     * @var integer
     *
     * @ORM\Column(name="prix", type="smallint", nullable=true)
     */
    private $prix;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="smallint", nullable=true)
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="cat", type="smallint", nullable=true)
     */
    private $cat;

    /**
     * @var boolean
     *
     * @ORM\Column(name="actif", type="boolean", nullable=true)
     */
    private $actif = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="ordre", type="integer", nullable=true)
     */
    private $ordre;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set idItem
     *
     * @param integer $idItem
     *
     * @return Itemshop
     */
    public function setIdItem($idItem) {
        $this->idItem = $idItem;

        return $this;
    }

    /**
     * Get idItem
     *
     * @return integer
     */
    public function getIdItem() {
        return $this->idItem;
    }

    /**
     * Set nameItem
     *
     * @param string $nameItem
     *
     * @return Itemshop
     */
    public function setNameItem($nameItem) {
        $this->nameItem = $nameItem;

        return $this;
    }

    /**
     * Get nameItem
     *
     * @return string
     */
    public function getNameItem() {
        return $this->nameItem;
    }

    /**
     * Set infoItem
     *
     * @param string $infoItem
     *
     * @return Itemshop
     */
    public function setInfoItem($infoItem) {
        $this->infoItem = $infoItem;

        return $this;
    }

    /**
     * Get infoItem
     *
     * @return string
     */
    public function getInfoItem() {
        return $this->infoItem;
    }

    /**
     * Set fullDescription
     *
     * @param string $fullDescription
     *
     * @return Itemshop
     */
    public function setFullDescription($fullDescription) {
        $this->fullDescription = $fullDescription;

        return $this;
    }

    /**
     * Get fullDescription
     *
     * @return string
     */
    public function getFullDescription() {
        return $this->fullDescription;
    }

    /**
     * Set nbItem
     *
     * @param integer $nbItem
     *
     * @return Itemshop
     */
    public function setNbItem($nbItem) {
        $this->nbItem = $nbItem;

        return $this;
    }

    /**
     * Get nbItem
     *
     * @return integer
     */
    public function getNbItem() {
        return $this->nbItem;
    }

    /**
     * Set prix
     *
     * @param integer $prix
     *
     * @return Itemshop
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
     * Set type
     *
     * @param integer $type
     *
     * @return Itemshop
     */
    public function setType($type) {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Set cat
     *
     * @param integer $cat
     *
     * @return Itemshop
     */
    public function setCat($cat) {
        $this->cat = $cat;

        return $this;
    }

    /**
     * Get cat
     *
     * @return integer
     */
    public function getCat() {
        return $this->cat;
    }

    /**
     * Set actif
     *
     * @param boolean $actif
     *
     * @return Itemshop
     */
    public function setActif($actif) {
        $this->actif = $actif;

        return $this;
    }

    /**
     * Get actif
     *
     * @return boolean
     */
    public function getActif() {
        return $this->actif;
    }

    /**
     * Set ordre
     *
     * @param integer $ordre
     *
     * @return Itemshop
     */
    public function setOrdre($ordre) {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * Get ordre
     *
     * @return integer
     */
    public function getOrdre() {
        return $this->ordre;
    }

}
