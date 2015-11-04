<?php

namespace Player\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GuildGrade
 *
 * @ORM\Table(name="player.guild_grade")
 * @ORM\Entity
 */
class GuildGrade
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=8, nullable=false)
     */
    private $name = '';

    /**
     * @var array
     *
     * @ORM\Column(name="auth", type="simple_array", nullable=true)
     */
    private $auth;

    /**
     * @var integer
     *
     * @ORM\Column(name="guild_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $guildId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="grade", type="boolean")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $grade;



    /**
     * Set name
     *
     * @param string $name
     *
     * @return GuildGrade
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set auth
     *
     * @param array $auth
     *
     * @return GuildGrade
     */
    public function setAuth($auth)
    {
        $this->auth = $auth;

        return $this;
    }

    /**
     * Get auth
     *
     * @return array
     */
    public function getAuth()
    {
        return $this->auth;
    }

    /**
     * Set guildId
     *
     * @param integer $guildId
     *
     * @return GuildGrade
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
     * Set grade
     *
     * @param boolean $grade
     *
     * @return GuildGrade
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
}
