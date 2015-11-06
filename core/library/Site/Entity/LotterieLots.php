<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LotterieLots
 *
 * @ORM\Table(name="site.lotterie_lots")
 * @ORM\Entity
 */
class LotterieLots {

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
     * @ORM\Column(name="nom_item", type="string", length=40, nullable=true)
     */
    private $nomItem;

    /**
     * @var integer
     *
     * @ORM\Column(name="vnum", type="integer", nullable=true)
     */
    private $vnum;

    /**
     * @var integer
     *
     * @ORM\Column(name="count", type="integer", nullable=true)
     */
    private $count;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer", nullable=true)
     */
    private $type;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nomItem
     *
     * @param string $nomItem
     *
     * @return LotterieLots
     */
    public function setNomItem($nomItem) {
        $this->nomItem = $nomItem;

        return $this;
    }

    /**
     * Get nomItem
     *
     * @return string
     */
    public function getNomItem() {
        return $this->nomItem;
    }

    /**
     * Set vnum
     *
     * @param integer $vnum
     *
     * @return LotterieLots
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
     * Set count
     *
     * @param integer $count
     *
     * @return LotterieLots
     */
    public function setCount($count) {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return integer
     */
    public function getCount() {
        return $this->count;
    }

    /**
     * Set type
     *
     * @param integer $type
     *
     * @return LotterieLots
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

}
