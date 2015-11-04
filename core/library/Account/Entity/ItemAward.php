<?php

namespace Account\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ItemAward
 *
 * @ORM\Table(name="account.item_award", indexes={@ORM\Index(name="pid_idx", columns={"pid"}), @ORM\Index(name="given_time_idx", columns={"given_time"}), @ORM\Index(name="taken_time_idx", columns={"taken_time"})})
 * @ORM\Entity
 */
class ItemAward
{
    /**
     * @var integer
     *
     * @ORM\Column(name="pid", type="integer", nullable=false)
     */
    private $pid = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=30, nullable=false)
     */
    private $login = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="vnum", type="integer", nullable=false)
     */
    private $vnum = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="count", type="integer", nullable=false)
     */
    private $count = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="given_time", type="datetime", nullable=false)
     */
    private $givenTime = '0000-00-00 00:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="taken_time", type="datetime", nullable=true)
     */
    private $takenTime;

    /**
     * @var integer
     *
     * @ORM\Column(name="item_id", type="integer", nullable=true)
     */
    private $itemId;

    /**
     * @var string
     *
     * @ORM\Column(name="why", type="string", length=128, nullable=true)
     */
    private $why;

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
     * @var boolean
     *
     * @ORM\Column(name="mall", type="boolean", nullable=false)
     */
    private $mall = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set pid
     *
     * @param integer $pid
     *
     * @return ItemAward
     */
    public function setPid($pid)
    {
        $this->pid = $pid;

        return $this;
    }

    /**
     * Get pid
     *
     * @return integer
     */
    public function getPid()
    {
        return $this->pid;
    }

    /**
     * Set login
     *
     * @param string $login
     *
     * @return ItemAward
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set vnum
     *
     * @param integer $vnum
     *
     * @return ItemAward
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
     * Set count
     *
     * @param integer $count
     *
     * @return ItemAward
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
     * Set givenTime
     *
     * @param \DateTime $givenTime
     *
     * @return ItemAward
     */
    public function setGivenTime($givenTime)
    {
        $this->givenTime = $givenTime;

        return $this;
    }

    /**
     * Get givenTime
     *
     * @return \DateTime
     */
    public function getGivenTime()
    {
        return $this->givenTime;
    }

    /**
     * Set takenTime
     *
     * @param \DateTime $takenTime
     *
     * @return ItemAward
     */
    public function setTakenTime($takenTime)
    {
        $this->takenTime = $takenTime;

        return $this;
    }

    /**
     * Get takenTime
     *
     * @return \DateTime
     */
    public function getTakenTime()
    {
        return $this->takenTime;
    }

    /**
     * Set itemId
     *
     * @param integer $itemId
     *
     * @return ItemAward
     */
    public function setItemId($itemId)
    {
        $this->itemId = $itemId;

        return $this;
    }

    /**
     * Get itemId
     *
     * @return integer
     */
    public function getItemId()
    {
        return $this->itemId;
    }

    /**
     * Set why
     *
     * @param string $why
     *
     * @return ItemAward
     */
    public function setWhy($why)
    {
        $this->why = $why;

        return $this;
    }

    /**
     * Get why
     *
     * @return string
     */
    public function getWhy()
    {
        return $this->why;
    }

    /**
     * Set socket0
     *
     * @param integer $socket0
     *
     * @return ItemAward
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
     * @return ItemAward
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
     * @return ItemAward
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
     * Set mall
     *
     * @param boolean $mall
     *
     * @return ItemAward
     */
    public function setMall($mall)
    {
        $this->mall = $mall;

        return $this;
    }

    /**
     * Get mall
     *
     * @return boolean
     */
    public function getMall()
    {
        return $this->mall;
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
