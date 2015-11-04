<?php

namespace Account\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlockException
 *
 * @ORM\Table(name="account.block_exception")
 * @ORM\Entity
 */
class BlockException
{
    /**
     * @var integer
     *
     * @ORM\Column(name="login", type="integer", nullable=true)
     */
    private $login;

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
     * @param integer $login
     *
     * @return BlockException
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return integer
     */
    public function getLogin()
    {
        return $this->login;
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
