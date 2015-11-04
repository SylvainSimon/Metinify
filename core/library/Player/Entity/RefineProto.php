<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RefineProto
 *
 * @ORM\Table(name="refine_proto")
 * @ORM\Entity
 */
class RefineProto
{
    /**
     * @var integer
     *
     * @ORM\Column(name="vnum0", type="integer", nullable=false)
     */
    private $vnum0 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="count0", type="smallint", nullable=false)
     */
    private $count0 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="vnum1", type="integer", nullable=false)
     */
    private $vnum1 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="count1", type="smallint", nullable=false)
     */
    private $count1 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="vnum2", type="integer", nullable=false)
     */
    private $vnum2 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="count2", type="smallint", nullable=false)
     */
    private $count2 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="vnum3", type="integer", nullable=false)
     */
    private $vnum3 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="count3", type="smallint", nullable=false)
     */
    private $count3 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="vnum4", type="integer", nullable=false)
     */
    private $vnum4 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="count4", type="smallint", nullable=false)
     */
    private $count4 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="cost", type="integer", nullable=false)
     */
    private $cost = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="src_vnum", type="integer", nullable=false)
     */
    private $srcVnum = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="result_vnum", type="integer", nullable=false)
     */
    private $resultVnum = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="prob", type="smallint", nullable=false)
     */
    private $prob = '100';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set vnum0
     *
     * @param integer $vnum0
     *
     * @return RefineProto
     */
    public function setVnum0($vnum0)
    {
        $this->vnum0 = $vnum0;

        return $this;
    }

    /**
     * Get vnum0
     *
     * @return integer
     */
    public function getVnum0()
    {
        return $this->vnum0;
    }

    /**
     * Set count0
     *
     * @param integer $count0
     *
     * @return RefineProto
     */
    public function setCount0($count0)
    {
        $this->count0 = $count0;

        return $this;
    }

    /**
     * Get count0
     *
     * @return integer
     */
    public function getCount0()
    {
        return $this->count0;
    }

    /**
     * Set vnum1
     *
     * @param integer $vnum1
     *
     * @return RefineProto
     */
    public function setVnum1($vnum1)
    {
        $this->vnum1 = $vnum1;

        return $this;
    }

    /**
     * Get vnum1
     *
     * @return integer
     */
    public function getVnum1()
    {
        return $this->vnum1;
    }

    /**
     * Set count1
     *
     * @param integer $count1
     *
     * @return RefineProto
     */
    public function setCount1($count1)
    {
        $this->count1 = $count1;

        return $this;
    }

    /**
     * Get count1
     *
     * @return integer
     */
    public function getCount1()
    {
        return $this->count1;
    }

    /**
     * Set vnum2
     *
     * @param integer $vnum2
     *
     * @return RefineProto
     */
    public function setVnum2($vnum2)
    {
        $this->vnum2 = $vnum2;

        return $this;
    }

    /**
     * Get vnum2
     *
     * @return integer
     */
    public function getVnum2()
    {
        return $this->vnum2;
    }

    /**
     * Set count2
     *
     * @param integer $count2
     *
     * @return RefineProto
     */
    public function setCount2($count2)
    {
        $this->count2 = $count2;

        return $this;
    }

    /**
     * Get count2
     *
     * @return integer
     */
    public function getCount2()
    {
        return $this->count2;
    }

    /**
     * Set vnum3
     *
     * @param integer $vnum3
     *
     * @return RefineProto
     */
    public function setVnum3($vnum3)
    {
        $this->vnum3 = $vnum3;

        return $this;
    }

    /**
     * Get vnum3
     *
     * @return integer
     */
    public function getVnum3()
    {
        return $this->vnum3;
    }

    /**
     * Set count3
     *
     * @param integer $count3
     *
     * @return RefineProto
     */
    public function setCount3($count3)
    {
        $this->count3 = $count3;

        return $this;
    }

    /**
     * Get count3
     *
     * @return integer
     */
    public function getCount3()
    {
        return $this->count3;
    }

    /**
     * Set vnum4
     *
     * @param integer $vnum4
     *
     * @return RefineProto
     */
    public function setVnum4($vnum4)
    {
        $this->vnum4 = $vnum4;

        return $this;
    }

    /**
     * Get vnum4
     *
     * @return integer
     */
    public function getVnum4()
    {
        return $this->vnum4;
    }

    /**
     * Set count4
     *
     * @param integer $count4
     *
     * @return RefineProto
     */
    public function setCount4($count4)
    {
        $this->count4 = $count4;

        return $this;
    }

    /**
     * Get count4
     *
     * @return integer
     */
    public function getCount4()
    {
        return $this->count4;
    }

    /**
     * Set cost
     *
     * @param integer $cost
     *
     * @return RefineProto
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return integer
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set srcVnum
     *
     * @param integer $srcVnum
     *
     * @return RefineProto
     */
    public function setSrcVnum($srcVnum)
    {
        $this->srcVnum = $srcVnum;

        return $this;
    }

    /**
     * Get srcVnum
     *
     * @return integer
     */
    public function getSrcVnum()
    {
        return $this->srcVnum;
    }

    /**
     * Set resultVnum
     *
     * @param integer $resultVnum
     *
     * @return RefineProto
     */
    public function setResultVnum($resultVnum)
    {
        $this->resultVnum = $resultVnum;

        return $this;
    }

    /**
     * Get resultVnum
     *
     * @return integer
     */
    public function getResultVnum()
    {
        return $this->resultVnum;
    }

    /**
     * Set prob
     *
     * @param integer $prob
     *
     * @return RefineProto
     */
    public function setProb($prob)
    {
        $this->prob = $prob;

        return $this;
    }

    /**
     * Get prob
     *
     * @return integer
     */
    public function getProb()
    {
        return $this->prob;
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
