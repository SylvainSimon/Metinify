<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Land
 *
 * @ORM\Table(name="land")
 * @ORM\Entity
 */
class Land
{
    /**
     * @var integer
     *
     * @ORM\Column(name="map_index", type="integer", nullable=false)
     */
    private $mapIndex = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="x", type="integer", nullable=false)
     */
    private $x = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="y", type="integer", nullable=false)
     */
    private $y = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="width", type="integer", nullable=false)
     */
    private $width = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="height", type="integer", nullable=false)
     */
    private $height = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="guild_id", type="integer", nullable=false)
     */
    private $guildId = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="guild_level_limit", type="boolean", nullable=false)
     */
    private $guildLevelLimit = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="price", type="integer", nullable=false)
     */
    private $price = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="enable", type="string", nullable=false)
     */
    private $enable = 'NO';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set mapIndex
     *
     * @param integer $mapIndex
     *
     * @return Land
     */
    public function setMapIndex($mapIndex)
    {
        $this->mapIndex = $mapIndex;

        return $this;
    }

    /**
     * Get mapIndex
     *
     * @return integer
     */
    public function getMapIndex()
    {
        return $this->mapIndex;
    }

    /**
     * Set x
     *
     * @param integer $x
     *
     * @return Land
     */
    public function setX($x)
    {
        $this->x = $x;

        return $this;
    }

    /**
     * Get x
     *
     * @return integer
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * Set y
     *
     * @param integer $y
     *
     * @return Land
     */
    public function setY($y)
    {
        $this->y = $y;

        return $this;
    }

    /**
     * Get y
     *
     * @return integer
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * Set width
     *
     * @param integer $width
     *
     * @return Land
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get width
     *
     * @return integer
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set height
     *
     * @param integer $height
     *
     * @return Land
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return integer
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set guildId
     *
     * @param integer $guildId
     *
     * @return Land
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
     * Set guildLevelLimit
     *
     * @param boolean $guildLevelLimit
     *
     * @return Land
     */
    public function setGuildLevelLimit($guildLevelLimit)
    {
        $this->guildLevelLimit = $guildLevelLimit;

        return $this;
    }

    /**
     * Get guildLevelLimit
     *
     * @return boolean
     */
    public function getGuildLevelLimit()
    {
        return $this->guildLevelLimit;
    }

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return Land
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set enable
     *
     * @param string $enable
     *
     * @return Land
     */
    public function setEnable($enable)
    {
        $this->enable = $enable;

        return $this;
    }

    /**
     * Get enable
     *
     * @return string
     */
    public function getEnable()
    {
        return $this->enable;
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
