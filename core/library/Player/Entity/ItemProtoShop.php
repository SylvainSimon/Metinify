<?php

namespace Player\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ItemProtoShop
 *
 * @ORM\Table(name="player.item_proto_shop")
 * @ORM\Entity
 */
class ItemProtoShop
{
    /**
     * @var string
     *
     * @ORM\Column(name="prices", type="string", length=255, nullable=true)
     */
    private $prices;

    /**
     * @var string
     *
     * @ORM\Column(name="img", type="string", length=255, nullable=true)
     */
    private $img;

    /**
     * @var string
     *
     * @ORM\Column(name="shop_class", type="string", length=255, nullable=true)
     */
    private $shopClass;

    /**
     * @var integer
     *
     * @ORM\Column(name="classid", type="integer", nullable=true)
     */
    private $classid;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", length=65535, nullable=true)
     */
    private $content;

    /**
     * @var integer
     *
     * @ORM\Column(name="count", type="integer", nullable=true)
     */
    private $count = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="vnum", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $vnum;



    /**
     * Set prices
     *
     * @param string $prices
     *
     * @return ItemProtoShop
     */
    public function setPrices($prices)
    {
        $this->prices = $prices;

        return $this;
    }

    /**
     * Get prices
     *
     * @return string
     */
    public function getPrices()
    {
        return $this->prices;
    }

    /**
     * Set img
     *
     * @param string $img
     *
     * @return ItemProtoShop
     */
    public function setImg($img)
    {
        $this->img = $img;

        return $this;
    }

    /**
     * Get img
     *
     * @return string
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * Set shopClass
     *
     * @param string $shopClass
     *
     * @return ItemProtoShop
     */
    public function setShopClass($shopClass)
    {
        $this->shopClass = $shopClass;

        return $this;
    }

    /**
     * Get shopClass
     *
     * @return string
     */
    public function getShopClass()
    {
        return $this->shopClass;
    }

    /**
     * Set classid
     *
     * @param integer $classid
     *
     * @return ItemProtoShop
     */
    public function setClassid($classid)
    {
        $this->classid = $classid;

        return $this;
    }

    /**
     * Get classid
     *
     * @return integer
     */
    public function getClassid()
    {
        return $this->classid;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return ItemProtoShop
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set count
     *
     * @param integer $count
     *
     * @return ItemProtoShop
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return integer
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Get vnum
     *
     * @return integer
     */
    public function getVnum()
    {
        return $this->vnum;
    }
}
