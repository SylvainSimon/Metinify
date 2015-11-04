<?php

namespace Player\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Card
 *
 * @ORM\Table(name="player.card")
 * @ORM\Entity
 */
class Card
{
    /**
     * @var string
     *
     * @ORM\Column(name="cash", type="string", length=255, nullable=true)
     */
    private $cash;

    /**
     * @var string
     *
     * @ORM\Column(name="prices", type="string", length=255, nullable=true)
     */
    private $prices;

    /**
     * @var string
     *
     * @ORM\Column(name="no", type="string", length=255, nullable=true)
     */
    private $no;

    /**
     * @var string
     *
     * @ORM\Column(name="pwd", type="string", length=255, nullable=true)
     */
    private $pwd;

    /**
     * @var integer
     *
     * @ORM\Column(name="lock", type="integer", nullable=true)
     */
    private $lock;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set cash
     *
     * @param string $cash
     *
     * @return Card
     */
    public function setCash($cash)
    {
        $this->cash = $cash;

        return $this;
    }

    /**
     * Get cash
     *
     * @return string
     */
    public function getCash()
    {
        return $this->cash;
    }

    /**
     * Set prices
     *
     * @param string $prices
     *
     * @return Card
     */
    public function setPrices($prices)
    {
        $this->prices = $prices;

        return $this;
    }

    /**
     * Get prices
     *
     * @return string
     */
    public function getPrices()
    {
        return $this->prices;
    }

    /**
     * Set no
     *
     * @param string $no
     *
     * @return Card
     */
    public function setNo($no)
    {
        $this->no = $no;

        return $this;
    }

    /**
     * Get no
     *
     * @return string
     */
    public function getNo()
    {
        return $this->no;
    }

    /**
     * Set pwd
     *
     * @param string $pwd
     *
     * @return Card
     */
    public function setPwd($pwd)
    {
        $this->pwd = $pwd;

        return $this;
    }

    /**
     * Get pwd
     *
     * @return string
     */
    public function getPwd()
    {
        return $this->pwd;
    }

    /**
     * Set lock
     *
     * @param integer $lock
     *
     * @return Card
     */
    public function setLock($lock)
    {
        $this->lock = $lock;

        return $this;
    }

    /**
     * Get lock
     *
     * @return integer
     */
    public function getLock()
    {
        return $this->lock;
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
