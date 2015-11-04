<?php

namespace Player\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MobProtoOld
 *
 * @ORM\Table(name="player.mob_proto_old")
 * @ORM\Entity
 */
class MobProtoOld
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=24, nullable=false)
     */
    private $name = 'Noname';

    /**
     * @var binary
     *
     * @ORM\Column(name="locale_name", type="binary", nullable=false)
     */
    private $localeName = 'Noname                  ';

    /**
     * @var boolean
     *
     * @ORM\Column(name="rank", type="boolean", nullable=false)
     */
    private $rank = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="type", type="boolean", nullable=false)
     */
    private $type = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="battle_type", type="boolean", nullable=false)
     */
    private $battleType = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="level", type="smallint", nullable=false)
     */
    private $level = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="size", type="string", nullable=false)
     */
    private $size = 'SMALL';

    /**
     * @var array
     *
     * @ORM\Column(name="ai_flag", type="simple_array", nullable=true)
     */
    private $aiFlag;

    /**
     * @var boolean
     *
     * @ORM\Column(name="mount_capacity", type="boolean", nullable=false)
     */
    private $mountCapacity = '0';

    /**
     * @var array
     *
     * @ORM\Column(name="setRaceFlag", type="simple_array", nullable=false)
     */
    private $setraceflag = '';

    /**
     * @var array
     *
     * @ORM\Column(name="setImmuneFlag", type="simple_array", nullable=false)
     */
    private $setimmuneflag = '';

    /**
     * @var boolean
     *
     * @ORM\Column(name="empire", type="boolean", nullable=false)
     */
    private $empire = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="folder", type="string", length=100, nullable=false)
     */
    private $folder = '';

    /**
     * @var boolean
     *
     * @ORM\Column(name="on_click", type="boolean", nullable=false)
     */
    private $onClick = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="st", type="smallint", nullable=false)
     */
    private $st = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="dx", type="smallint", nullable=false)
     */
    private $dx = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="ht", type="smallint", nullable=false)
     */
    private $ht = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="iq", type="smallint", nullable=false)
     */
    private $iq = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="damage_min", type="smallint", nullable=false)
     */
    private $damageMin = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="damage_max", type="smallint", nullable=false)
     */
    private $damageMax = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="max_hp", type="integer", nullable=false)
     */
    private $maxHp = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="regen_cycle", type="boolean", nullable=false)
     */
    private $regenCycle = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="regen_percent", type="boolean", nullable=false)
     */
    private $regenPercent = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="gold_min", type="integer", nullable=false)
     */
    private $goldMin = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="gold_max", type="integer", nullable=false)
     */
    private $goldMax = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="exp", type="integer", nullable=false)
     */
    private $exp = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="def", type="smallint", nullable=false)
     */
    private $def = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="attack_speed", type="smallint", nullable=false)
     */
    private $attackSpeed = '100';

    /**
     * @var integer
     *
     * @ORM\Column(name="move_speed", type="smallint", nullable=false)
     */
    private $moveSpeed = '100';

    /**
     * @var boolean
     *
     * @ORM\Column(name="aggressive_hp_pct", type="boolean", nullable=false)
     */
    private $aggressiveHpPct = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="aggressive_sight", type="smallint", nullable=false)
     */
    private $aggressiveSight = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="attack_range", type="smallint", nullable=false)
     */
    private $attackRange = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="drop_item", type="integer", nullable=false)
     */
    private $dropItem = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="resurrection_vnum", type="integer", nullable=false)
     */
    private $resurrectionVnum = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="enchant_curse", type="boolean", nullable=false)
     */
    private $enchantCurse = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="enchant_slow", type="boolean", nullable=false)
     */
    private $enchantSlow = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="enchant_poison", type="boolean", nullable=false)
     */
    private $enchantPoison = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="enchant_stun", type="boolean", nullable=false)
     */
    private $enchantStun = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="enchant_critical", type="boolean", nullable=false)
     */
    private $enchantCritical = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="enchant_penetrate", type="boolean", nullable=false)
     */
    private $enchantPenetrate = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="resist_sword", type="boolean", nullable=false)
     */
    private $resistSword = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="resist_twohand", type="boolean", nullable=false)
     */
    private $resistTwohand = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="resist_dagger", type="boolean", nullable=false)
     */
    private $resistDagger = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="resist_bell", type="boolean", nullable=false)
     */
    private $resistBell = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="resist_fan", type="boolean", nullable=false)
     */
    private $resistFan = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="resist_bow", type="boolean", nullable=false)
     */
    private $resistBow = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="resist_fire", type="boolean", nullable=false)
     */
    private $resistFire = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="resist_elect", type="boolean", nullable=false)
     */
    private $resistElect = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="resist_magic", type="boolean", nullable=false)
     */
    private $resistMagic = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="resist_wind", type="boolean", nullable=false)
     */
    private $resistWind = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="resist_poison", type="boolean", nullable=false)
     */
    private $resistPoison = '0';

    /**
     * @var float
     *
     * @ORM\Column(name="dam_multiply", type="float", precision=10, scale=0, nullable=true)
     */
    private $damMultiply;

    /**
     * @var integer
     *
     * @ORM\Column(name="summon", type="integer", nullable=true)
     */
    private $summon;

    /**
     * @var integer
     *
     * @ORM\Column(name="drain_sp", type="integer", nullable=true)
     */
    private $drainSp;

    /**
     * @var integer
     *
     * @ORM\Column(name="mob_color", type="integer", nullable=true)
     */
    private $mobColor;

    /**
     * @var integer
     *
     * @ORM\Column(name="polymorph_item", type="integer", nullable=false)
     */
    private $polymorphItem = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="skill_level0", type="boolean", nullable=true)
     */
    private $skillLevel0;

    /**
     * @var integer
     *
     * @ORM\Column(name="skill_vnum0", type="integer", nullable=true)
     */
    private $skillVnum0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="skill_level1", type="boolean", nullable=true)
     */
    private $skillLevel1;

    /**
     * @var integer
     *
     * @ORM\Column(name="skill_vnum1", type="integer", nullable=true)
     */
    private $skillVnum1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="sp_berserk", type="boolean", nullable=false)
     */
    private $spBerserk = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="sp_stoneskin", type="boolean", nullable=false)
     */
    private $spStoneskin = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="sp_godspeed", type="boolean", nullable=false)
     */
    private $spGodspeed = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="sp_deathblow", type="boolean", nullable=false)
     */
    private $spDeathblow = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="sp_revive", type="boolean", nullable=false)
     */
    private $spRevive = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="skill_level2", type="boolean", nullable=true)
     */
    private $skillLevel2;

    /**
     * @var integer
     *
     * @ORM\Column(name="skill_vnum2", type="integer", nullable=true)
     */
    private $skillVnum2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="skill_level3", type="boolean", nullable=true)
     */
    private $skillLevel3;

    /**
     * @var integer
     *
     * @ORM\Column(name="skill_vnum3", type="integer", nullable=true)
     */
    private $skillVnum3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="skill_level4", type="boolean", nullable=true)
     */
    private $skillLevel4;

    /**
     * @var integer
     *
     * @ORM\Column(name="skill_vnum4", type="integer", nullable=true)
     */
    private $skillVnum4;

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
     * @param string $name
     *
     * @return MobProtoOld
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
     * Set localeName
     *
     * @param binary $localeName
     *
     * @return MobProtoOld
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
     * Set rank
     *
     * @param boolean $rank
     *
     * @return MobProtoOld
     */
    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Get rank
     *
     * @return boolean
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * Set type
     *
     * @param boolean $type
     *
     * @return MobProtoOld
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
     * Set battleType
     *
     * @param boolean $battleType
     *
     * @return MobProtoOld
     */
    public function setBattleType($battleType)
    {
        $this->battleType = $battleType;

        return $this;
    }

    /**
     * Get battleType
     *
     * @return boolean
     */
    public function getBattleType()
    {
        return $this->battleType;
    }

    /**
     * Set level
     *
     * @param integer $level
     *
     * @return MobProtoOld
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return integer
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set size
     *
     * @param string $size
     *
     * @return MobProtoOld
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set aiFlag
     *
     * @param array $aiFlag
     *
     * @return MobProtoOld
     */
    public function setAiFlag($aiFlag)
    {
        $this->aiFlag = $aiFlag;

        return $this;
    }

    /**
     * Get aiFlag
     *
     * @return array
     */
    public function getAiFlag()
    {
        return $this->aiFlag;
    }

    /**
     * Set mountCapacity
     *
     * @param boolean $mountCapacity
     *
     * @return MobProtoOld
     */
    public function setMountCapacity($mountCapacity)
    {
        $this->mountCapacity = $mountCapacity;

        return $this;
    }

    /**
     * Get mountCapacity
     *
     * @return boolean
     */
    public function getMountCapacity()
    {
        return $this->mountCapacity;
    }

    /**
     * Set setraceflag
     *
     * @param array $setraceflag
     *
     * @return MobProtoOld
     */
    public function setSetraceflag($setraceflag)
    {
        $this->setraceflag = $setraceflag;

        return $this;
    }

    /**
     * Get setraceflag
     *
     * @return array
     */
    public function getSetraceflag()
    {
        return $this->setraceflag;
    }

    /**
     * Set setimmuneflag
     *
     * @param array $setimmuneflag
     *
     * @return MobProtoOld
     */
    public function setSetimmuneflag($setimmuneflag)
    {
        $this->setimmuneflag = $setimmuneflag;

        return $this;
    }

    /**
     * Get setimmuneflag
     *
     * @return array
     */
    public function getSetimmuneflag()
    {
        return $this->setimmuneflag;
    }

    /**
     * Set empire
     *
     * @param boolean $empire
     *
     * @return MobProtoOld
     */
    public function setEmpire($empire)
    {
        $this->empire = $empire;

        return $this;
    }

    /**
     * Get empire
     *
     * @return boolean
     */
    public function getEmpire()
    {
        return $this->empire;
    }

    /**
     * Set folder
     *
     * @param string $folder
     *
     * @return MobProtoOld
     */
    public function setFolder($folder)
    {
        $this->folder = $folder;

        return $this;
    }

    /**
     * Get folder
     *
     * @return string
     */
    public function getFolder()
    {
        return $this->folder;
    }

    /**
     * Set onClick
     *
     * @param boolean $onClick
     *
     * @return MobProtoOld
     */
    public function setOnClick($onClick)
    {
        $this->onClick = $onClick;

        return $this;
    }

    /**
     * Get onClick
     *
     * @return boolean
     */
    public function getOnClick()
    {
        return $this->onClick;
    }

    /**
     * Set st
     *
     * @param integer $st
     *
     * @return MobProtoOld
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
     * Set dx
     *
     * @param integer $dx
     *
     * @return MobProtoOld
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
     * Set ht
     *
     * @param integer $ht
     *
     * @return MobProtoOld
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
     * Set iq
     *
     * @param integer $iq
     *
     * @return MobProtoOld
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
     * Set damageMin
     *
     * @param integer $damageMin
     *
     * @return MobProtoOld
     */
    public function setDamageMin($damageMin)
    {
        $this->damageMin = $damageMin;

        return $this;
    }

    /**
     * Get damageMin
     *
     * @return integer
     */
    public function getDamageMin()
    {
        return $this->damageMin;
    }

    /**
     * Set damageMax
     *
     * @param integer $damageMax
     *
     * @return MobProtoOld
     */
    public function setDamageMax($damageMax)
    {
        $this->damageMax = $damageMax;

        return $this;
    }

    /**
     * Get damageMax
     *
     * @return integer
     */
    public function getDamageMax()
    {
        return $this->damageMax;
    }

    /**
     * Set maxHp
     *
     * @param integer $maxHp
     *
     * @return MobProtoOld
     */
    public function setMaxHp($maxHp)
    {
        $this->maxHp = $maxHp;

        return $this;
    }

    /**
     * Get maxHp
     *
     * @return integer
     */
    public function getMaxHp()
    {
        return $this->maxHp;
    }

    /**
     * Set regenCycle
     *
     * @param boolean $regenCycle
     *
     * @return MobProtoOld
     */
    public function setRegenCycle($regenCycle)
    {
        $this->regenCycle = $regenCycle;

        return $this;
    }

    /**
     * Get regenCycle
     *
     * @return boolean
     */
    public function getRegenCycle()
    {
        return $this->regenCycle;
    }

    /**
     * Set regenPercent
     *
     * @param boolean $regenPercent
     *
     * @return MobProtoOld
     */
    public function setRegenPercent($regenPercent)
    {
        $this->regenPercent = $regenPercent;

        return $this;
    }

    /**
     * Get regenPercent
     *
     * @return boolean
     */
    public function getRegenPercent()
    {
        return $this->regenPercent;
    }

    /**
     * Set goldMin
     *
     * @param integer $goldMin
     *
     * @return MobProtoOld
     */
    public function setGoldMin($goldMin)
    {
        $this->goldMin = $goldMin;

        return $this;
    }

    /**
     * Get goldMin
     *
     * @return integer
     */
    public function getGoldMin()
    {
        return $this->goldMin;
    }

    /**
     * Set goldMax
     *
     * @param integer $goldMax
     *
     * @return MobProtoOld
     */
    public function setGoldMax($goldMax)
    {
        $this->goldMax = $goldMax;

        return $this;
    }

    /**
     * Get goldMax
     *
     * @return integer
     */
    public function getGoldMax()
    {
        return $this->goldMax;
    }

    /**
     * Set exp
     *
     * @param integer $exp
     *
     * @return MobProtoOld
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
     * Set def
     *
     * @param integer $def
     *
     * @return MobProtoOld
     */
    public function setDef($def)
    {
        $this->def = $def;

        return $this;
    }

    /**
     * Get def
     *
     * @return integer
     */
    public function getDef()
    {
        return $this->def;
    }

    /**
     * Set attackSpeed
     *
     * @param integer $attackSpeed
     *
     * @return MobProtoOld
     */
    public function setAttackSpeed($attackSpeed)
    {
        $this->attackSpeed = $attackSpeed;

        return $this;
    }

    /**
     * Get attackSpeed
     *
     * @return integer
     */
    public function getAttackSpeed()
    {
        return $this->attackSpeed;
    }

    /**
     * Set moveSpeed
     *
     * @param integer $moveSpeed
     *
     * @return MobProtoOld
     */
    public function setMoveSpeed($moveSpeed)
    {
        $this->moveSpeed = $moveSpeed;

        return $this;
    }

    /**
     * Get moveSpeed
     *
     * @return integer
     */
    public function getMoveSpeed()
    {
        return $this->moveSpeed;
    }

    /**
     * Set aggressiveHpPct
     *
     * @param boolean $aggressiveHpPct
     *
     * @return MobProtoOld
     */
    public function setAggressiveHpPct($aggressiveHpPct)
    {
        $this->aggressiveHpPct = $aggressiveHpPct;

        return $this;
    }

    /**
     * Get aggressiveHpPct
     *
     * @return boolean
     */
    public function getAggressiveHpPct()
    {
        return $this->aggressiveHpPct;
    }

    /**
     * Set aggressiveSight
     *
     * @param integer $aggressiveSight
     *
     * @return MobProtoOld
     */
    public function setAggressiveSight($aggressiveSight)
    {
        $this->aggressiveSight = $aggressiveSight;

        return $this;
    }

    /**
     * Get aggressiveSight
     *
     * @return integer
     */
    public function getAggressiveSight()
    {
        return $this->aggressiveSight;
    }

    /**
     * Set attackRange
     *
     * @param integer $attackRange
     *
     * @return MobProtoOld
     */
    public function setAttackRange($attackRange)
    {
        $this->attackRange = $attackRange;

        return $this;
    }

    /**
     * Get attackRange
     *
     * @return integer
     */
    public function getAttackRange()
    {
        return $this->attackRange;
    }

    /**
     * Set dropItem
     *
     * @param integer $dropItem
     *
     * @return MobProtoOld
     */
    public function setDropItem($dropItem)
    {
        $this->dropItem = $dropItem;

        return $this;
    }

    /**
     * Get dropItem
     *
     * @return integer
     */
    public function getDropItem()
    {
        return $this->dropItem;
    }

    /**
     * Set resurrectionVnum
     *
     * @param integer $resurrectionVnum
     *
     * @return MobProtoOld
     */
    public function setResurrectionVnum($resurrectionVnum)
    {
        $this->resurrectionVnum = $resurrectionVnum;

        return $this;
    }

    /**
     * Get resurrectionVnum
     *
     * @return integer
     */
    public function getResurrectionVnum()
    {
        return $this->resurrectionVnum;
    }

    /**
     * Set enchantCurse
     *
     * @param boolean $enchantCurse
     *
     * @return MobProtoOld
     */
    public function setEnchantCurse($enchantCurse)
    {
        $this->enchantCurse = $enchantCurse;

        return $this;
    }

    /**
     * Get enchantCurse
     *
     * @return boolean
     */
    public function getEnchantCurse()
    {
        return $this->enchantCurse;
    }

    /**
     * Set enchantSlow
     *
     * @param boolean $enchantSlow
     *
     * @return MobProtoOld
     */
    public function setEnchantSlow($enchantSlow)
    {
        $this->enchantSlow = $enchantSlow;

        return $this;
    }

    /**
     * Get enchantSlow
     *
     * @return boolean
     */
    public function getEnchantSlow()
    {
        return $this->enchantSlow;
    }

    /**
     * Set enchantPoison
     *
     * @param boolean $enchantPoison
     *
     * @return MobProtoOld
     */
    public function setEnchantPoison($enchantPoison)
    {
        $this->enchantPoison = $enchantPoison;

        return $this;
    }

    /**
     * Get enchantPoison
     *
     * @return boolean
     */
    public function getEnchantPoison()
    {
        return $this->enchantPoison;
    }

    /**
     * Set enchantStun
     *
     * @param boolean $enchantStun
     *
     * @return MobProtoOld
     */
    public function setEnchantStun($enchantStun)
    {
        $this->enchantStun = $enchantStun;

        return $this;
    }

    /**
     * Get enchantStun
     *
     * @return boolean
     */
    public function getEnchantStun()
    {
        return $this->enchantStun;
    }

    /**
     * Set enchantCritical
     *
     * @param boolean $enchantCritical
     *
     * @return MobProtoOld
     */
    public function setEnchantCritical($enchantCritical)
    {
        $this->enchantCritical = $enchantCritical;

        return $this;
    }

    /**
     * Get enchantCritical
     *
     * @return boolean
     */
    public function getEnchantCritical()
    {
        return $this->enchantCritical;
    }

    /**
     * Set enchantPenetrate
     *
     * @param boolean $enchantPenetrate
     *
     * @return MobProtoOld
     */
    public function setEnchantPenetrate($enchantPenetrate)
    {
        $this->enchantPenetrate = $enchantPenetrate;

        return $this;
    }

    /**
     * Get enchantPenetrate
     *
     * @return boolean
     */
    public function getEnchantPenetrate()
    {
        return $this->enchantPenetrate;
    }

    /**
     * Set resistSword
     *
     * @param boolean $resistSword
     *
     * @return MobProtoOld
     */
    public function setResistSword($resistSword)
    {
        $this->resistSword = $resistSword;

        return $this;
    }

    /**
     * Get resistSword
     *
     * @return boolean
     */
    public function getResistSword()
    {
        return $this->resistSword;
    }

    /**
     * Set resistTwohand
     *
     * @param boolean $resistTwohand
     *
     * @return MobProtoOld
     */
    public function setResistTwohand($resistTwohand)
    {
        $this->resistTwohand = $resistTwohand;

        return $this;
    }

    /**
     * Get resistTwohand
     *
     * @return boolean
     */
    public function getResistTwohand()
    {
        return $this->resistTwohand;
    }

    /**
     * Set resistDagger
     *
     * @param boolean $resistDagger
     *
     * @return MobProtoOld
     */
    public function setResistDagger($resistDagger)
    {
        $this->resistDagger = $resistDagger;

        return $this;
    }

    /**
     * Get resistDagger
     *
     * @return boolean
     */
    public function getResistDagger()
    {
        return $this->resistDagger;
    }

    /**
     * Set resistBell
     *
     * @param boolean $resistBell
     *
     * @return MobProtoOld
     */
    public function setResistBell($resistBell)
    {
        $this->resistBell = $resistBell;

        return $this;
    }

    /**
     * Get resistBell
     *
     * @return boolean
     */
    public function getResistBell()
    {
        return $this->resistBell;
    }

    /**
     * Set resistFan
     *
     * @param boolean $resistFan
     *
     * @return MobProtoOld
     */
    public function setResistFan($resistFan)
    {
        $this->resistFan = $resistFan;

        return $this;
    }

    /**
     * Get resistFan
     *
     * @return boolean
     */
    public function getResistFan()
    {
        return $this->resistFan;
    }

    /**
     * Set resistBow
     *
     * @param boolean $resistBow
     *
     * @return MobProtoOld
     */
    public function setResistBow($resistBow)
    {
        $this->resistBow = $resistBow;

        return $this;
    }

    /**
     * Get resistBow
     *
     * @return boolean
     */
    public function getResistBow()
    {
        return $this->resistBow;
    }

    /**
     * Set resistFire
     *
     * @param boolean $resistFire
     *
     * @return MobProtoOld
     */
    public function setResistFire($resistFire)
    {
        $this->resistFire = $resistFire;

        return $this;
    }

    /**
     * Get resistFire
     *
     * @return boolean
     */
    public function getResistFire()
    {
        return $this->resistFire;
    }

    /**
     * Set resistElect
     *
     * @param boolean $resistElect
     *
     * @return MobProtoOld
     */
    public function setResistElect($resistElect)
    {
        $this->resistElect = $resistElect;

        return $this;
    }

    /**
     * Get resistElect
     *
     * @return boolean
     */
    public function getResistElect()
    {
        return $this->resistElect;
    }

    /**
     * Set resistMagic
     *
     * @param boolean $resistMagic
     *
     * @return MobProtoOld
     */
    public function setResistMagic($resistMagic)
    {
        $this->resistMagic = $resistMagic;

        return $this;
    }

    /**
     * Get resistMagic
     *
     * @return boolean
     */
    public function getResistMagic()
    {
        return $this->resistMagic;
    }

    /**
     * Set resistWind
     *
     * @param boolean $resistWind
     *
     * @return MobProtoOld
     */
    public function setResistWind($resistWind)
    {
        $this->resistWind = $resistWind;

        return $this;
    }

    /**
     * Get resistWind
     *
     * @return boolean
     */
    public function getResistWind()
    {
        return $this->resistWind;
    }

    /**
     * Set resistPoison
     *
     * @param boolean $resistPoison
     *
     * @return MobProtoOld
     */
    public function setResistPoison($resistPoison)
    {
        $this->resistPoison = $resistPoison;

        return $this;
    }

    /**
     * Get resistPoison
     *
     * @return boolean
     */
    public function getResistPoison()
    {
        return $this->resistPoison;
    }

    /**
     * Set damMultiply
     *
     * @param float $damMultiply
     *
     * @return MobProtoOld
     */
    public function setDamMultiply($damMultiply)
    {
        $this->damMultiply = $damMultiply;

        return $this;
    }

    /**
     * Get damMultiply
     *
     * @return float
     */
    public function getDamMultiply()
    {
        return $this->damMultiply;
    }

    /**
     * Set summon
     *
     * @param integer $summon
     *
     * @return MobProtoOld
     */
    public function setSummon($summon)
    {
        $this->summon = $summon;

        return $this;
    }

    /**
     * Get summon
     *
     * @return integer
     */
    public function getSummon()
    {
        return $this->summon;
    }

    /**
     * Set drainSp
     *
     * @param integer $drainSp
     *
     * @return MobProtoOld
     */
    public function setDrainSp($drainSp)
    {
        $this->drainSp = $drainSp;

        return $this;
    }

    /**
     * Get drainSp
     *
     * @return integer
     */
    public function getDrainSp()
    {
        return $this->drainSp;
    }

    /**
     * Set mobColor
     *
     * @param integer $mobColor
     *
     * @return MobProtoOld
     */
    public function setMobColor($mobColor)
    {
        $this->mobColor = $mobColor;

        return $this;
    }

    /**
     * Get mobColor
     *
     * @return integer
     */
    public function getMobColor()
    {
        return $this->mobColor;
    }

    /**
     * Set polymorphItem
     *
     * @param integer $polymorphItem
     *
     * @return MobProtoOld
     */
    public function setPolymorphItem($polymorphItem)
    {
        $this->polymorphItem = $polymorphItem;

        return $this;
    }

    /**
     * Get polymorphItem
     *
     * @return integer
     */
    public function getPolymorphItem()
    {
        return $this->polymorphItem;
    }

    /**
     * Set skillLevel0
     *
     * @param boolean $skillLevel0
     *
     * @return MobProtoOld
     */
    public function setSkillLevel0($skillLevel0)
    {
        $this->skillLevel0 = $skillLevel0;

        return $this;
    }

    /**
     * Get skillLevel0
     *
     * @return boolean
     */
    public function getSkillLevel0()
    {
        return $this->skillLevel0;
    }

    /**
     * Set skillVnum0
     *
     * @param integer $skillVnum0
     *
     * @return MobProtoOld
     */
    public function setSkillVnum0($skillVnum0)
    {
        $this->skillVnum0 = $skillVnum0;

        return $this;
    }

    /**
     * Get skillVnum0
     *
     * @return integer
     */
    public function getSkillVnum0()
    {
        return $this->skillVnum0;
    }

    /**
     * Set skillLevel1
     *
     * @param boolean $skillLevel1
     *
     * @return MobProtoOld
     */
    public function setSkillLevel1($skillLevel1)
    {
        $this->skillLevel1 = $skillLevel1;

        return $this;
    }

    /**
     * Get skillLevel1
     *
     * @return boolean
     */
    public function getSkillLevel1()
    {
        return $this->skillLevel1;
    }

    /**
     * Set skillVnum1
     *
     * @param integer $skillVnum1
     *
     * @return MobProtoOld
     */
    public function setSkillVnum1($skillVnum1)
    {
        $this->skillVnum1 = $skillVnum1;

        return $this;
    }

    /**
     * Get skillVnum1
     *
     * @return integer
     */
    public function getSkillVnum1()
    {
        return $this->skillVnum1;
    }

    /**
     * Set spBerserk
     *
     * @param boolean $spBerserk
     *
     * @return MobProtoOld
     */
    public function setSpBerserk($spBerserk)
    {
        $this->spBerserk = $spBerserk;

        return $this;
    }

    /**
     * Get spBerserk
     *
     * @return boolean
     */
    public function getSpBerserk()
    {
        return $this->spBerserk;
    }

    /**
     * Set spStoneskin
     *
     * @param boolean $spStoneskin
     *
     * @return MobProtoOld
     */
    public function setSpStoneskin($spStoneskin)
    {
        $this->spStoneskin = $spStoneskin;

        return $this;
    }

    /**
     * Get spStoneskin
     *
     * @return boolean
     */
    public function getSpStoneskin()
    {
        return $this->spStoneskin;
    }

    /**
     * Set spGodspeed
     *
     * @param boolean $spGodspeed
     *
     * @return MobProtoOld
     */
    public function setSpGodspeed($spGodspeed)
    {
        $this->spGodspeed = $spGodspeed;

        return $this;
    }

    /**
     * Get spGodspeed
     *
     * @return boolean
     */
    public function getSpGodspeed()
    {
        return $this->spGodspeed;
    }

    /**
     * Set spDeathblow
     *
     * @param boolean $spDeathblow
     *
     * @return MobProtoOld
     */
    public function setSpDeathblow($spDeathblow)
    {
        $this->spDeathblow = $spDeathblow;

        return $this;
    }

    /**
     * Get spDeathblow
     *
     * @return boolean
     */
    public function getSpDeathblow()
    {
        return $this->spDeathblow;
    }

    /**
     * Set spRevive
     *
     * @param boolean $spRevive
     *
     * @return MobProtoOld
     */
    public function setSpRevive($spRevive)
    {
        $this->spRevive = $spRevive;

        return $this;
    }

    /**
     * Get spRevive
     *
     * @return boolean
     */
    public function getSpRevive()
    {
        return $this->spRevive;
    }

    /**
     * Set skillLevel2
     *
     * @param boolean $skillLevel2
     *
     * @return MobProtoOld
     */
    public function setSkillLevel2($skillLevel2)
    {
        $this->skillLevel2 = $skillLevel2;

        return $this;
    }

    /**
     * Get skillLevel2
     *
     * @return boolean
     */
    public function getSkillLevel2()
    {
        return $this->skillLevel2;
    }

    /**
     * Set skillVnum2
     *
     * @param integer $skillVnum2
     *
     * @return MobProtoOld
     */
    public function setSkillVnum2($skillVnum2)
    {
        $this->skillVnum2 = $skillVnum2;

        return $this;
    }

    /**
     * Get skillVnum2
     *
     * @return integer
     */
    public function getSkillVnum2()
    {
        return $this->skillVnum2;
    }

    /**
     * Set skillLevel3
     *
     * @param boolean $skillLevel3
     *
     * @return MobProtoOld
     */
    public function setSkillLevel3($skillLevel3)
    {
        $this->skillLevel3 = $skillLevel3;

        return $this;
    }

    /**
     * Get skillLevel3
     *
     * @return boolean
     */
    public function getSkillLevel3()
    {
        return $this->skillLevel3;
    }

    /**
     * Set skillVnum3
     *
     * @param integer $skillVnum3
     *
     * @return MobProtoOld
     */
    public function setSkillVnum3($skillVnum3)
    {
        $this->skillVnum3 = $skillVnum3;

        return $this;
    }

    /**
     * Get skillVnum3
     *
     * @return integer
     */
    public function getSkillVnum3()
    {
        return $this->skillVnum3;
    }

    /**
     * Set skillLevel4
     *
     * @param boolean $skillLevel4
     *
     * @return MobProtoOld
     */
    public function setSkillLevel4($skillLevel4)
    {
        $this->skillLevel4 = $skillLevel4;

        return $this;
    }

    /**
     * Get skillLevel4
     *
     * @return boolean
     */
    public function getSkillLevel4()
    {
        return $this->skillLevel4;
    }

    /**
     * Set skillVnum4
     *
     * @param integer $skillVnum4
     *
     * @return MobProtoOld
     */
    public function setSkillVnum4($skillVnum4)
    {
        $this->skillVnum4 = $skillVnum4;

        return $this;
    }

    /**
     * Get skillVnum4
     *
     * @return integer
     */
    public function getSkillVnum4()
    {
        return $this->skillVnum4;
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
