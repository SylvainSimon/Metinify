<?php

namespace Player\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ItemAttrRare
 *
 * @ORM\Table(name="item_attr_rare")
 * @ORM\Entity
 */
class ItemAttrRare
{
    /**
     * @var string
     *
     * @ORM\Column(name="apply", type="string", nullable=false)
     */
    private $apply = 'MAX_HP';

    /**
     * @var string
     *
     * @ORM\Column(name="prob", type="string", length=100, nullable=false)
     */
    private $prob = '';

    /**
     * @var string
     *
     * @ORM\Column(name="lv1", type="string", length=100, nullable=false)
     */
    private $lv1 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="lv2", type="string", length=100, nullable=false)
     */
    private $lv2 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="lv3", type="string", length=100, nullable=false)
     */
    private $lv3 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="lv4", type="string", length=100, nullable=false)
     */
    private $lv4 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="lv5", type="string", length=100, nullable=false)
     */
    private $lv5 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="weapon", type="string", length=100, nullable=false)
     */
    private $weapon = '';

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="string", length=100, nullable=false)
     */
    private $body = '';

    /**
     * @var string
     *
     * @ORM\Column(name="wrist", type="string", length=100, nullable=false)
     */
    private $wrist = '';

    /**
     * @var string
     *
     * @ORM\Column(name="foots", type="string", length=100, nullable=false)
     */
    private $foots = '';

    /**
     * @var string
     *
     * @ORM\Column(name="neck", type="string", length=100, nullable=false)
     */
    private $neck = '';

    /**
     * @var string
     *
     * @ORM\Column(name="head", type="string", length=100, nullable=false)
     */
    private $head = '';

    /**
     * @var string
     *
     * @ORM\Column(name="shield", type="string", length=100, nullable=false)
     */
    private $shield = '';

    /**
     * @var string
     *
     * @ORM\Column(name="ear", type="string", length=100, nullable=false)
     */
    private $ear = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set apply
     *
     * @param string $apply
     *
     * @return ItemAttrRare
     */
    public function setApply($apply)
    {
        $this->apply = $apply;

        return $this;
    }

    /**
     * Get apply
     *
     * @return string
     */
    public function getApply()
    {
        return $this->apply;
    }

    /**
     * Set prob
     *
     * @param string $prob
     *
     * @return ItemAttrRare
     */
    public function setProb($prob)
    {
        $this->prob = $prob;

        return $this;
    }

    /**
     * Get prob
     *
     * @return string
     */
    public function getProb()
    {
        return $this->prob;
    }

    /**
     * Set lv1
     *
     * @param string $lv1
     *
     * @return ItemAttrRare
     */
    public function setLv1($lv1)
    {
        $this->lv1 = $lv1;

        return $this;
    }

    /**
     * Get lv1
     *
     * @return string
     */
    public function getLv1()
    {
        return $this->lv1;
    }

    /**
     * Set lv2
     *
     * @param string $lv2
     *
     * @return ItemAttrRare
     */
    public function setLv2($lv2)
    {
        $this->lv2 = $lv2;

        return $this;
    }

    /**
     * Get lv2
     *
     * @return string
     */
    public function getLv2()
    {
        return $this->lv2;
    }

    /**
     * Set lv3
     *
     * @param string $lv3
     *
     * @return ItemAttrRare
     */
    public function setLv3($lv3)
    {
        $this->lv3 = $lv3;

        return $this;
    }

    /**
     * Get lv3
     *
     * @return string
     */
    public function getLv3()
    {
        return $this->lv3;
    }

    /**
     * Set lv4
     *
     * @param string $lv4
     *
     * @return ItemAttrRare
     */
    public function setLv4($lv4)
    {
        $this->lv4 = $lv4;

        return $this;
    }

    /**
     * Get lv4
     *
     * @return string
     */
    public function getLv4()
    {
        return $this->lv4;
    }

    /**
     * Set lv5
     *
     * @param string $lv5
     *
     * @return ItemAttrRare
     */
    public function setLv5($lv5)
    {
        $this->lv5 = $lv5;

        return $this;
    }

    /**
     * Get lv5
     *
     * @return string
     */
    public function getLv5()
    {
        return $this->lv5;
    }

    /**
     * Set weapon
     *
     * @param string $weapon
     *
     * @return ItemAttrRare
     */
    public function setWeapon($weapon)
    {
        $this->weapon = $weapon;

        return $this;
    }

    /**
     * Get weapon
     *
     * @return string
     */
    public function getWeapon()
    {
        return $this->weapon;
    }

    /**
     * Set body
     *
     * @param string $body
     *
     * @return ItemAttrRare
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set wrist
     *
     * @param string $wrist
     *
     * @return ItemAttrRare
     */
    public function setWrist($wrist)
    {
        $this->wrist = $wrist;

        return $this;
    }

    /**
     * Get wrist
     *
     * @return string
     */
    public function getWrist()
    {
        return $this->wrist;
    }

    /**
     * Set foots
     *
     * @param string $foots
     *
     * @return ItemAttrRare
     */
    public function setFoots($foots)
    {
        $this->foots = $foots;

        return $this;
    }

    /**
     * Get foots
     *
     * @return string
     */
    public function getFoots()
    {
        return $this->foots;
    }

    /**
     * Set neck
     *
     * @param string $neck
     *
     * @return ItemAttrRare
     */
    public function setNeck($neck)
    {
        $this->neck = $neck;

        return $this;
    }

    /**
     * Get neck
     *
     * @return string
     */
    public function getNeck()
    {
        return $this->neck;
    }

    /**
     * Set head
     *
     * @param string $head
     *
     * @return ItemAttrRare
     */
    public function setHead($head)
    {
        $this->head = $head;

        return $this;
    }

    /**
     * Get head
     *
     * @return string
     */
    public function getHead()
    {
        return $this->head;
    }

    /**
     * Set shield
     *
     * @param string $shield
     *
     * @return ItemAttrRare
     */
    public function setShield($shield)
    {
        $this->shield = $shield;

        return $this;
    }

    /**
     * Get shield
     *
     * @return string
     */
    public function getShield()
    {
        return $this->shield;
    }

    /**
     * Set ear
     *
     * @param string $ear
     *
     * @return ItemAttrRare
     */
    public function setEar($ear)
    {
        $this->ear = $ear;

        return $this;
    }

    /**
     * Get ear
     *
     * @return string
     */
    public function getEar()
    {
        return $this->ear;
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
