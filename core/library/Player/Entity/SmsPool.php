<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SmsPool
 *
 * @ORM\Table(name="sms_pool", indexes={@ORM\Index(name="sent_idx", columns={"sent"})})
 * @ORM\Entity
 */
class SmsPool
{
    /**
     * @var integer
     *
     * @ORM\Column(name="server", type="integer", nullable=false)
     */
    private $server = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="sender", type="string", length=32, nullable=true)
     */
    private $sender = '';

    /**
     * @var string
     *
     * @ORM\Column(name="receiver", type="string", length=100, nullable=false)
     */
    private $receiver = '';

    /**
     * @var string
     *
     * @ORM\Column(name="mobile", type="string", length=32, nullable=true)
     */
    private $mobile = '';

    /**
     * @var string
     *
     * @ORM\Column(name="sent", type="string", nullable=false)
     */
    private $sent = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="msg", type="string", length=80, nullable=true)
     */
    private $msg = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set server
     *
     * @param integer $server
     *
     * @return SmsPool
     */
    public function setServer($server)
    {
        $this->server = $server;

        return $this;
    }

    /**
     * Get server
     *
     * @return integer
     */
    public function getServer()
    {
        return $this->server;
    }

    /**
     * Set sender
     *
     * @param string $sender
     *
     * @return SmsPool
     */
    public function setSender($sender)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * Get sender
     *
     * @return string
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Set receiver
     *
     * @param string $receiver
     *
     * @return SmsPool
     */
    public function setReceiver($receiver)
    {
        $this->receiver = $receiver;

        return $this;
    }

    /**
     * Get receiver
     *
     * @return string
     */
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * Set mobile
     *
     * @param string $mobile
     *
     * @return SmsPool
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set sent
     *
     * @param string $sent
     *
     * @return SmsPool
     */
    public function setSent($sent)
    {
        $this->sent = $sent;

        return $this;
    }

    /**
     * Get sent
     *
     * @return string
     */
    public function getSent()
    {
        return $this->sent;
    }

    /**
     * Set msg
     *
     * @param string $msg
     *
     * @return SmsPool
     */
    public function setMsg($msg)
    {
        $this->msg = $msg;

        return $this;
    }

    /**
     * Get msg
     *
     * @return string
     */
    public function getMsg()
    {
        return $this->msg;
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
