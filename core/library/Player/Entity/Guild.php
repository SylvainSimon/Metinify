<?php

namespace Player\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Guild
 *
 * @ORM\Table(name="player.guild")
 * @ORM\Entity(repositoryClass="Player\Repository\GuildRepository")
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
    private $victoire = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="draw", type="integer", nullable=false)
     */
    private $egalite = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="loss", type="integer", nullable=false)
     */
    private $defaite = '0';

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
     * Set victoire
     *
     * @param integer $victoire
     *
     * @return Guild
     */
    public function setVictoire($victoire)
    {
        $this->victoire = $victoire;

        return $this;
    }

    /**
     * Get victoire
     *
     * @return integer
     */
    public function getVictoire()
    {
        return $this->victoire;
    }

    /**
     * Set egalite
     *
     * @param integer $egalite
     *
     * @return Guild
     */
    public function setEgalite($egalite)
    {
        $this->egalite = $egalite;

        return $this;
    }

    /**
     * Get egalite
     *
     * @return integer
     */
    public function getEgalite()
    {
        return $this->egalite;
    }

    /**
     * Set defaite
     *
     * @param integer $defaite
     *
     * @return Guild
     */
    public function setDefaite($defaite)
    {
        $this->defaite = $defaite;

        return $this;
    }

    /**
     * Get defaite
     *
     * @return integer
     */
    public function getDefaite()
    {
        return $this->defaite;
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
