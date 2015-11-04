<?php

namespace Player\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SkillProto
 *
 * @ORM\Table(name="skill_proto")
 * @ORM\Entity
 */
class SkillProto
{
    /**
     * @var binary
     *
     * @ORM\Column(name="szName", type="binary", nullable=false)
     */
    private $szname = '';

    /**
     * @var boolean
     *
     * @ORM\Column(name="bType", type="boolean", nullable=false)
     */
    private $btype = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="bLevelStep", type="boolean", nullable=false)
     */
    private $blevelstep = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="bMaxLevel", type="boolean", nullable=false)
     */
    private $bmaxlevel = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="bLevelLimit", type="boolean", nullable=false)
     */
    private $blevellimit = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="szPointOn", type="string", length=100, nullable=false)
     */
    private $szpointon = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="szPointPoly", type="string", length=100, nullable=false)
     */
    private $szpointpoly = '';

    /**
     * @var string
     *
     * @ORM\Column(name="szSPCostPoly", type="string", length=100, nullable=false)
     */
    private $szspcostpoly = '';

    /**
     * @var string
     *
     * @ORM\Column(name="szDurationPoly", type="string", length=100, nullable=false)
     */
    private $szdurationpoly = '';

    /**
     * @var string
     *
     * @ORM\Column(name="szDurationSPCostPoly", type="string", length=100, nullable=false)
     */
    private $szdurationspcostpoly = '';

    /**
     * @var string
     *
     * @ORM\Column(name="szCooldownPoly", type="string", length=100, nullable=false)
     */
    private $szcooldownpoly = '';

    /**
     * @var string
     *
     * @ORM\Column(name="szMasterBonusPoly", type="string", length=100, nullable=false)
     */
    private $szmasterbonuspoly = '';

    /**
     * @var string
     *
     * @ORM\Column(name="szAttackGradePoly", type="string", length=100, nullable=false)
     */
    private $szattackgradepoly = '';

    /**
     * @var array
     *
     * @ORM\Column(name="setFlag", type="simple_array", nullable=true)
     */
    private $setflag;

    /**
     * @var string
     *
     * @ORM\Column(name="setAffectFlag", type="string", nullable=false)
     */
    private $setaffectflag = 'YMIR';

    /**
     * @var string
     *
     * @ORM\Column(name="szPointOn2", type="string", length=100, nullable=false)
     */
    private $szpointon2 = 'NONE';

    /**
     * @var string
     *
     * @ORM\Column(name="szPointPoly2", type="string", length=100, nullable=false)
     */
    private $szpointpoly2 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="szDurationPoly2", type="string", length=100, nullable=false)
     */
    private $szdurationpoly2 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="setAffectFlag2", type="string", nullable=false)
     */
    private $setaffectflag2 = 'YMIR';

    /**
     * @var string
     *
     * @ORM\Column(name="szPointOn3", type="string", length=100, nullable=false)
     */
    private $szpointon3 = 'NONE';

    /**
     * @var string
     *
     * @ORM\Column(name="szPointPoly3", type="string", length=100, nullable=false)
     */
    private $szpointpoly3 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="szDurationPoly3", type="string", length=100, nullable=false)
     */
    private $szdurationpoly3 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="szGrandMasterAddSPCostPoly", type="string", length=100, nullable=false)
     */
    private $szgrandmasteraddspcostpoly = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="prerequisiteSkillVnum", type="integer", nullable=false)
     */
    private $prerequisiteskillvnum = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="prerequisiteSkillLevel", type="integer", nullable=false)
     */
    private $prerequisiteskilllevel = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="eSkillType", type="string", nullable=false)
     */
    private $eskilltype = 'NORMAL';

    /**
     * @var boolean
     *
     * @ORM\Column(name="iMaxHit", type="boolean", nullable=false)
     */
    private $imaxhit = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="szSplashAroundDamageAdjustPoly", type="string", length=100, nullable=false)
     */
    private $szsplasharounddamageadjustpoly = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="dwTargetRange", type="integer", nullable=false)
     */
    private $dwtargetrange = '1000';

    /**
     * @var integer
     *
     * @ORM\Column(name="dwSplashRange", type="integer", nullable=false)
     */
    private $dwsplashrange = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="dwVnum", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $dwvnum;



    /**
     * Set szname
     *
     * @param binary $szname
     *
     * @return SkillProto
     */
    public function setSzname($szname)
    {
        $this->szname = $szname;

        return $this;
    }

    /**
     * Get szname
     *
     * @return binary
     */
    public function getSzname()
    {
        return $this->szname;
    }

    /**
     * Set btype
     *
     * @param boolean $btype
     *
     * @return SkillProto
     */
    public function setBtype($btype)
    {
        $this->btype = $btype;

        return $this;
    }

    /**
     * Get btype
     *
     * @return boolean
     */
    public function getBtype()
    {
        return $this->btype;
    }

    /**
     * Set blevelstep
     *
     * @param boolean $blevelstep
     *
     * @return SkillProto
     */
    public function setBlevelstep($blevelstep)
    {
        $this->blevelstep = $blevelstep;

        return $this;
    }

    /**
     * Get blevelstep
     *
     * @return boolean
     */
    public function getBlevelstep()
    {
        return $this->blevelstep;
    }

    /**
     * Set bmaxlevel
     *
     * @param boolean $bmaxlevel
     *
     * @return SkillProto
     */
    public function setBmaxlevel($bmaxlevel)
    {
        $this->bmaxlevel = $bmaxlevel;

        return $this;
    }

    /**
     * Get bmaxlevel
     *
     * @return boolean
     */
    public function getBmaxlevel()
    {
        return $this->bmaxlevel;
    }

    /**
     * Set blevellimit
     *
     * @param boolean $blevellimit
     *
     * @return SkillProto
     */
    public function setBlevellimit($blevellimit)
    {
        $this->blevellimit = $blevellimit;

        return $this;
    }

    /**
     * Get blevellimit
     *
     * @return boolean
     */
    public function getBlevellimit()
    {
        return $this->blevellimit;
    }

    /**
     * Set szpointon
     *
     * @param string $szpointon
     *
     * @return SkillProto
     */
    public function setSzpointon($szpointon)
    {
        $this->szpointon = $szpointon;

        return $this;
    }

    /**
     * Get szpointon
     *
     * @return string
     */
    public function getSzpointon()
    {
        return $this->szpointon;
    }

    /**
     * Set szpointpoly
     *
     * @param string $szpointpoly
     *
     * @return SkillProto
     */
    public function setSzpointpoly($szpointpoly)
    {
        $this->szpointpoly = $szpointpoly;

        return $this;
    }

    /**
     * Get szpointpoly
     *
     * @return string
     */
    public function getSzpointpoly()
    {
        return $this->szpointpoly;
    }

    /**
     * Set szspcostpoly
     *
     * @param string $szspcostpoly
     *
     * @return SkillProto
     */
    public function setSzspcostpoly($szspcostpoly)
    {
        $this->szspcostpoly = $szspcostpoly;

        return $this;
    }

    /**
     * Get szspcostpoly
     *
     * @return string
     */
    public function getSzspcostpoly()
    {
        return $this->szspcostpoly;
    }

    /**
     * Set szdurationpoly
     *
     * @param string $szdurationpoly
     *
     * @return SkillProto
     */
    public function setSzdurationpoly($szdurationpoly)
    {
        $this->szdurationpoly = $szdurationpoly;

        return $this;
    }

    /**
     * Get szdurationpoly
     *
     * @return string
     */
    public function getSzdurationpoly()
    {
        return $this->szdurationpoly;
    }

    /**
     * Set szdurationspcostpoly
     *
     * @param string $szdurationspcostpoly
     *
     * @return SkillProto
     */
    public function setSzdurationspcostpoly($szdurationspcostpoly)
    {
        $this->szdurationspcostpoly = $szdurationspcostpoly;

        return $this;
    }

    /**
     * Get szdurationspcostpoly
     *
     * @return string
     */
    public function getSzdurationspcostpoly()
    {
        return $this->szdurationspcostpoly;
    }

    /**
     * Set szcooldownpoly
     *
     * @param string $szcooldownpoly
     *
     * @return SkillProto
     */
    public function setSzcooldownpoly($szcooldownpoly)
    {
        $this->szcooldownpoly = $szcooldownpoly;

        return $this;
    }

    /**
     * Get szcooldownpoly
     *
     * @return string
     */
    public function getSzcooldownpoly()
    {
        return $this->szcooldownpoly;
    }

    /**
     * Set szmasterbonuspoly
     *
     * @param string $szmasterbonuspoly
     *
     * @return SkillProto
     */
    public function setSzmasterbonuspoly($szmasterbonuspoly)
    {
        $this->szmasterbonuspoly = $szmasterbonuspoly;

        return $this;
    }

    /**
     * Get szmasterbonuspoly
     *
     * @return string
     */
    public function getSzmasterbonuspoly()
    {
        return $this->szmasterbonuspoly;
    }

    /**
     * Set szattackgradepoly
     *
     * @param string $szattackgradepoly
     *
     * @return SkillProto
     */
    public function setSzattackgradepoly($szattackgradepoly)
    {
        $this->szattackgradepoly = $szattackgradepoly;

        return $this;
    }

    /**
     * Get szattackgradepoly
     *
     * @return string
     */
    public function getSzattackgradepoly()
    {
        return $this->szattackgradepoly;
    }

    /**
     * Set setflag
     *
     * @param array $setflag
     *
     * @return SkillProto
     */
    public function setSetflag($setflag)
    {
        $this->setflag = $setflag;

        return $this;
    }

    /**
     * Get setflag
     *
     * @return array
     */
    public function getSetflag()
    {
        return $this->setflag;
    }

    /**
     * Set setaffectflag
     *
     * @param string $setaffectflag
     *
     * @return SkillProto
     */
    public function setSetaffectflag($setaffectflag)
    {
        $this->setaffectflag = $setaffectflag;

        return $this;
    }

    /**
     * Get setaffectflag
     *
     * @return string
     */
    public function getSetaffectflag()
    {
        return $this->setaffectflag;
    }

    /**
     * Set szpointon2
     *
     * @param string $szpointon2
     *
     * @return SkillProto
     */
    public function setSzpointon2($szpointon2)
    {
        $this->szpointon2 = $szpointon2;

        return $this;
    }

    /**
     * Get szpointon2
     *
     * @return string
     */
    public function getSzpointon2()
    {
        return $this->szpointon2;
    }

    /**
     * Set szpointpoly2
     *
     * @param string $szpointpoly2
     *
     * @return SkillProto
     */
    public function setSzpointpoly2($szpointpoly2)
    {
        $this->szpointpoly2 = $szpointpoly2;

        return $this;
    }

    /**
     * Get szpointpoly2
     *
     * @return string
     */
    public function getSzpointpoly2()
    {
        return $this->szpointpoly2;
    }

    /**
     * Set szdurationpoly2
     *
     * @param string $szdurationpoly2
     *
     * @return SkillProto
     */
    public function setSzdurationpoly2($szdurationpoly2)
    {
        $this->szdurationpoly2 = $szdurationpoly2;

        return $this;
    }

    /**
     * Get szdurationpoly2
     *
     * @return string
     */
    public function getSzdurationpoly2()
    {
        return $this->szdurationpoly2;
    }

    /**
     * Set setaffectflag2
     *
     * @param string $setaffectflag2
     *
     * @return SkillProto
     */
    public function setSetaffectflag2($setaffectflag2)
    {
        $this->setaffectflag2 = $setaffectflag2;

        return $this;
    }

    /**
     * Get setaffectflag2
     *
     * @return string
     */
    public function getSetaffectflag2()
    {
        return $this->setaffectflag2;
    }

    /**
     * Set szpointon3
     *
     * @param string $szpointon3
     *
     * @return SkillProto
     */
    public function setSzpointon3($szpointon3)
    {
        $this->szpointon3 = $szpointon3;

        return $this;
    }

    /**
     * Get szpointon3
     *
     * @return string
     */
    public function getSzpointon3()
    {
        return $this->szpointon3;
    }

    /**
     * Set szpointpoly3
     *
     * @param string $szpointpoly3
     *
     * @return SkillProto
     */
    public function setSzpointpoly3($szpointpoly3)
    {
        $this->szpointpoly3 = $szpointpoly3;

        return $this;
    }

    /**
     * Get szpointpoly3
     *
     * @return string
     */
    public function getSzpointpoly3()
    {
        return $this->szpointpoly3;
    }

    /**
     * Set szdurationpoly3
     *
     * @param string $szdurationpoly3
     *
     * @return SkillProto
     */
    public function setSzdurationpoly3($szdurationpoly3)
    {
        $this->szdurationpoly3 = $szdurationpoly3;

        return $this;
    }

    /**
     * Get szdurationpoly3
     *
     * @return string
     */
    public function getSzdurationpoly3()
    {
        return $this->szdurationpoly3;
    }

    /**
     * Set szgrandmasteraddspcostpoly
     *
     * @param string $szgrandmasteraddspcostpoly
     *
     * @return SkillProto
     */
    public function setSzgrandmasteraddspcostpoly($szgrandmasteraddspcostpoly)
    {
        $this->szgrandmasteraddspcostpoly = $szgrandmasteraddspcostpoly;

        return $this;
    }

    /**
     * Get szgrandmasteraddspcostpoly
     *
     * @return string
     */
    public function getSzgrandmasteraddspcostpoly()
    {
        return $this->szgrandmasteraddspcostpoly;
    }

    /**
     * Set prerequisiteskillvnum
     *
     * @param integer $prerequisiteskillvnum
     *
     * @return SkillProto
     */
    public function setPrerequisiteskillvnum($prerequisiteskillvnum)
    {
        $this->prerequisiteskillvnum = $prerequisiteskillvnum;

        return $this;
    }

    /**
     * Get prerequisiteskillvnum
     *
     * @return integer
     */
    public function getPrerequisiteskillvnum()
    {
        return $this->prerequisiteskillvnum;
    }

    /**
     * Set prerequisiteskilllevel
     *
     * @param integer $prerequisiteskilllevel
     *
     * @return SkillProto
     */
    public function setPrerequisiteskilllevel($prerequisiteskilllevel)
    {
        $this->prerequisiteskilllevel = $prerequisiteskilllevel;

        return $this;
    }

    /**
     * Get prerequisiteskilllevel
     *
     * @return integer
     */
    public function getPrerequisiteskilllevel()
    {
        return $this->prerequisiteskilllevel;
    }

    /**
     * Set eskilltype
     *
     * @param string $eskilltype
     *
     * @return SkillProto
     */
    public function setEskilltype($eskilltype)
    {
        $this->eskilltype = $eskilltype;

        return $this;
    }

    /**
     * Get eskilltype
     *
     * @return string
     */
    public function getEskilltype()
    {
        return $this->eskilltype;
    }

    /**
     * Set imaxhit
     *
     * @param boolean $imaxhit
     *
     * @return SkillProto
     */
    public function setImaxhit($imaxhit)
    {
        $this->imaxhit = $imaxhit;

        return $this;
    }

    /**
     * Get imaxhit
     *
     * @return boolean
     */
    public function getImaxhit()
    {
        return $this->imaxhit;
    }

    /**
     * Set szsplasharounddamageadjustpoly
     *
     * @param string $szsplasharounddamageadjustpoly
     *
     * @return SkillProto
     */
    public function setSzsplasharounddamageadjustpoly($szsplasharounddamageadjustpoly)
    {
        $this->szsplasharounddamageadjustpoly = $szsplasharounddamageadjustpoly;

        return $this;
    }

    /**
     * Get szsplasharounddamageadjustpoly
     *
     * @return string
     */
    public function getSzsplasharounddamageadjustpoly()
    {
        return $this->szsplasharounddamageadjustpoly;
    }

    /**
     * Set dwtargetrange
     *
     * @param integer $dwtargetrange
     *
     * @return SkillProto
     */
    public function setDwtargetrange($dwtargetrange)
    {
        $this->dwtargetrange = $dwtargetrange;

        return $this;
    }

    /**
     * Get dwtargetrange
     *
     * @return integer
     */
    public function getDwtargetrange()
    {
        return $this->dwtargetrange;
    }

    /**
     * Set dwsplashrange
     *
     * @param integer $dwsplashrange
     *
     * @return SkillProto
     */
    public function setDwsplashrange($dwsplashrange)
    {
        $this->dwsplashrange = $dwsplashrange;

        return $this;
    }

    /**
     * Get dwsplashrange
     *
     * @return integer
     */
    public function getDwsplashrange()
    {
        return $this->dwsplashrange;
    }

    /**
     * Get dwvnum
     *
     * @return integer
     */
    public function getDwvnum()
    {
        return $this->dwvnum;
    }
}
