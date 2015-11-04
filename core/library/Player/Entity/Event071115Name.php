<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Event071115Name
 *
 * @ORM\Table(name="event071115_name", indexes={@ORM\Index(name="old_name", columns={"old_name"}), @ORM\Index(name="new_name", columns={"new_name"})})
 * @ORM\Entity
 */
class Event071115Name
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ruid", type="integer", nullable=false)
     */
    private $ruid = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="account", type="string", length=50, nullable=false)
     */
    private $account = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="uid", type="integer", nullable=false)
     */
    private $uid = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=50, nullable=false)
     */
    private $username = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="account_id", type="integer", nullable=false)
     */
    private $accountId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="player_id", type="integer", nullable=false)
     */
    private $playerId = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="old_name", type="string", length=50, nullable=false)
     */
    private $oldName = '';

    /**
     * @var string
     *
     * @ORM\Column(name="new_name", type="string", length=50, nullable=false)
     */
    private $newName = '';

    /**
     * @var string
     *
     * @ORM\Column(name="ipaddress", type="string", length=16, nullable=false)
     */
    private $ipaddress = '';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datetime", type="datetime", nullable=false)
     */
    private $datetime = '0000-00-00 00:00:00';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set ruid
     *
     * @param integer $ruid
     *
     * @return Event071115Name
     */
    public function setRuid($ruid)
    {
        $this->ruid = $ruid;

        return $this;
    }

    /**
     * Get ruid
     *
     * @return integer
     */
    public function getRuid()
    {
        return $this->ruid;
    }

    /**
     * Set account
     *
     * @param string $account
     *
     * @return Event071115Name
     */
    public function setAccount($account)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * Get account
     *
     * @return string
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * Set uid
     *
     * @param integer $uid
     *
     * @return Event071115Name
     */
    public function setUid($uid)
    {
        $this->uid = $uid;

        return $this;
    }

    /**
     * Get uid
     *
     * @return integer
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return Event071115Name
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set accountId
     *
     * @param integer $accountId
     *
     * @return Event071115Name
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;

        return $this;
    }

    /**
     * Get accountId
     *
     * @return integer
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * Set playerId
     *
     * @param integer $playerId
     *
     * @return Event071115Name
     */
    public function setPlayerId($playerId)
    {
        $this->playerId = $playerId;

        return $this;
    }

    /**
     * Get playerId
     *
     * @return integer
     */
    public function getPlayerId()
    {
        return $this->playerId;
    }

    /**
     * Set oldName
     *
     * @param string $oldName
     *
     * @return Event071115Name
     */
    public function setOldName($oldName)
    {
        $this->oldName = $oldName;

        return $this;
    }

    /**
     * Get oldName
     *
     * @return string
     */
    public function getOldName()
    {
        return $this->oldName;
    }

    /**
     * Set newName
     *
     * @param string $newName
     *
     * @return Event071115Name
     */
    public function setNewName($newName)
    {
        $this->newName = $newName;

        return $this;
    }

    /**
     * Get newName
     *
     * @return string
     */
    public function getNewName()
    {
        return $this->newName;
    }

    /**
     * Set ipaddress
     *
     * @param string $ipaddress
     *
     * @return Event071115Name
     */
    public function setIpaddress($ipaddress)
    {
        $this->ipaddress = $ipaddress;

        return $this;
    }

    /**
     * Get ipaddress
     *
     * @return string
     */
    public function getIpaddress()
    {
        return $this->ipaddress;
    }

    /**
     * Set datetime
     *
     * @param \DateTime $datetime
     *
     * @return Event071115Name
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;

        return $this;
    }

    /**
     * Get datetime
     *
     * @return \DateTime
     */
    public function getDatetime()
    {
        return $this->datetime;
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
