<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gametime
 *
 * @ORM\Table(name="gametime")
 * @ORM\Entity
 */
class Gametime
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="paymenttype", type="boolean", nullable=false)
     */
    private $paymenttype = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="LimitTime", type="integer", nullable=true)
     */
    private $limittime = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="LimitDt", type="datetime", nullable=true)
     */
    private $limitdt = '1990-01-01 00:00:00';

    /**
     * @var integer
     *
     * @ORM\Column(name="Scores", type="integer", nullable=true)
     */
    private $scores = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="UserID", type="string", length=50)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userid;



    /**
     * Set paymenttype
     *
     * @param boolean $paymenttype
     *
     * @return Gametime
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
     * @return Gametime
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
     * @return Gametime
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
     * Set scores
     *
     * @param integer $scores
     *
     * @return Gametime
     */
    public function setScores($scores)
    {
        $this->scores = $scores;

        return $this;
    }

    /**
     * Get scores
     *
     * @return integer
     */
    public function getScores()
    {
        return $this->scores;
    }

    /**
     * Get userid
     *
     * @return string
     */
    public function getUserid()
    {
        return $this->userid;
    }
}
