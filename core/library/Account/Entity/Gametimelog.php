<?php

namespace Account\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gametimelog
 *
 * @ORM\Table(name="account.gametimelog", indexes={@ORM\Index(name="login_key", columns={"login"})})
 * @ORM\Entity
 */
class Gametimelog {

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=16, nullable=true)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", nullable=true)
     */
    private $type;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="logon_time", type="datetime", nullable=false)
     */
    private $logonTime = '0000-00-00 00:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="logout_time", type="datetime", nullable=false)
     */
    private $logoutTime = '0000-00-00 00:00:00';

    /**
     * @var integer
     *
     * @ORM\Column(name="use_time", type="integer", nullable=true)
     */
    private $useTime;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=15, nullable=false)
     */
    private $ip = '000.000.000.000';

    /**
     * @var string
     *
     * @ORM\Column(name="server", type="string", length=32, nullable=false)
     */
    private $server = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Set login
     *
     * @param string $login
     *
     * @return Gametimelog
     */
    public function setLogin($login) {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin() {
        return $this->login;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Gametimelog
     */
    public function setType($type) {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Set logonTime
     *
     * @param \DateTime $logonTime
     *
     * @return Gametimelog
     */
    public function setLogonTime($logonTime) {
        $this->logonTime = $logonTime;

        return $this;
    }

    /**
     * Get logonTime
     *
     * @return \DateTime
     */
    public function getLogonTime() {
        return $this->logonTime;
    }

    /**
     * Set logoutTime
     *
     * @param \DateTime $logoutTime
     *
     * @return Gametimelog
     */
    public function setLogoutTime($logoutTime) {
        $this->logoutTime = $logoutTime;

        return $this;
    }

    /**
     * Get logoutTime
     *
     * @return \DateTime
     */
    public function getLogoutTime() {
        return $this->logoutTime;
    }

    /**
     * Set useTime
     *
     * @param integer $useTime
     *
     * @return Gametimelog
     */
    public function setUseTime($useTime) {
        $this->useTime = $useTime;

        return $this;
    }

    /**
     * Get useTime
     *
     * @return integer
     */
    public function getUseTime() {
        return $this->useTime;
    }

    /**
     * Set ip
     *
     * @param string $ip
     *
     * @return Gametimelog
     */
    public function setIp($ip) {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp() {
        return $this->ip;
    }

    /**
     * Set server
     *
     * @param string $server
     *
     * @return Gametimelog
     */
    public function setServer($server) {
        $this->server = $server;

        return $this;
    }

    /**
     * Get server
     *
     * @return string
     */
    public function getServer() {
        return $this->server;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

}
