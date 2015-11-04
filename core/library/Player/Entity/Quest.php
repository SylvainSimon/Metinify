<?php

namespace Player\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Quest
 *
 * @ORM\Table(name="quest", indexes={@ORM\Index(name="pid_idx", columns={"dwPID"}), @ORM\Index(name="name_idx", columns={"szName"}), @ORM\Index(name="state_idx", columns={"szState"})})
 * @ORM\Entity
 */
class Quest
{
    /**
     * @var integer
     *
     * @ORM\Column(name="lValue", type="integer", nullable=false)
     */
    private $lvalue = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="dwPID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $dwpid;

    /**
     * @var string
     *
     * @ORM\Column(name="szName", type="string", length=32)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $szname;

    /**
     * @var string
     *
     * @ORM\Column(name="szState", type="string", length=64)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $szstate;



    /**
     * Set lvalue
     *
     * @param integer $lvalue
     *
     * @return Quest
     */
    public function setLvalue($lvalue)
    {
        $this->lvalue = $lvalue;

        return $this;
    }

    /**
     * Get lvalue
     *
     * @return integer
     */
    public function getLvalue()
    {
        return $this->lvalue;
    }

    /**
     * Set dwpid
     *
     * @param integer $dwpid
     *
     * @return Quest
     */
    public function setDwpid($dwpid)
    {
        $this->dwpid = $dwpid;

        return $this;
    }

    /**
     * Get dwpid
     *
     * @return integer
     */
    public function getDwpid()
    {
        return $this->dwpid;
    }

    /**
     * Set szname
     *
     * @param string $szname
     *
     * @return Quest
     */
    public function setSzname($szname)
    {
        $this->szname = $szname;

        return $this;
    }

    /**
     * Get szname
     *
     * @return string
     */
    public function getSzname()
    {
        return $this->szname;
    }

    /**
     * Set szstate
     *
     * @param string $szstate
     *
     * @return Quest
     */
    public function setSzstate($szstate)
    {
        $this->szstate = $szstate;

        return $this;
    }

    /**
     * Get szstate
     *
     * @return string
     */
    public function getSzstate()
    {
        return $this->szstate;
    }
}
