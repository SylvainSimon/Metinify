<?php

namespace Player\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AffectCopy
 *
 * @ORM\Table(name="player.affect_copy")
 * @ORM\Entity
 */
class AffectCopy
{
    /**
     * @var integer
     *
     * @ORM\Column(name="dwFlag", type="integer", nullable=false)
     */
    private $dwflag = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="lDuration", type="integer", nullable=false)
     */
    private $lduration = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="lSPCost", type="integer", nullable=false)
     */
    private $lspcost = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="dwPID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $dwpid;

    /**
     * @var integer
     *
     * @ORM\Column(name="bType", type="smallint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $btype;

    /**
     * @var boolean
     *
     * @ORM\Column(name="bApplyOn", type="boolean")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $bapplyon;

    /**
     * @var integer
     *
     * @ORM\Column(name="lApplyValue", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $lapplyvalue;



    /**
     * Set dwflag
     *
     * @param integer $dwflag
     *
     * @return AffectCopy
     */
    public function setDwflag($dwflag)
    {
        $this->dwflag = $dwflag;

        return $this;
    }

    /**
     * Get dwflag
     *
     * @return integer
     */
    public function getDwflag()
    {
        return $this->dwflag;
    }

    /**
     * Set lduration
     *
     * @param integer $lduration
     *
     * @return AffectCopy
     */
    public function setLduration($lduration)
    {
        $this->lduration = $lduration;

        return $this;
    }

    /**
     * Get lduration
     *
     * @return integer
     */
    public function getLduration()
    {
        return $this->lduration;
    }

    /**
     * Set lspcost
     *
     * @param integer $lspcost
     *
     * @return AffectCopy
     */
    public function setLspcost($lspcost)
    {
        $this->lspcost = $lspcost;

        return $this;
    }

    /**
     * Get lspcost
     *
     * @return integer
     */
    public function getLspcost()
    {
        return $this->lspcost;
    }

    /**
     * Set dwpid
     *
     * @param integer $dwpid
     *
     * @return AffectCopy
     */
    public function setDwpid($dwpid)
    {
        $this->dwpid = $dwpid;

        return $this;
    }

    /**
     * Get dwpid
     *
     * @return integer
     */
    public function getDwpid()
    {
        return $this->dwpid;
    }

    /**
     * Set btype
     *
     * @param integer $btype
     *
     * @return AffectCopy
     */
    public function setBtype($btype)
    {
        $this->btype = $btype;

        return $this;
    }

    /**
     * Get btype
     *
     * @return integer
     */
    public function getBtype()
    {
        return $this->btype;
    }

    /**
     * Set bapplyon
     *
     * @param boolean $bapplyon
     *
     * @return AffectCopy
     */
    public function setBapplyon($bapplyon)
    {
        $this->bapplyon = $bapplyon;

        return $this;
    }

    /**
     * Get bapplyon
     *
     * @return boolean
     */
    public function getBapplyon()
    {
        return $this->bapplyon;
    }

    /**
     * Set lapplyvalue
     *
     * @param integer $lapplyvalue
     *
     * @return AffectCopy
     */
    public function setLapplyvalue($lapplyvalue)
    {
        $this->lapplyvalue = $lapplyvalue;

        return $this;
    }

    /**
     * Get lapplyvalue
     *
     * @return integer
     */
    public function getLapplyvalue()
    {
        return $this->lapplyvalue;
    }
}
