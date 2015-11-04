<?php

namespace Player\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ChangeEmpire
 *
 * @ORM\Table(name="player.change_empire")
 * @ORM\Entity
 */
class ChangeEmpire
{
    /**
     * @var string
     *
     * @ORM\Column(name="change_count", type="text", length=65535, nullable=true)
     */
    private $changeCount;

    /**
     * @var string
     *
     * @ORM\Column(name="account_id", type="text", length=65535, nullable=true)
     */
    private $accountId;

    /**
     * @var string
     *
     * @ORM\Column(name="time", type="text", length=65535, nullable=true)
     */
    private $time;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set changeCount
     *
     * @param string $changeCount
     *
     * @return ChangeEmpire
     */
    public function setChangeCount($changeCount)
    {
        $this->changeCount = $changeCount;

        return $this;
    }

    /**
     * Get changeCount
     *
     * @return string
     */
    public function getChangeCount()
    {
        return $this->changeCount;
    }

    /**
     * Set accountId
     *
     * @param string $accountId
     *
     * @return ChangeEmpire
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
     * Set time
     *
     * @param string $time
     *
     * @return ChangeEmpire
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return string
     */
    public function getTime()
    {
        return $this->time;
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
