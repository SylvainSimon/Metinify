<?php

namespace Player\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Guild
 *
 * @ORM\Table(name="guild")
 * @ORM\Entity
 */
class Guild
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=12, nullable=false)
     */
    private $name = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="sp", type="smallint", nullable=false)
     */
    private $sp = '1000';

    /**
     * @var integer
     *
     * @ORM\Column(name="master", type="integer", nullable=false)
     */
    private $master = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="level", type="boolean", nullable=true)
     */
    private $level;

    /**
     * @var integer
     *
     * @ORM\Column(name="exp", type="integer", nullable=true)
     */
    private $exp;

    /**
     * @var boolean
     *
     * @ORM\Column(name="skill_point", type="boolean", nullable=false)
     */
    private $skillPoint = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="skill", type="blob", length=255, nullable=true)
     */
    private $skill;

    /**
     * @var integer
     *
     * @ORM\Column(name="win", type="integer", nullable=false)
     */
    private $win = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="draw", type="integer", nullable=false)
     */
    private $draw = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="loss", type="integer", nullable=false)
     */
    private $loss = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="ladder_point", type="integer", nullable=false)
     */
    private $ladderPoint = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="gold", type="integer", nullable=false)
     */
    private $gold = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set name
     *
     * @param string $name
     *
     * @return Guild
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set sp
     *
     * @param integer $sp
     *
     * @return Guild
     */
    public function setSp($sp)
    {
        $this->sp = $sp;

        return $this;
    }

    /**
     * Get sp
     *
     * @return integer
     */
    public function getSp()
    {
        return $this->sp;
    }

    /**
     * Set master
     *
     * @param integer $master
     *
     * @return Guild
     */
    public function setMaster($master)
    {
        $this->master = $master;

        return $this;
    }

    /**
     * Get master
     *
     * @return integer
     */
    public function getMaster()
    {
        return $this->master;
    }

    /**
     * Set level
     *
     * @param boolean $level
     *
     * @return Guild
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return boolean
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set exp
     *
     * @param integer $exp
     *
     * @return Guild
     */
    public function setExp($exp)
    {
        $this->exp = $exp;

        return $this;
    }

    /**
     * Get exp
     *
     * @return integer
     */
    public function getExp()
    {
        return $this->exp;
    }

    /**
     * Set skillPoint
     *
     * @param boolean $skillPoint
     *
     * @return Guild
     */
    public function setSkillPoint($skillPoint)
    {
        $this->skillPoint = $skillPoint;

        return $this;
    }

    /**
     * Get skillPoint
     *
     * @return boolean
     */
    public function getSkillPoint()
    {
        return $this->skillPoint;
    }

    /**
     * Set skill
     *
     * @param string $skill
     *
     * @return Guild
     */
    public function setSkill($skill)
    {
        $this->skill = $skill;

        return $this;
    }

    /**
     * Get skill
     *
     * @return string
     */
    public function getSkill()
    {
        return $this->skill;
    }

    /**
     * Set win
     *
     * @param integer $win
     *
     * @return Guild
     */
    public function setWin($win)
    {
        $this->win = $win;

        return $this;
    }

    /**
     * Get win
     *
     * @return integer
     */
    public function getWin()
    {
        return $this->win;
    }

    /**
     * Set draw
     *
     * @param integer $draw
     *
     * @return Guild
     */
    public function setDraw($draw)
    {
        $this->draw = $draw;

        return $this;
    }

    /**
     * Get draw
     *
     * @return integer
     */
    public function getDraw()
    {
        return $this->draw;
    }

    /**
     * Set loss
     *
     * @param integer $loss
     *
     * @return Guild
     */
    public function setLoss($loss)
    {
        $this->loss = $loss;

        return $this;
    }

    /**
     * Get loss
     *
     * @return integer
     */
    public function getLoss()
    {
        return $this->loss;
    }

    /**
     * Set ladderPoint
     *
     * @param integer $ladderPoint
     *
     * @return Guild
     */
    public function setLadderPoint($ladderPoint)
    {
        $this->ladderPoint = $ladderPoint;

        return $this;
    }

    /**
     * Get ladderPoint
     *
     * @return integer
     */
    public function getLadderPoint()
    {
        return $this->ladderPoint;
    }

    /**
     * Set gold
     *
     * @param integer $gold
     *
     * @return Guild
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
