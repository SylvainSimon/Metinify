<?php

namespace Player\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ObjectProto
 *
 * @ORM\Table(name="object_proto")
 * @ORM\Entity
 */
class ObjectProto
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=32, nullable=false)
     */
    private $name = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="price", type="integer", nullable=false)
     */
    private $price = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="materials", type="string", length=64, nullable=false)
     */
    private $materials = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="upgrade_vnum", type="integer", nullable=false)
     */
    private $upgradeVnum = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="upgrade_limit_time", type="integer", nullable=false)
     */
    private $upgradeLimitTime = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="life", type="integer", nullable=false)
     */
    private $life = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="reg_1", type="integer", nullable=false)
     */
    private $reg1 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="reg_2", type="integer", nullable=false)
     */
    private $reg2 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="reg_3", type="integer", nullable=false)
     */
    private $reg3 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="reg_4", type="integer", nullable=false)
     */
    private $reg4 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="npc", type="integer", nullable=false)
     */
    private $npc = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="group_vnum", type="integer", nullable=false)
     */
    private $groupVnum = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="dependent_group", type="integer", nullable=false)
     */
    private $dependentGroup = '0';

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
     * @return ObjectProto
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
     * Set price
     *
     * @param integer $price
     *
     * @return ObjectProto
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set materials
     *
     * @param string $materials
     *
     * @return ObjectProto
     */
    public function setMaterials($materials)
    {
        $this->materials = $materials;

        return $this;
    }

    /**
     * Get materials
     *
     * @return string
     */
    public function getMaterials()
    {
        return $this->materials;
    }

    /**
     * Set upgradeVnum
     *
     * @param integer $upgradeVnum
     *
     * @return ObjectProto
     */
    public function setUpgradeVnum($upgradeVnum)
    {
        $this->upgradeVnum = $upgradeVnum;

        return $this;
    }

    /**
     * Get upgradeVnum
     *
     * @return integer
     */
    public function getUpgradeVnum()
    {
        return $this->upgradeVnum;
    }

    /**
     * Set upgradeLimitTime
     *
     * @param integer $upgradeLimitTime
     *
     * @return ObjectProto
     */
    public function setUpgradeLimitTime($upgradeLimitTime)
    {
        $this->upgradeLimitTime = $upgradeLimitTime;

        return $this;
    }

    /**
     * Get upgradeLimitTime
     *
     * @return integer
     */
    public function getUpgradeLimitTime()
    {
        return $this->upgradeLimitTime;
    }

    /**
     * Set life
     *
     * @param integer $life
     *
     * @return ObjectProto
     */
    public function setLife($life)
    {
        $this->life = $life;

        return $this;
    }

    /**
     * Get life
     *
     * @return integer
     */
    public function getLife()
    {
        return $this->life;
    }

    /**
     * Set reg1
     *
     * @param integer $reg1
     *
     * @return ObjectProto
     */
    public function setReg1($reg1)
    {
        $this->reg1 = $reg1;

        return $this;
    }

    /**
     * Get reg1
     *
     * @return integer
     */
    public function getReg1()
    {
        return $this->reg1;
    }

    /**
     * Set reg2
     *
     * @param integer $reg2
     *
     * @return ObjectProto
     */
    public function setReg2($reg2)
    {
        $this->reg2 = $reg2;

        return $this;
    }

    /**
     * Get reg2
     *
     * @return integer
     */
    public function getReg2()
    {
        return $this->reg2;
    }

    /**
     * Set reg3
     *
     * @param integer $reg3
     *
     * @return ObjectProto
     */
    public function setReg3($reg3)
    {
        $this->reg3 = $reg3;

        return $this;
    }

    /**
     * Get reg3
     *
     * @return integer
     */
    public function getReg3()
    {
        return $this->reg3;
    }

    /**
     * Set reg4
     *
     * @param integer $reg4
     *
     * @return ObjectProto
     */
    public function setReg4($reg4)
    {
        $this->reg4 = $reg4;

        return $this;
    }

    /**
     * Get reg4
     *
     * @return integer
     */
    public function getReg4()
    {
        return $this->reg4;
    }

    /**
     * Set npc
     *
     * @param integer $npc
     *
     * @return ObjectProto
     */
    public function setNpc($npc)
    {
        $this->npc = $npc;

        return $this;
    }

    /**
     * Get npc
     *
     * @return integer
     */
    public function getNpc()
    {
        return $this->npc;
    }

    /**
     * Set groupVnum
     *
     * @param integer $groupVnum
     *
     * @return ObjectProto
     */
    public function setGroupVnum($groupVnum)
    {
        $this->groupVnum = $groupVnum;

        return $this;
    }

    /**
     * Get groupVnum
     *
     * @return integer
     */
    public function getGroupVnum()
    {
        return $this->groupVnum;
    }

    /**
     * Set dependentGroup
     *
     * @param integer $dependentGroup
     *
     * @return ObjectProto
     */
    public function setDependentGroup($dependentGroup)
    {
        $this->dependentGroup = $dependentGroup;

        return $this;
    }

    /**
     * Get dependentGroup
     *
     * @return integer
     */
    public function getDependentGroup()
    {
        return $this->dependentGroup;
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
