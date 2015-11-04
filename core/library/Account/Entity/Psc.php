<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Psc
 *
 * @ORM\Table(name="psc")
 * @ORM\Entity
 */
class Psc
{
    /**
     * @var string
     *
     * @ORM\Column(name="account_id", type="string", length=20, nullable=false)
     */
    private $accountId;

    /**
     * @var string
     *
     * @ORM\Column(name="psc", type="string", length=20, nullable=false)
     */
    private $psc;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=20, nullable=false)
     */
    private $ip;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=30, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=20, nullable=false)
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set accountId
     *
     * @param string $accountId
     *
     * @return Psc
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;

        return $this;
    }

    /**
     * Get accountId
     *
     * @return string
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * Set psc
     *
     * @param string $psc
     *
     * @return Psc
     */
    public function setPsc($psc)
    {
        $this->psc = $psc;

        return $this;
    }

    /**
     * Get psc
     *
     * @return string
     */
    public function getPsc()
    {
        return $this->psc;
    }

    /**
     * Set ip
     *
     * @param string $ip
     *
     * @return Psc
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
     * Set email
     *
     * @param string $email
     *
     * @return Psc
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Psc
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
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
