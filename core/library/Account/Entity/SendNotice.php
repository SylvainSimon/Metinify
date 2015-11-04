<?php

namespace Account\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SendNotice
 *
 * @ORM\Table(name="account.send_notice")
 * @ORM\Entity
 */
class SendNotice
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="type", type="boolean", nullable=false)
     */
    private $type = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="server", type="string", length=3, nullable=false)
     */
    private $server = '';

    /**
     * @var boolean
     *
     * @ORM\Column(name="show_check", type="boolean", nullable=false)
     */
    private $showCheck = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", length=65535, nullable=true)
     */
    private $content;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set type
     *
     * @param boolean $type
     *
     * @return SendNotice
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return boolean
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set server
     *
     * @param string $server
     *
     * @return SendNotice
     */
    public function setServer($server)
    {
        $this->server = $server;

        return $this;
    }

    /**
     * Get server
     *
     * @return string
     */
    public function getServer()
    {
        return $this->server;
    }

    /**
     * Set showCheck
     *
     * @param boolean $showCheck
     *
     * @return SendNotice
     */
    public function setShowCheck($showCheck)
    {
        $this->showCheck = $showCheck;

        return $this;
    }

    /**
     * Get showCheck
     *
     * @return boolean
     */
    public function getShowCheck()
    {
        return $this->showCheck;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return SendNotice
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
