<?php

namespace Player\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Marriage
 *
 * @ORM\Table(name="player.marriage")
 * @ORM\Entity(repositoryClass="Player\Repository\MarriageRepository")
 */
class Marriage
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="is_married", type="boolean", nullable=false)
     */
    private $isMarried = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="love_point", type="integer", nullable=true)
     */
    private $lovePoint = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="datetime", nullable=false)
     */
    private $time = '0000-00-00 00:00:00';

    /**
     * @var integer
     *
     * @ORM\Column(name="pid1", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $pid1;

    /**
     * @var integer
     *
     * @ORM\Column(name="pid2", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $pid2;



    /**
     * Set isMarried
     *
     * @param boolean $isMarried
     *
     * @return Marriage
     */
    public function setIsMarried($isMarried)
    {
        $this->isMarried = $isMarried;

        return $this;
    }

    /**
     * Get isMarried
     *
     * @return boolean
     */
    public function getIsMarried()
    {
        return $this->isMarried;
    }

    /**
     * Set lovePoint
     *
     * @param integer $lovePoint
     *
     * @return Marriage
     */
    public function setLovePoint($lovePoint)
    {
        $this->lovePoint = $lovePoint;

        return $this;
    }

    /**
     * Get lovePoint
     *
     * @return integer
     */
    public function getLovePoint()
    {
        return $this->lovePoint;
    }

    /**
     * Set time
     *
     * @param \DateTime $time
     *
     * @return Marriage
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set pid1
     *
     * @param integer $pid1
     *
     * @return Marriage
     */
    public function setPid1($pid1)
    {
        $this->pid1 = $pid1;

        return $this;
    }

    /**
     * Get pid1
     *
     * @return integer
     */
    public function getPid1()
    {
        return $this->pid1;
    }

    /**
     * Set pid2
     *
     * @param integer $pid2
     *
     * @return Marriage
     */
    public function setPid2($pid2)
    {
        $this->pid2 = $pid2;

        return $this;
    }

    /**
     * Get pid2
     *
     * @return integer
     */
    public function getPid2()
    {
        return $this->pid2;
    }
}
