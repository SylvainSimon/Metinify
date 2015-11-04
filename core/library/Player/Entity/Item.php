<?php

namespace Player\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Item
 *
 * @ORM\Table(name="player.item", indexes={@ORM\Index(name="owner_id_idx", columns={"owner_id"}), @ORM\Index(name="item_vnum_index", columns={"vnum"})})
 * @ORM\Entity
 */
class Item
{
    /**
     * @var integer
     *
     * @ORM\Column(name="owner_id", type="integer", nullable=false)
     */
    private $ownerId = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="window", type="string", nullable=false)
     */
    private $window = 'INVENTORY';

    /**
     * @var integer
     *
     * @ORM\Column(name="pos", type="smallint", nullable=false)
     */
    private $pos = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="count", type="boolean", nullable=false)
     */
    private $count = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="vnum", type="integer", nullable=false)
     */
    private $vnum = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="socket0", type="integer", nullable=false)
     */
    private $socket0 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="socket1", type="integer", nullable=false)
     */
    private $socket1 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="socket2", type="integer", nullable=false)
     */
    private $socket2 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="socket3", type="integer", nullable=false)
     */
    private $socket3 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="socket4", type="integer", nullable=false)
     */
    private $socket4 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="socket5", type="integer", nullable=false)
     */
    private $socket5 = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="attrtype0", type="boolean", nullable=false)
     */
    private $attrtype0 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="attrvalue0", type="smallint", nullable=false)
     */
    private $attrvalue0 = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="attrtype1", type="boolean", nullable=false)
     */
    private $attrtype1 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="attrvalue1", type="smallint", nullable=false)
     */
    private $attrvalue1 = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="attrtype2", type="boolean", nullable=false)
     */
    private $attrtype2 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="attrvalue2", type="smallint", nullable=false)
     */
    private $attrvalue2 = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="attrtype3", type="boolean", nullable=false)
     */
    private $attrtype3 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="attrvalue3", type="smallint", nullable=false)
     */
    private $attrvalue3 = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="attrtype4", type="boolean", nullable=false)
     */
    private $attrtype4 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="attrvalue4", type="smallint", nullable=false)
     */
    private $attrvalue4 = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="attrtype5", type="boolean", nullable=false)
     */
    private $attrtype5 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="attrvalue5", type="smallint", nullable=false)
     */
    private $attrvalue5 = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="attrtype6", type="boolean", nullable=false)
     */
    private $attrtype6 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="attrvalue6", type="smallint", nullable=false)
     */
    private $attrvalue6 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set ownerId
     *
     * @param integer $ownerId
     *
     * @return Item
     */
    public function setOwnerId($ownerId)
    {
        $this->ownerId = $ownerId;

        return $this;
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

    /**
     * Set window
     *
     * @param string $window
     *
     * @return Item
     */
    public function setWindow($window)
    {
        $this->window = $window;

        return $this;
    }

    /**
     * Get window
     *
     * @return string
     */
    public function getWindow()
    {
        return $this->window;
    }

    /**
     * Set pos
     *
     * @param integer $pos
     *
     * @return Item
     */
    public function setPos($pos)
    {
        $this->pos = $pos;

        return $this;
    }

    /**
     * Get pos
     *
     * @return integer
     */
    public function getPos()
    {
        return $this->pos;
    }

    /**
     * Set count
     *
     * @param boolean $count
     *
     * @return Item
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
     * Set vnum
     *
     * @param integer $vnum
     *
     * @return Item
     */
    public function setVnum($vnum)
    {
        $this->vnum = $vnum;

        return $this;
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

    /**
     * Set socket0
     *
     * @param integer $socket0
     *
     * @return Item
     */
    public function setSocket0($socket0)
    {
        $this->socket0 = $socket0;

        return $this;
    }

    /**
     * Get socket0
     *
     * @return integer
     */
    public function getSocket0()
    {
        return $this->socket0;
    }

    /**
     * Set socket1
     *
     * @param integer $socket1
     *
     * @return Item
     */
    public function setSocket1($socket1)
    {
        $this->socket1 = $socket1;

        return $this;
    }

    /**
     * Get socket1
     *
     * @return integer
     */
    public function getSocket1()
    {
        return $this->socket1;
    }

    /**
     * Set socket2
     *
     * @param integer $socket2
     *
     * @return Item
     */
    public function setSocket2($socket2)
    {
        $this->socket2 = $socket2;

        return $this;
    }

    /**
     * Get socket2
     *
     * @return integer
     */
    public function getSocket2()
    {
        return $this->socket2;
    }

    /**
     * Set socket3
     *
     * @param integer $socket3
     *
     * @return Item
     */
    public function setSocket3($socket3)
    {
        $this->socket3 = $socket3;

        return $this;
    }

    /**
     * Get socket3
     *
     * @return integer
     */
    public function getSocket3()
    {
        return $this->socket3;
    }

    /**
     * Set socket4
     *
     * @param integer $socket4
     *
     * @return Item
     */
    public function setSocket4($socket4)
    {
        $this->socket4 = $socket4;

        return $this;
    }

    /**
     * Get socket4
     *
     * @return integer
     */
    public function getSocket4()
    {
        return $this->socket4;
    }

    /**
     * Set socket5
     *
     * @param integer $socket5
     *
     * @return Item
     */
    public function setSocket5($socket5)
    {
        $this->socket5 = $socket5;

        return $this;
    }

    /**
     * Get socket5
     *
     * @return integer
     */
    public function getSocket5()
    {
        return $this->socket5;
    }

    /**
     * Set attrtype0
     *
     * @param boolean $attrtype0
     *
     * @return Item
     */
    public function setAttrtype0($attrtype0)
    {
        $this->attrtype0 = $attrtype0;

        return $this;
    }

    /**
     * Get attrtype0
     *
     * @return boolean
     */
    public function getAttrtype0()
    {
        return $this->attrtype0;
    }

    /**
     * Set attrvalue0
     *
     * @param integer $attrvalue0
     *
     * @return Item
     */
    public function setAttrvalue0($attrvalue0)
    {
        $this->attrvalue0 = $attrvalue0;

        return $this;
    }

    /**
     * Get attrvalue0
     *
     * @return integer
     */
    public function getAttrvalue0()
    {
        return $this->attrvalue0;
    }

    /**
     * Set attrtype1
     *
     * @param boolean $attrtype1
     *
     * @return Item
     */
    public function setAttrtype1($attrtype1)
    {
        $this->attrtype1 = $attrtype1;

        return $this;
    }

    /**
     * Get attrtype1
     *
     * @return boolean
     */
    public function getAttrtype1()
    {
        return $this->attrtype1;
    }

    /**
     * Set attrvalue1
     *
     * @param integer $attrvalue1
     *
     * @return Item
     */
    public function setAttrvalue1($attrvalue1)
    {
        $this->attrvalue1 = $attrvalue1;

        return $this;
    }

    /**
     * Get attrvalue1
     *
     * @return integer
     */
    public function getAttrvalue1()
    {
        return $this->attrvalue1;
    }

    /**
     * Set attrtype2
     *
     * @param boolean $attrtype2
     *
     * @return Item
     */
    public function setAttrtype2($attrtype2)
    {
        $this->attrtype2 = $attrtype2;

        return $this;
    }

    /**
     * Get attrtype2
     *
     * @return boolean
     */
    public function getAttrtype2()
    {
        return $this->attrtype2;
    }

    /**
     * Set attrvalue2
     *
     * @param integer $attrvalue2
     *
     * @return Item
     */
    public function setAttrvalue2($attrvalue2)
    {
        $this->attrvalue2 = $attrvalue2;

        return $this;
    }

    /**
     * Get attrvalue2
     *
     * @return integer
     */
    public function getAttrvalue2()
    {
        return $this->attrvalue2;
    }

    /**
     * Set attrtype3
     *
     * @param boolean $attrtype3
     *
     * @return Item
     */
    public function setAttrtype3($attrtype3)
    {
        $this->attrtype3 = $attrtype3;

        return $this;
    }

    /**
     * Get attrtype3
     *
     * @return boolean
     */
    public function getAttrtype3()
    {
        return $this->attrtype3;
    }

    /**
     * Set attrvalue3
     *
     * @param integer $attrvalue3
     *
     * @return Item
     */
    public function setAttrvalue3($attrvalue3)
    {
        $this->attrvalue3 = $attrvalue3;

        return $this;
    }

    /**
     * Get attrvalue3
     *
     * @return integer
     */
    public function getAttrvalue3()
    {
        return $this->attrvalue3;
    }

    /**
     * Set attrtype4
     *
     * @param boolean $attrtype4
     *
     * @return Item
     */
    public function setAttrtype4($attrtype4)
    {
        $this->attrtype4 = $attrtype4;

        return $this;
    }

    /**
     * Get attrtype4
     *
     * @return boolean
     */
    public function getAttrtype4()
    {
        return $this->attrtype4;
    }

    /**
     * Set attrvalue4
     *
     * @param integer $attrvalue4
     *
     * @return Item
     */
    public function setAttrvalue4($attrvalue4)
    {
        $this->attrvalue4 = $attrvalue4;

        return $this;
    }

    /**
     * Get attrvalue4
     *
     * @return integer
     */
    public function getAttrvalue4()
    {
        return $this->attrvalue4;
    }

    /**
     * Set attrtype5
     *
     * @param boolean $attrtype5
     *
     * @return Item
     */
    public function setAttrtype5($attrtype5)
    {
        $this->attrtype5 = $attrtype5;

        return $this;
    }

    /**
     * Get attrtype5
     *
     * @return boolean
     */
    public function getAttrtype5()
    {
        return $this->attrtype5;
    }

    /**
     * Set attrvalue5
     *
     * @param integer $attrvalue5
     *
     * @return Item
     */
    public function setAttrvalue5($attrvalue5)
    {
        $this->attrvalue5 = $attrvalue5;

        return $this;
    }

    /**
     * Get attrvalue5
     *
     * @return integer
     */
    public function getAttrvalue5()
    {
        return $this->attrvalue5;
    }

    /**
     * Set attrtype6
     *
     * @param boolean $attrtype6
     *
     * @return Item
     */
    public function setAttrtype6($attrtype6)
    {
        $this->attrtype6 = $attrtype6;

        return $this;
    }

    /**
     * Get attrtype6
     *
     * @return boolean
     */
    public function getAttrtype6()
    {
        return $this->attrtype6;
    }

    /**
     * Set attrvalue6
     *
     * @param integer $attrvalue6
     *
     * @return Item
     */
    public function setAttrvalue6($attrvalue6)
    {
        $this->attrvalue6 = $attrvalue6;

        return $this;
    }

    /**
     * Get attrvalue6
     *
     * @return integer
     */
    public function getAttrvalue6()
    {
        return $this->attrvalue6;
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
