<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GuildComment
 *
 * @ORM\Table(name="guild_comment", indexes={@ORM\Index(name="aaa", columns={"notice", "id", "guild_id"}), @ORM\Index(name="guild_id", columns={"guild_id"})})
 * @ORM\Entity
 */
class GuildComment
{
    /**
     * @var integer
     *
     * @ORM\Column(name="guild_id", type="integer", nullable=true)
     */
    private $guildId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=8, nullable=true)
     */
    private $name;

    /**
     * @var boolean
     *
     * @ORM\Column(name="notice", type="boolean", nullable=true)
     */
    private $notice;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=50, nullable=true)
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="datetime", nullable=true)
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
     * Set guildId
     *
     * @param integer $guildId
     *
     * @return GuildComment
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
     * Set name
     *
     * @param string $name
     *
     * @return GuildComment
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
     * Set notice
     *
     * @param boolean $notice
     *
     * @return GuildComment
     */
    public function setNotice($notice)
    {
        $this->notice = $notice;

        return $this;
    }

    /**
     * Get notice
     *
     * @return boolean
     */
    public function getNotice()
    {
        return $this->notice;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return GuildComment
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set time
     *
     * @param \DateTime $time
     *
     * @return GuildComment
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime
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
