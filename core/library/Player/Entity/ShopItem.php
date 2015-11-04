<?php

namespace Player\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShopItem
 *
 * @ORM\Table(name="player.shop_item", uniqueConstraints={@ORM\UniqueConstraint(name="vnum_unique", columns={"shop_vnum", "item_vnum", "count"})})
 * @ORM\Entity
 */
class ShopItem
{
    /**
     * @var integer
     *
     * @ORM\Column(name="shop_vnum", type="integer", nullable=false)
     */
    private $shopVnum = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="item_vnum", type="integer", nullable=false)
     */
    private $itemVnum = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="count", type="boolean", nullable=false)
     */
    private $count = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set shopVnum
     *
     * @param integer $shopVnum
     *
     * @return ShopItem
     */
    public function setShopVnum($shopVnum)
    {
        $this->shopVnum = $shopVnum;

        return $this;
    }

    /**
     * Get shopVnum
     *
     * @return integer
     */
    public function getShopVnum()
    {
        return $this->shopVnum;
    }

    /**
     * Set itemVnum
     *
     * @param integer $itemVnum
     *
     * @return ShopItem
     */
    public function setItemVnum($itemVnum)
    {
        $this->itemVnum = $itemVnum;

        return $this;
    }

    /**
     * Get itemVnum
     *
     * @return integer
     */
    public function getItemVnum()
    {
        return $this->itemVnum;
    }

    /**
     * Set count
     *
     * @param boolean $count
     *
     * @return ShopItem
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return boolean
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
