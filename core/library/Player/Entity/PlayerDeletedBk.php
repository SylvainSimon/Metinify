<?php

namespace Player\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlayerDeletedBk
 *
 * @ORM\Table(name="player.player_deleted_bk", indexes={@ORM\Index(name="account_id_idx", columns={"account_id"}), @ORM\Index(name="name_idx", columns={"name"})})
 * @ORM\Entity
 */
class PlayerDeletedBk
{
    /**
     * @var integer
     *
     * @ORM\Column(name="account_id", type="integer", nullable=false)
     */
    private $accountId = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=24, nullable=false)
     */
    private $name = 'NONAME';

    /**
     * @var boolean
     *
     * @ORM\Column(name="job", type="boolean", nullable=false)
     */
    private $job = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="voice", type="boolean", nullable=false)
     */
    private $voice = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="dir", type="boolean", nullable=false)
     */
    private $dir = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="x", type="integer", nullable=false)
     */
    private $x = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="y", type="integer", nullable=false)
     */
    private $y = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="z", type="integer", nullable=false)
     */
    private $z = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="map_index", type="integer", nullable=false)
     */
    private $mapIndex = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="exit_x", type="integer", nullable=false)
     */
    private $exitX = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="exit_y", type="integer", nullable=false)
     */
    private $exitY = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="exit_map_index", type="integer", nullable=false)
     */
    private $exitMapIndex = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="hp", type="smallint", nullable=false)
     */
    private $hp = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="mp", type="smallint", nullable=false)
     */
    private $mp = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="stamina", type="smallint", nullable=false)
     */
    private $stamina = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="random_hp", type="smallint", nullable=false)
     */
    private $randomHp = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="random_sp", type="smallint", nullable=false)
     */
    private $randomSp = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="playtime", type="integer", nullable=false)
     */
    private $playtime = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="level", type="boolean", nullable=false)
     */
    private $level = '1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="level_step", type="boolean", nullable=false)
     */
    private $levelStep = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="st", type="smallint", nullable=false)
     */
    private $st = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="ht", type="smallint", nullable=false)
     */
    private $ht = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="dx", type="smallint", nullable=false)
     */
    private $dx = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="iq", type="smallint", nullable=false)
     */
    private $iq = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="exp", type="integer", nullable=false)
     */
    private $exp = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="gold", type="integer", nullable=false)
     */
    private $gold = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="stat_point", type="smallint", nullable=false)
     */
    private $statPoint = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="skill_point", type="smallint", nullable=false)
     */
    private $skillPoint = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="quickslot", type="blob", length=255, nullable=true)
     */
    private $quickslot;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=15, nullable=true)
     */
    private $ip = '0.0.0.0';

    /**
     * @var integer
     *
     * @ORM\Column(name="part_main", type="smallint", nullable=false)
     */
    private $partMain = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="part_base", type="boolean", nullable=false)
     */
    private $partBase = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="part_hair", type="boolean", nullable=false)
     */
    private $partHair = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="skill_group", type="boolean", nullable=false)
     */
    private $skillGroup = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="skill_level", type="blob", length=65535, nullable=true)
     */
    private $skillLevel;

    /**
     * @var integer
     *
     * @ORM\Column(name="alignment", type="integer", nullable=false)
     */
    private $alignment = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_play", type="datetime", nullable=false)
     */
    private $lastPlay = '0000-00-00 00:00:00';

    /**
     * @var boolean
     *
     * @ORM\Column(name="change_name", type="boolean", nullable=false)
     */
    private $changeName = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="mobile", type="string", length=32, nullable=true)
     */
    private $mobile;

    /**
     * @var integer
     *
     * @ORM\Column(name="sub_skill_point", type="smallint", nullable=false)
     */
    private $subSkillPoint = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="stat_reset_count", type="boolean", nullable=false)
     */
    private $statResetCount = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="horse_hp", type="smallint", nullable=false)
     */
    private $horseHp = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="horse_stamina", type="smallint", nullable=false)
     */
    private $horseStamina = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="horse_level", type="boolean", nullable=false)
     */
    private $horseLevel = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="horse_hp_droptime", type="integer", nullable=false)
     */
    private $horseHpDroptime = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="horse_riding", type="boolean", nullable=false)
     */
    private $horseRiding = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="horse_skill_point", type="smallint", nullable=false)
     */
    private $horseSkillPoint = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set accountId
     *
     * @param integer $accountId
     *
     * @return PlayerDeletedBk
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;

        return $this;
    }

    /**
     * Get accountId
     *
     * @return integer
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return PlayerDeletedBk
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
     * Set job
     *
     * @param boolean $job
     *
     * @return PlayerDeletedBk
     */
    public function setJob($job)
    {
        $this->job = $job;

        return $this;
    }

    /**
     * Get job
     *
     * @return boolean
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * Set voice
     *
     * @param boolean $voice
     *
     * @return PlayerDeletedBk
     */
    public function setVoice($voice)
    {
        $this->voice = $voice;

        return $this;
    }

    /**
     * Get voice
     *
     * @return boolean
     */
    public function getVoice()
    {
        return $this->voice;
    }

    /**
     * Set dir
     *
     * @param boolean $dir
     *
     * @return PlayerDeletedBk
     */
    public function setDir($dir)
    {
        $this->dir = $dir;

        return $this;
    }

    /**
     * Get dir
     *
     * @return boolean
     */
    public function getDir()
    {
        return $this->dir;
    }

    /**
     * Set x
     *
     * @param integer $x
     *
     * @return PlayerDeletedBk
     */
    public function setX($x)
    {
        $this->x = $x;

        return $this;
    }

    /**
     * Get x
     *
     * @return integer
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * Set y
     *
     * @param integer $y
     *
     * @return PlayerDeletedBk
     */
    public function setY($y)
    {
        $this->y = $y;

        return $this;
    }

    /**
     * Get y
     *
     * @return integer
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * Set z
     *
     * @param integer $z
     *
     * @return PlayerDeletedBk
     */
    public function setZ($z)
    {
        $this->z = $z;

        return $this;
    }

    /**
     * Get z
     *
     * @return integer
     */
    public function getZ()
    {
        return $this->z;
    }

    /**
     * Set mapIndex
     *
     * @param integer $mapIndex
     *
     * @return PlayerDeletedBk
     */
    public function setMapIndex($mapIndex)
    {
        $this->mapIndex = $mapIndex;

        return $this;
    }

    /**
     * Get mapIndex
     *
     * @return integer
     */
    public function getMapIndex()
    {
        return $this->mapIndex;
    }

    /**
     * Set exitX
     *
     * @param integer $exitX
     *
     * @return PlayerDeletedBk
     */
    public function setExitX($exitX)
    {
        $this->exitX = $exitX;

        return $this;
    }

    /**
     * Get exitX
     *
     * @return integer
     */
    public function getExitX()
    {
        return $this->exitX;
    }

    /**
     * Set exitY
     *
     * @param integer $exitY
     *
     * @return PlayerDeletedBk
     */
    public function setExitY($exitY)
    {
        $this->exitY = $exitY;

        return $this;
    }

    /**
     * Get exitY
     *
     * @return integer
     */
    public function getExitY()
    {
        return $this->exitY;
    }

    /**
     * Set exitMapIndex
     *
     * @param integer $exitMapIndex
     *
     * @return PlayerDeletedBk
     */
    public function setExitMapIndex($exitMapIndex)
    {
        $this->exitMapIndex = $exitMapIndex;

        return $this;
    }

    /**
     * Get exitMapIndex
     *
     * @return integer
     */
    public function getExitMapIndex()
    {
        return $this->exitMapIndex;
    }

    /**
     * Set hp
     *
     * @param integer $hp
     *
     * @return PlayerDeletedBk
     */
    public function setHp($hp)
    {
        $this->hp = $hp;

        return $this;
    }

    /**
     * Get hp
     *
     * @return integer
     */
    public function getHp()
    {
        return $this->hp;
    }

    /**
     * Set mp
     *
     * @param integer $mp
     *
     * @return PlayerDeletedBk
     */
    public function setMp($mp)
    {
        $this->mp = $mp;

        return $this;
    }

    /**
     * Get mp
     *
     * @return integer
     */
    public function getMp()
    {
        return $this->mp;
    }

    /**
     * Set stamina
     *
     * @param integer $stamina
     *
     * @return PlayerDeletedBk
     */
    public function setStamina($stamina)
    {
        $this->stamina = $stamina;

        return $this;
    }

    /**
     * Get stamina
     *
     * @return integer
     */
    public function getStamina()
    {
        return $this->stamina;
    }

    /**
     * Set randomHp
     *
     * @param integer $randomHp
     *
     * @return PlayerDeletedBk
     */
    public function setRandomHp($randomHp)
    {
        $this->randomHp = $randomHp;

        return $this;
    }

    /**
     * Get randomHp
     *
     * @return integer
     */
    public function getRandomHp()
    {
        return $this->randomHp;
    }

    /**
     * Set randomSp
     *
     * @param integer $randomSp
     *
     * @return PlayerDeletedBk
     */
    public function setRandomSp($randomSp)
    {
        $this->randomSp = $randomSp;

        return $this;
    }

    /**
     * Get randomSp
     *
     * @return integer
     */
    public function getRandomSp()
    {
        return $this->randomSp;
    }

    /**
     * Set playtime
     *
     * @param integer $playtime
     *
     * @return PlayerDeletedBk
     */
    public function setPlaytime($playtime)
    {
        $this->playtime = $playtime;

        return $this;
    }

    /**
     * Get playtime
     *
     * @return integer
     */
    public function getPlaytime()
    {
        return $this->playtime;
    }

    /**
     * Set level
     *
     * @param boolean $level
     *
     * @return PlayerDeletedBk
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
     * Set levelStep
     *
     * @param boolean $levelStep
     *
     * @return PlayerDeletedBk
     */
    public function setLevelStep($levelStep)
    {
        $this->levelStep = $levelStep;

        return $this;
    }

    /**
     * Get levelStep
     *
     * @return boolean
     */
    public function getLevelStep()
    {
        return $this->levelStep;
    }

    /**
     * Set st
     *
     * @param integer $st
     *
     * @return PlayerDeletedBk
     */
    public function setSt($st)
    {
        $this->st = $st;

        return $this;
    }

    /**
     * Get st
     *
     * @return integer
     */
    public function getSt()
    {
        return $this->st;
    }

    /**
     * Set ht
     *
     * @param integer $ht
     *
     * @return PlayerDeletedBk
     */
    public function setHt($ht)
    {
        $this->ht = $ht;

        return $this;
    }

    /**
     * Get ht
     *
     * @return integer
     */
    public function getHt()
    {
        return $this->ht;
    }

    /**
     * Set dx
     *
     * @param integer $dx
     *
     * @return PlayerDeletedBk
     */
    public function setDx($dx)
    {
        $this->dx = $dx;

        return $this;
    }

    /**
     * Get dx
     *
     * @return integer
     */
    public function getDx()
    {
        return $this->dx;
    }

    /**
     * Set iq
     *
     * @param integer $iq
     *
     * @return PlayerDeletedBk
     */
    public function setIq($iq)
    {
        $this->iq = $iq;

        return $this;
    }

    /**
     * Get iq
     *
     * @return integer
     */
    public function getIq()
    {
        return $this->iq;
    }

    /**
     * Set exp
     *
     * @param integer $exp
     *
     * @return PlayerDeletedBk
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
     * Set gold
     *
     * @param integer $gold
     *
     * @return PlayerDeletedBk
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
     * Set statPoint
     *
     * @param integer $statPoint
     *
     * @return PlayerDeletedBk
     */
    public function setStatPoint($statPoint)
    {
        $this->statPoint = $statPoint;

        return $this;
    }

    /**
     * Get statPoint
     *
     * @return integer
     */
    public function getStatPoint()
    {
        return $this->statPoint;
    }

    /**
     * Set skillPoint
     *
     * @param integer $skillPoint
     *
     * @return PlayerDeletedBk
     */
    public function setSkillPoint($skillPoint)
    {
        $this->skillPoint = $skillPoint;

        return $this;
    }

    /**
     * Get skillPoint
     *
     * @return integer
     */
    public function getSkillPoint()
    {
        return $this->skillPoint;
    }

    /**
     * Set quickslot
     *
     * @param string $quickslot
     *
     * @return PlayerDeletedBk
     */
    public function setQuickslot($quickslot)
    {
        $this->quickslot = $quickslot;

        return $this;
    }

    /**
     * Get quickslot
     *
     * @return string
     */
    public function getQuickslot()
    {
        return $this->quickslot;
    }

    /**
     * Set ip
     *
     * @param string $ip
     *
     * @return PlayerDeletedBk
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set partMain
     *
     * @param integer $partMain
     *
     * @return PlayerDeletedBk
     */
    public function setPartMain($partMain)
    {
        $this->partMain = $partMain;

        return $this;
    }

    /**
     * Get partMain
     *
     * @return integer
     */
    public function getPartMain()
    {
        return $this->partMain;
    }

    /**
     * Set partBase
     *
     * @param boolean $partBase
     *
     * @return PlayerDeletedBk
     */
    public function setPartBase($partBase)
    {
        $this->partBase = $partBase;

        return $this;
    }

    /**
     * Get partBase
     *
     * @return boolean
     */
    public function getPartBase()
    {
        return $this->partBase;
    }

    /**
     * Set partHair
     *
     * @param boolean $partHair
     *
     * @return PlayerDeletedBk
     */
    public function setPartHair($partHair)
    {
        $this->partHair = $partHair;

        return $this;
    }

    /**
     * Get partHair
     *
     * @return boolean
     */
    public function getPartHair()
    {
        return $this->partHair;
    }

    /**
     * Set skillGroup
     *
     * @param boolean $skillGroup
     *
     * @return PlayerDeletedBk
     */
    public function setSkillGroup($skillGroup)
    {
        $this->skillGroup = $skillGroup;

        return $this;
    }

    /**
     * Get skillGroup
     *
     * @return boolean
     */
    public function getSkillGroup()
    {
        return $this->skillGroup;
    }

    /**
     * Set skillLevel
     *
     * @param string $skillLevel
     *
     * @return PlayerDeletedBk
     */
    public function setSkillLevel($skillLevel)
    {
        $this->skillLevel = $skillLevel;

        return $this;
    }

    /**
     * Get skillLevel
     *
     * @return string
     */
    public function getSkillLevel()
    {
        return $this->skillLevel;
    }

    /**
     * Set alignment
     *
     * @param integer $alignment
     *
     * @return PlayerDeletedBk
     */
    public function setAlignment($alignment)
    {
        $this->alignment = $alignment;

        return $this;
    }

    /**
     * Get alignment
     *
     * @return integer
     */
    public function getAlignment()
    {
        return $this->alignment;
    }

    /**
     * Set lastPlay
     *
     * @param \DateTime $lastPlay
     *
     * @return PlayerDeletedBk
     */
    public function setLastPlay($lastPlay)
    {
        $this->lastPlay = $lastPlay;

        return $this;
    }

    /**
     * Get lastPlay
     *
     * @return \DateTime
     */
    public function getLastPlay()
    {
        return $this->lastPlay;
    }

    /**
     * Set changeName
     *
     * @param boolean $changeName
     *
     * @return PlayerDeletedBk
     */
    public function setChangeName($changeName)
    {
        $this->changeName = $changeName;

        return $this;
    }

    /**
     * Get changeName
     *
     * @return boolean
     */
    public function getChangeName()
    {
        return $this->changeName;
    }

    /**
     * Set mobile
     *
     * @param string $mobile
     *
     * @return PlayerDeletedBk
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set subSkillPoint
     *
     * @param integer $subSkillPoint
     *
     * @return PlayerDeletedBk
     */
    public function setSubSkillPoint($subSkillPoint)
    {
        $this->subSkillPoint = $subSkillPoint;

        return $this;
    }

    /**
     * Get subSkillPoint
     *
     * @return integer
     */
    public function getSubSkillPoint()
    {
        return $this->subSkillPoint;
    }

    /**
     * Set statResetCount
     *
     * @param boolean $statResetCount
     *
     * @return PlayerDeletedBk
     */
    public function setStatResetCount($statResetCount)
    {
        $this->statResetCount = $statResetCount;

        return $this;
    }

    /**
     * Get statResetCount
     *
     * @return boolean
     */
    public function getStatResetCount()
    {
        return $this->statResetCount;
    }

    /**
     * Set horseHp
     *
     * @param integer $horseHp
     *
     * @return PlayerDeletedBk
     */
    public function setHorseHp($horseHp)
    {
        $this->horseHp = $horseHp;

        return $this;
    }

    /**
     * Get horseHp
     *
     * @return integer
     */
    public function getHorseHp()
    {
        return $this->horseHp;
    }

    /**
     * Set horseStamina
     *
     * @param integer $horseStamina
     *
     * @return PlayerDeletedBk
     */
    public function setHorseStamina($horseStamina)
    {
        $this->horseStamina = $horseStamina;

        return $this;
    }

    /**
     * Get horseStamina
     *
     * @return integer
     */
    public function getHorseStamina()
    {
        return $this->horseStamina;
    }

    /**
     * Set horseLevel
     *
     * @param boolean $horseLevel
     *
     * @return PlayerDeletedBk
     */
    public function setHorseLevel($horseLevel)
    {
        $this->horseLevel = $horseLevel;

        return $this;
    }

    /**
     * Get horseLevel
     *
     * @return boolean
     */
    public function getHorseLevel()
    {
        return $this->horseLevel;
    }

    /**
     * Set horseHpDroptime
     *
     * @param integer $horseHpDroptime
     *
     * @return PlayerDeletedBk
     */
    public function setHorseHpDroptime($horseHpDroptime)
    {
        $this->horseHpDroptime = $horseHpDroptime;

        return $this;
    }

    /**
     * Get horseHpDroptime
     *
     * @return integer
     */
    public function getHorseHpDroptime()
    {
        return $this->horseHpDroptime;
    }

    /**
     * Set horseRiding
     *
     * @param boolean $horseRiding
     *
     * @return PlayerDeletedBk
     */
    public function setHorseRiding($horseRiding)
    {
        $this->horseRiding = $horseRiding;

        return $this;
    }

    /**
     * Get horseRiding
     *
     * @return boolean
     */
    public function getHorseRiding()
    {
        return $this->horseRiding;
    }

    /**
     * Set horseSkillPoint
     *
     * @param integer $horseSkillPoint
     *
     * @return PlayerDeletedBk
     */
    public function setHorseSkillPoint($horseSkillPoint)
    {
        $this->horseSkillPoint = $horseSkillPoint;

        return $this;
    }

    /**
     * Get horseSkillPoint
     *
     * @return integer
     */
    public function getHorseSkillPoint()
    {
        return $this->horseSkillPoint;
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
