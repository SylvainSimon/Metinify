<?php

namespace Player\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GuildMember
 *
 * @ORM\Table(name="player.guild_member", uniqueConstraints={@ORM\UniqueConstraint(name="pid", columns={"pid"})})
 * @ORM\Entity
 */
class GuildMember
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="grade", type="boolean", nullable=true)
     */
    private $grade;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_general", type="boolean", nullable=false)
     */
    private $isGeneral = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="offer", type="integer", nullable=true)
     */
    private $offer;

    /**
     * @var integer
     *
     * @ORM\Column(name="guild_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $guildId;

    /**
     * @var integer
     *
     * @ORM\Column(name="pid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $pid;



    /**
     * Set grade
     *
     * @param boolean $grade
     *
     * @return GuildMember
     */
    public function setGrade($grade)
    {
        $this->grade = $grade;

        return $this;
    }

    /**
     * Get grade
     *
     * @return boolean
     */
    public function getGrade()
    {
        return $this->grade;
    }

    /**
     * Set isGeneral
     *
     * @param boolean $isGeneral
     *
     * @return GuildMember
     */
    public function setIsGeneral($isGeneral)
    {
        $this->isGeneral = $isGeneral;

        return $this;
    }

    /**
     * Get isGeneral
     *
     * @return boolean
     */
    public function getIsGeneral()
    {
        return $this->isGeneral;
    }

    /**
     * Set offer
     *
     * @param integer $offer
     *
     * @return GuildMember
     */
    public function setOffer($offer)
    {
        $this->offer = $offer;

        return $this;
    }

    /**
     * Get offer
     *
     * @return integer
     */
    public function getOffer()
    {
        return $this->offer;
    }

    /**
     * Set guildId
     *
     * @param integer $guildId
     *
     * @return GuildMember
     */
    public function setGuildId($guildId)
    {
        $this->guildId = $guildId;

        return $this;
    }

    /**
     * Get guildId
     *
     * @return integer
     */
    public function getGuildId()
    {
        return $this->guildId;
    }

    /**
     * Set pid
     *
     * @param integer $pid
     *
     * @return GuildMember
     */
    public function setPid($pid)
    {
        $this->pid = $pid;

        return $this;
    }

    /**
     * Get pid
     *
     * @return integer
     */
    public function getPid()
    {
        return $this->pid;
    }
}
