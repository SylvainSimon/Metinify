<?php

namespace Player\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ChangeName
 *
 * @ORM\Table(name="player.change_name")
 * @ORM\Entity
 */
class ChangeName
{
    /**
     * @var string
     *
     * @ORM\Column(name="pid", type="text", length=65535, nullable=true)
     */
    private $pid;

    /**
     * @var string
     *
     * @ORM\Column(name="old_name", type="text", length=65535, nullable=true)
     */
    private $oldName;

    /**
     * @var string
     *
     * @ORM\Column(name="new_name", type="text", length=65535, nullable=true)
     */
    private $newName;

    /**
     * @var string
     *
     * @ORM\Column(name="time", type="text", length=65535, nullable=true)
     */
    private $time;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="text", length=65535, nullable=true)
     */
    private $ip;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set pid
     *
     * @param string $pid
     *
     * @return ChangeName
     */
    public function setPid($pid)
    {
        $this->pid = $pid;

        return $this;
    }

    /**
     * Get pid
     *
     * @return string
     */
    public function getPid()
    {
        return $this->pid;
    }

    /**
     * Set oldName
     *
     * @param string $oldName
     *
     * @return ChangeName
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
     * @return ChangeName
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
     * Set time
     *
     * @param string $time
     *
     * @return ChangeName
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
     * Set ip
     *
     * @param string $ip
     *
     * @return ChangeName
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
