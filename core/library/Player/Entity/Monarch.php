<?php

namespace Player\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Monarch
 *
 * @ORM\Table(name="monarch")
 * @ORM\Entity
 */
class Monarch
{
    /**
     * @var integer
     *
     * @ORM\Column(name="pid", type="integer", nullable=true)
     */
    private $pid = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=16, nullable=true)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="windate", type="datetime", nullable=true)
     */
    private $windate = '0000-00-00 00:00:00';

    /**
     * @var integer
     *
     * @ORM\Column(name="money", type="bigint", nullable=true)
     */
    private $money = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="empire", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $empire;



    /**
     * Set pid
     *
     * @param integer $pid
     *
     * @return Monarch
     */
    public function setPid($pid)
    {
        $this->pid = $pid;

        return $this;
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

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Monarch
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
     * Set windate
     *
     * @param \DateTime $windate
     *
     * @return Monarch
     */
    public function setWindate($windate)
    {
        $this->windate = $windate;

        return $this;
    }

    /**
     * Get windate
     *
     * @return \DateTime
     */
    public function getWindate()
    {
        return $this->windate;
    }

    /**
     * Set money
     *
     * @param integer $money
     *
     * @return Monarch
     */
    public function setMoney($money)
    {
        $this->money = $money;

        return $this;
    }

    /**
     * Get money
     *
     * @return integer
     */
    public function getMoney()
    {
        return $this->money;
    }

    /**
     * Get empire
     *
     * @return integer
     */
    public function getEmpire()
    {
        return $this->empire;
    }
}
