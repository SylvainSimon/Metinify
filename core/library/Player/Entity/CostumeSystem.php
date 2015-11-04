<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CostumeSystem
 *
 * @ORM\Table(name="costume_system")
 * @ORM\Entity
 */
class CostumeSystem
{
    /**
     * @var integer
     *
     * @ORM\Column(name="part_main", type="integer", nullable=false)
     */
    private $partMain;

    /**
     * @var integer
     *
     * @ORM\Column(name="part_base", type="integer", nullable=false)
     */
    private $partBase;

    /**
     * @var integer
     *
     * @ORM\Column(name="part_hair", type="integer", nullable=false)
     */
    private $partHair;

    /**
     * @var integer
     *
     * @ORM\Column(name="part_main_old", type="integer", nullable=false)
     */
    private $partMainOld;

    /**
     * @var integer
     *
     * @ORM\Column(name="part_base_old", type="integer", nullable=false)
     */
    private $partBaseOld;

    /**
     * @var integer
     *
     * @ORM\Column(name="part_hair_old", type="integer", nullable=false)
     */
    private $partHairOld;

    /**
     * @var integer
     *
     * @ORM\Column(name="pid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $pid;



    /**
     * Set partMain
     *
     * @param integer $partMain
     *
     * @return CostumeSystem
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
     * @param integer $partBase
     *
     * @return CostumeSystem
     */
    public function setPartBase($partBase)
    {
        $this->partBase = $partBase;

        return $this;
    }

    /**
     * Get partBase
     *
     * @return integer
     */
    public function getPartBase()
    {
        return $this->partBase;
    }

    /**
     * Set partHair
     *
     * @param integer $partHair
     *
     * @return CostumeSystem
     */
    public function setPartHair($partHair)
    {
        $this->partHair = $partHair;

        return $this;
    }

    /**
     * Get partHair
     *
     * @return integer
     */
    public function getPartHair()
    {
        return $this->partHair;
    }

    /**
     * Set partMainOld
     *
     * @param integer $partMainOld
     *
     * @return CostumeSystem
     */
    public function setPartMainOld($partMainOld)
    {
        $this->partMainOld = $partMainOld;

        return $this;
    }

    /**
     * Get partMainOld
     *
     * @return integer
     */
    public function getPartMainOld()
    {
        return $this->partMainOld;
    }

    /**
     * Set partBaseOld
     *
     * @param integer $partBaseOld
     *
     * @return CostumeSystem
     */
    public function setPartBaseOld($partBaseOld)
    {
        $this->partBaseOld = $partBaseOld;

        return $this;
    }

    /**
     * Get partBaseOld
     *
     * @return integer
     */
    public function getPartBaseOld()
    {
        return $this->partBaseOld;
    }

    /**
     * Set partHairOld
     *
     * @param integer $partHairOld
     *
     * @return CostumeSystem
     */
    public function setPartHairOld($partHairOld)
    {
        $this->partHairOld = $partHairOld;

        return $this;
    }

    /**
     * Get partHairOld
     *
     * @return integer
     */
    public function getPartHairOld()
    {
        return $this->partHairOld;
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
}
