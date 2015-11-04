<?php

namespace Player\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MyshopPricelist
 *
 * @ORM\Table(name="player.myshop_pricelist", uniqueConstraints={@ORM\UniqueConstraint(name="list_id", columns={"owner_id", "item_vnum"})})
 * @ORM\Entity
 */
class MyshopPricelist
{
    /**
     * @var integer
     *
     * @ORM\Column(name="item_vnum", type="integer", nullable=false)
     */
    private $itemVnum = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="price", type="integer", nullable=false)
     */
    private $price = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="owner_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $ownerId;



    /**
     * Set itemVnum
     *
     * @param integer $itemVnum
     *
     * @return MyshopPricelist
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
     * Set price
     *
     * @param integer $price
     *
     * @return MyshopPricelist
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Get ownerId
     *
     * @return integer
     */
    public function getOwnerId()
    {
        return $this->ownerId;
    }
}
