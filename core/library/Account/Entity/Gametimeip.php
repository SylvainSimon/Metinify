<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gametimeip
 *
 * @ORM\Table(name="gametimeip", uniqueConstraints={@ORM\UniqueConstraint(name="ip_uniq", columns={"ip", "startIP", "endIP"})}, indexes={@ORM\Index(name="ip_idx", columns={"ip"})})
 * @ORM\Entity
 */
class Gametimeip
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=128, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=11, nullable=false)
     */
    private $ip = '000.000.000';

    /**
     * @var integer
     *
     * @ORM\Column(name="startIP", type="integer", nullable=false)
     */
    private $startip = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="endIP", type="integer", nullable=false)
     */
    private $endip = '255';

    /**
     * @var boolean
     *
     * @ORM\Column(name="paymenttype", type="boolean", nullable=false)
     */
    private $paymenttype = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="LimitTime", type="integer", nullable=false)
     */
    private $limittime = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="LimitDt", type="datetime", nullable=false)
     */
    private $limitdt = '0000-00-00 00:00:00';

    /**
     * @var string
     *
     * @ORM\Column(name="readme", type="string", length=128, nullable=true)
     */
    private $readme;

    /**
     * @var integer
     *
     * @ORM\Column(name="ipid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $ipid;



    /**
     * Set name
     *
     * @param string $name
     *
     * @return Gametimeip
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
     * Set ip
     *
     * @param string $ip
     *
     * @return Gametimeip
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
     * Set startip
     *
     * @param integer $startip
     *
     * @return Gametimeip
     */
    public function setStartip($startip)
    {
        $this->startip = $startip;

        return $this;
    }

    /**
     * Get startip
     *
     * @return integer
     */
    public function getStartip()
    {
        return $this->startip;
    }

    /**
     * Set endip
     *
     * @param integer $endip
     *
     * @return Gametimeip
     */
    public function setEndip($endip)
    {
        $this->endip = $endip;

        return $this;
    }

    /**
     * Get endip
     *
     * @return integer
     */
    public function getEndip()
    {
        return $this->endip;
    }

    /**
     * Set paymenttype
     *
     * @param boolean $paymenttype
     *
     * @return Gametimeip
     */
    public function setPaymenttype($paymenttype)
    {
        $this->paymenttype = $paymenttype;

        return $this;
    }

    /**
     * Get paymenttype
     *
     * @return boolean
     */
    public function getPaymenttype()
    {
        return $this->paymenttype;
    }

    /**
     * Set limittime
     *
     * @param integer $limittime
     *
     * @return Gametimeip
     */
    public function setLimittime($limittime)
    {
        $this->limittime = $limittime;

        return $this;
    }

    /**
     * Get limittime
     *
     * @return integer
     */
    public function getLimittime()
    {
        return $this->limittime;
    }

    /**
     * Set limitdt
     *
     * @param \DateTime $limitdt
     *
     * @return Gametimeip
     */
    public function setLimitdt($limitdt)
    {
        $this->limitdt = $limitdt;

        return $this;
    }

    /**
     * Get limitdt
     *
     * @return \DateTime
     */
    public function getLimitdt()
    {
        return $this->limitdt;
    }

    /**
     * Set readme
     *
     * @param string $readme
     *
     * @return Gametimeip
     */
    public function setReadme($readme)
    {
        $this->readme = $readme;

        return $this;
    }

    /**
     * Get readme
     *
     * @return string
     */
    public function getReadme()
    {
        return $this->readme;
    }

    /**
     * Get ipid
     *
     * @return integer
     */
    public function getIpid()
    {
        return $this->ipid;
    }
}
