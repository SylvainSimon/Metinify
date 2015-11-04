<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ItemProto
 *
 * @ORM\Table(name="item_proto")
 * @ORM\Entity
 */
class ItemProto
{
    /**
     * @var binary
     *
     * @ORM\Column(name="name", type="binary", nullable=false)
     */
    private $name = 'Noname                  ';

    /**
     * @var binary
     *
     * @ORM\Column(name="locale_name", type="binary", nullable=false)
     */
    private $localeName = 'Noname                  ';

    /**
     * @var boolean
     *
     * @ORM\Column(name="type", type="boolean", nullable=false)
     */
    private $type = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="subtype", type="boolean", nullable=false)
     */
    private $subtype = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="weight", type="boolean", nullable=true)
     */
    private $weight = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="size", type="boolean", nullable=true)
     */
    private $size = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="antiflag", type="integer", nullable=true)
     */
    private $antiflag = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="flag", type="integer", nullable=true)
     */
    private $flag = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="wearflag", type="integer", nullable=true)
     */
    private $wearflag = '0';

    /**
     * @var array
     *
     * @ORM\Column(name="immuneflag", type="simple_array", nullable=false)
     */
    private $immuneflag = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="gold", type="integer", nullable=true)
     */
    private $gold = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="shop_buy_price", type="integer", nullable=false)
     */
    private $shopBuyPrice = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="refined_vnum", type="integer", nullable=false)
     */
    private $refinedVnum = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="refine_set", type="smallint", nullable=false)
     */
    private $refineSet = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="refine_set2", type="smallint", nullable=false)
     */
    private $refineSet2 = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="magic_pct", type="boolean", nullable=false)
     */
    private $magicPct = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="limittype0", type="boolean", nullable=true)
     */
    private $limittype0 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="limitvalue0", type="integer", nullable=true)
     */
    private $limitvalue0 = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="limittype1", type="boolean", nullable=true)
     */
    private $limittype1 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="limitvalue1", type="integer", nullable=true)
     */
    private $limitvalue1 = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="applytype0", type="boolean", nullable=true)
     */
    private $applytype0 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="applyvalue0", type="integer", nullable=true)
     */
    private $applyvalue0 = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="applytype1", type="boolean", nullable=true)
     */
    private $applytype1 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="applyvalue1", type="integer", nullable=true)
     */
    private $applyvalue1 = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="applytype2", type="boolean", nullable=true)
     */
    private $applytype2 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="applyvalue2", type="integer", nullable=true)
     */
    private $applyvalue2 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="value0", type="integer", nullable=true)
     */
    private $value0 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="value1", type="integer", nullable=true)
     */
    private $value1 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="value2", type="integer", nullable=true)
     */
    private $value2 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="value3", type="integer", nullable=true)
     */
    private $value3 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="value4", type="integer", nullable=true)
     */
    private $value4 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="value5", type="integer", nullable=true)
     */
    private $value5 = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="socket0", type="boolean", nullable=true)
     */
    private $socket0 = '-1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="socket1", type="boolean", nullable=true)
     */
    private $socket1 = '-1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="socket2", type="boolean", nullable=true)
     */
    private $socket2 = '-1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="socket3", type="boolean", nullable=true)
     */
    private $socket3 = '-1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="socket4", type="boolean", nullable=true)
     */
    private $socket4 = '-1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="socket5", type="boolean", nullable=true)
     */
    private $socket5 = '-1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="specular", type="boolean", nullable=false)
     */
    private $specular = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="socket_pct", type="boolean", nullable=false)
     */
    private $socketPct = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="addon_type", type="smallint", nullable=false)
     */
    private $addonType = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="vnum", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $vnum;



    /**
     * Set name
     *
     * @param binary $name
     *
     * @return ItemProto
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return binary
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set localeName
     *
     * @param binary $localeName
     *
     * @return ItemProto
     */
    public function setLocaleName($localeName)
    {
        $this->localeName = $localeName;

        return $this;
    }

    /**
     * Get localeName
     *
     * @return binary
     */
    public function getLocaleName()
    {
        return $this->localeName;
    }

    /**
     * Set type
     *
     * @param boolean $type
     *
     * @return ItemProto
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return boolean
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set subtype
     *
     * @param boolean $subtype
     *
     * @return ItemProto
     */
    public function setSubtype($subtype)
    {
        $this->subtype = $subtype;

        return $this;
    }

    /**
     * Get subtype
     *
     * @return boolean
     */
    public function getSubtype()
    {
        return $this->subtype;
    }

    /**
     * Set weight
     *
     * @param boolean $weight
     *
     * @return ItemProto
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return boolean
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set size
     *
     * @param boolean $size
     *
     * @return ItemProto
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return boolean
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set antiflag
     *
     * @param integer $antiflag
     *
     * @return ItemProto
     */
    public function setAntiflag($antiflag)
    {
        $this->antiflag = $antiflag;

        return $this;
    }

    /**
     * Get antiflag
     *
     * @return integer
     */
    public function getAntiflag()
    {
        return $this->antiflag;
    }

    /**
     * Set flag
     *
     * @param integer $flag
     *
     * @return ItemProto
     */
    public function setFlag($flag)
    {
        $this->flag = $flag;

        return $this;
    }

    /**
     * Get flag
     *
     * @return integer
     */
    public function getFlag()
    {
        return $this->flag;
    }

    /**
     * Set wearflag
     *
     * @param integer $wearflag
     *
     * @return ItemProto
     */
    public function setWearflag($wearflag)
    {
        $this->wearflag = $wearflag;

        return $this;
    }

    /**
     * Get wearflag
     *
     * @return integer
     */
    public function getWearflag()
    {
        return $this->wearflag;
    }

    /**
     * Set immuneflag
     *
     * @param array $immuneflag
     *
     * @return ItemProto
     */
    public function setImmuneflag($immuneflag)
    {
        $this->immuneflag = $immuneflag;

        return $this;
    }

    /**
     * Get immuneflag
     *
     * @return array
     */
    public function getImmuneflag()
    {
        return $this->immuneflag;
    }

    /**
     * Set gold
     *
     * @param integer $gold
     *
     * @return ItemProto
     */
    public function setGold($gold)
    {
        $this->gold = $gold;

        return $this;
    }

    /**
     * Get gold
     *
     * @return integer
     */
    public function getGold()
    {
        return $this->gold;
    }

    /**
     * Set shopBuyPrice
     *
     * @param integer $shopBuyPrice
     *
     * @return ItemProto
     */
    public function setShopBuyPrice($shopBuyPrice)
    {
        $this->shopBuyPrice = $shopBuyPrice;

        return $this;
    }

    /**
     * Get shopBuyPrice
     *
     * @return integer
     */
    public function getShopBuyPrice()
    {
        return $this->shopBuyPrice;
    }

    /**
     * Set refinedVnum
     *
     * @param integer $refinedVnum
     *
     * @return ItemProto
     */
    public function setRefinedVnum($refinedVnum)
    {
        $this->refinedVnum = $refinedVnum;

        return $this;
    }

    /**
     * Get refinedVnum
     *
     * @return integer
     */
    public function getRefinedVnum()
    {
        return $this->refinedVnum;
    }

    /**
     * Set refineSet
     *
     * @param integer $refineSet
     *
     * @return ItemProto
     */
    public function setRefineSet($refineSet)
    {
        $this->refineSet = $refineSet;

        return $this;
    }

    /**
     * Get refineSet
     *
     * @return integer
     */
    public function getRefineSet()
    {
        return $this->refineSet;
    }

    /**
     * Set refineSet2
     *
     * @param integer $refineSet2
     *
     * @return ItemProto
     */
    public function setRefineSet2($refineSet2)
    {
        $this->refineSet2 = $refineSet2;

        return $this;
    }

    /**
     * Get refineSet2
     *
     * @return integer
     */
    public function getRefineSet2()
    {
        return $this->refineSet2;
    }

    /**
     * Set magicPct
     *
     * @param boolean $magicPct
     *
     * @return ItemProto
     */
    public function setMagicPct($magicPct)
    {
        $this->magicPct = $magicPct;

        return $this;
    }

    /**
     * Get magicPct
     *
     * @return boolean
     */
    public function getMagicPct()
    {
        return $this->magicPct;
    }

    /**
     * Set limittype0
     *
     * @param boolean $limittype0
     *
     * @return ItemProto
     */
    public function setLimittype0($limittype0)
    {
        $this->limittype0 = $limittype0;

        return $this;
    }

    /**
     * Get limittype0
     *
     * @return boolean
     */
    public function getLimittype0()
    {
        return $this->limittype0;
    }

    /**
     * Set limitvalue0
     *
     * @param integer $limitvalue0
     *
     * @return ItemProto
     */
    public function setLimitvalue0($limitvalue0)
    {
        $this->limitvalue0 = $limitvalue0;

        return $this;
    }

    /**
     * Get limitvalue0
     *
     * @return integer
     */
    public function getLimitvalue0()
    {
        return $this->limitvalue0;
    }

    /**
     * Set limittype1
     *
     * @param boolean $limittype1
     *
     * @return ItemProto
     */
    public function setLimittype1($limittype1)
    {
        $this->limittype1 = $limittype1;

        return $this;
    }

    /**
     * Get limittype1
     *
     * @return boolean
     */
    public function getLimittype1()
    {
        return $this->limittype1;
    }

    /**
     * Set limitvalue1
     *
     * @param integer $limitvalue1
     *
     * @return ItemProto
     */
    public function setLimitvalue1($limitvalue1)
    {
        $this->limitvalue1 = $limitvalue1;

        return $this;
    }

    /**
     * Get limitvalue1
     *
     * @return integer
     */
    public function getLimitvalue1()
    {
        return $this->limitvalue1;
    }

    /**
     * Set applytype0
     *
     * @param boolean $applytype0
     *
     * @return ItemProto
     */
    public function setApplytype0($applytype0)
    {
        $this->applytype0 = $applytype0;

        return $this;
    }

    /**
     * Get applytype0
     *
     * @return boolean
     */
    public function getApplytype0()
    {
        return $this->applytype0;
    }

    /**
     * Set applyvalue0
     *
     * @param integer $applyvalue0
     *
     * @return ItemProto
     */
    public function setApplyvalue0($applyvalue0)
    {
        $this->applyvalue0 = $applyvalue0;

        return $this;
    }

    /**
     * Get applyvalue0
     *
     * @return integer
     */
    public function getApplyvalue0()
    {
        return $this->applyvalue0;
    }

    /**
     * Set applytype1
     *
     * @param boolean $applytype1
     *
     * @return ItemProto
     */
    public function setApplytype1($applytype1)
    {
        $this->applytype1 = $applytype1;

        return $this;
    }

    /**
     * Get applytype1
     *
     * @return boolean
     */
    public function getApplytype1()
    {
        return $this->applytype1;
    }

    /**
     * Set applyvalue1
     *
     * @param integer $applyvalue1
     *
     * @return ItemProto
     */
    public function setApplyvalue1($applyvalue1)
    {
        $this->applyvalue1 = $applyvalue1;

        return $this;
    }

    /**
     * Get applyvalue1
     *
     * @return integer
     */
    public function getApplyvalue1()
    {
        return $this->applyvalue1;
    }

    /**
     * Set applytype2
     *
     * @param boolean $applytype2
     *
     * @return ItemProto
     */
    public function setApplytype2($applytype2)
    {
        $this->applytype2 = $applytype2;

        return $this;
    }

    /**
     * Get applytype2
     *
     * @return boolean
     */
    public function getApplytype2()
    {
        return $this->applytype2;
    }

    /**
     * Set applyvalue2
     *
     * @param integer $applyvalue2
     *
     * @return ItemProto
     */
    public function setApplyvalue2($applyvalue2)
    {
        $this->applyvalue2 = $applyvalue2;

        return $this;
    }

    /**
     * Get applyvalue2
     *
     * @return integer
     */
    public function getApplyvalue2()
    {
        return $this->applyvalue2;
    }

    /**
     * Set value0
     *
     * @param integer $value0
     *
     * @return ItemProto
     */
    public function setValue0($value0)
    {
        $this->value0 = $value0;

        return $this;
    }

    /**
     * Get value0
     *
     * @return integer
     */
    public function getValue0()
    {
        return $this->value0;
    }

    /**
     * Set value1
     *
     * @param integer $value1
     *
     * @return ItemProto
     */
    public function setValue1($value1)
    {
        $this->value1 = $value1;

        return $this;
    }

    /**
     * Get value1
     *
     * @return integer
     */
    public function getValue1()
    {
        return $this->value1;
    }

    /**
     * Set value2
     *
     * @param integer $value2
     *
     * @return ItemProto
     */
    public function setValue2($value2)
    {
        $this->value2 = $value2;

        return $this;
    }

    /**
     * Get value2
     *
     * @return integer
     */
    public function getValue2()
    {
        return $this->value2;
    }

    /**
     * Set value3
     *
     * @param integer $value3
     *
     * @return ItemProto
     */
    public function setValue3($value3)
    {
        $this->value3 = $value3;

        return $this;
    }

    /**
     * Get value3
     *
     * @return integer
     */
    public function getValue3()
    {
        return $this->value3;
    }

    /**
     * Set value4
     *
     * @param integer $value4
     *
     * @return ItemProto
     */
    public function setValue4($value4)
    {
        $this->value4 = $value4;

        return $this;
    }

    /**
     * Get value4
     *
     * @return integer
     */
    public function getValue4()
    {
        return $this->value4;
    }

    /**
     * Set value5
     *
     * @param integer $value5
     *
     * @return ItemProto
     */
    public function setValue5($value5)
    {
        $this->value5 = $value5;

        return $this;
    }

    /**
     * Get value5
     *
     * @return integer
     */
    public function getValue5()
    {
        return $this->value5;
    }

    /**
     * Set socket0
     *
     * @param boolean $socket0
     *
     * @return ItemProto
     */
    public function setSocket0($socket0)
    {
        $this->socket0 = $socket0;

        return $this;
    }

    /**
     * Get socket0
     *
     * @return boolean
     */
    public function getSocket0()
    {
        return $this->socket0;
    }

    /**
     * Set socket1
     *
     * @param boolean $socket1
     *
     * @return ItemProto
     */
    public function setSocket1($socket1)
    {
        $this->socket1 = $socket1;

        return $this;
    }

    /**
     * Get socket1
     *
     * @return boolean
     */
    public function getSocket1()
    {
        return $this->socket1;
    }

    /**
     * Set socket2
     *
     * @param boolean $socket2
     *
     * @return ItemProto
     */
    public function setSocket2($socket2)
    {
        $this->socket2 = $socket2;

        return $this;
    }

    /**
     * Get socket2
     *
     * @return boolean
     */
    public function getSocket2()
    {
        return $this->socket2;
    }

    /**
     * Set socket3
     *
     * @param boolean $socket3
     *
     * @return ItemProto
     */
    public function setSocket3($socket3)
    {
        $this->socket3 = $socket3;

        return $this;
    }

    /**
     * Get socket3
     *
     * @return boolean
     */
    public function getSocket3()
    {
        return $this->socket3;
    }

    /**
     * Set socket4
     *
     * @param boolean $socket4
     *
     * @return ItemProto
     */
    public function setSocket4($socket4)
    {
        $this->socket4 = $socket4;

        return $this;
    }

    /**
     * Get socket4
     *
     * @return boolean
     */
    public function getSocket4()
    {
        return $this->socket4;
    }

    /**
     * Set socket5
     *
     * @param boolean $socket5
     *
     * @return ItemProto
     */
    public function setSocket5($socket5)
    {
        $this->socket5 = $socket5;

        return $this;
    }

    /**
     * Get socket5
     *
     * @return boolean
     */
    public function getSocket5()
    {
        return $this->socket5;
    }

    /**
     * Set specular
     *
     * @param boolean $specular
     *
     * @return ItemProto
     */
    public function setSpecular($specular)
    {
        $this->specular = $specular;

        return $this;
    }

    /**
     * Get specular
     *
     * @return boolean
     */
    public function getSpecular()
    {
        return $this->specular;
    }

    /**
     * Set socketPct
     *
     * @param boolean $socketPct
     *
     * @return ItemProto
     */
    public function setSocketPct($socketPct)
    {
        $this->socketPct = $socketPct;

        return $this;
    }

    /**
     * Get socketPct
     *
     * @return boolean
     */
    public function getSocketPct()
    {
        return $this->socketPct;
    }

    /**
     * Set addonType
     *
     * @param integer $addonType
     *
     * @return ItemProto
     */
    public function setAddonType($addonType)
    {
        $this->addonType = $addonType;

        return $this;
    }

    /**
     * Get addonType
     *
     * @return integer
     */
    public function getAddonType()
    {
        return $this->addonType;
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
