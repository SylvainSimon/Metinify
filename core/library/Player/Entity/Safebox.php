<?php

namespace Player\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Safebox
 *
 * @ORM\Table(name="safebox")
 * @ORM\Entity
 */
class Safebox
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="size", type="boolean", nullable=false)
     */
    private $size = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=6, nullable=false)
     */
    private $password = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="gold", type="integer", nullable=false)
     */
    private $gold = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="account_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $accountId;



    /**
     * Set size
     *
     * @param boolean $size
     *
     * @return Safebox
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return boolean
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Safebox
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set gold
     *
     * @param integer $gold
     *
     * @return Safebox
     */
    public function setGold($gold)
    {
        $this->gold = $gold;

        return $this;
    }

    /**
     * Get gold
     *
     * @return integer
     */
    public function getGold()
    {
        return $this->gold;
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
