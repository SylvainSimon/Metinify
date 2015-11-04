<?php

namespace Account\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TeleBlock
 *
 * @ORM\Table(name="account.tele_block")
 * @ORM\Entity
 */
class TeleBlock
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastlogin", type="datetime", nullable=false)
     */
    private $lastlogin = '0000-00-00 00:00:00';

    /**
     * @var string
     *
     * @ORM\Column(name="tele_block", type="string", length=30, nullable=false)
     */
    private $teleBlock = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="account_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $accountId;



    /**
     * Set lastlogin
     *
     * @param \DateTime $lastlogin
     *
     * @return TeleBlock
     */
    public function setLastlogin($lastlogin)
    {
        $this->lastlogin = $lastlogin;

        return $this;
    }

    /**
     * Get lastlogin
     *
     * @return \DateTime
     */
    public function getLastlogin()
    {
        return $this->lastlogin;
    }

    /**
     * Set teleBlock
     *
     * @param string $teleBlock
     *
     * @return TeleBlock
     */
    public function setTeleBlock($teleBlock)
    {
        $this->teleBlock = $teleBlock;

        return $this;
    }

    /**
     * Get teleBlock
     *
     * @return string
     */
    public function getTeleBlock()
    {
        return $this->teleBlock;
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
}
