<?php

namespace Player\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Object
 *
 * @ORM\Table(name="object")
 * @ORM\Entity
 */
class Object
{
    /**
     * @var integer
     *
     * @ORM\Column(name="land_id", type="integer", nullable=false)
     */
    private $landId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="vnum", type="integer", nullable=false)
     */
    private $vnum = '0';

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
     * @var float
     *
     * @ORM\Column(name="x_rot", type="float", precision=10, scale=0, nullable=false)
     */
    private $xRot = '0';

    /**
     * @var float
     *
     * @ORM\Column(name="y_rot", type="float", precision=10, scale=0, nullable=false)
     */
    private $yRot = '0';

    /**
     * @var float
     *
     * @ORM\Column(name="z_rot", type="float", precision=10, scale=0, nullable=false)
     */
    private $zRot = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="life", type="integer", nullable=false)
     */
    private $life = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set landId
     *
     * @param integer $landId
     *
     * @return Object
     */
    public function setLandId($landId)
    {
        $this->landId = $landId;

        return $this;
    }

    /**
     * Get landId
     *
     * @return integer
     */
    public function getLandId()
    {
        return $this->landId;
    }

    /**
     * Set vnum
     *
     * @param integer $vnum
     *
     * @return Object
     */
    public function setVnum($vnum)
    {
        $this->vnum = $vnum;

        return $this;
    }

    /**
     * Get vnum
     *
     * @return integer
     */
    public function getVnum()
    {
        return $this->vnum;
    }

    /**
     * Set mapIndex
     *
     * @param integer $mapIndex
     *
     * @return Object
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
     * @return Object
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
     * @return Object
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
     * Set xRot
     *
     * @param float $xRot
     *
     * @return Object
     */
    public function setXRot($xRot)
    {
        $this->xRot = $xRot;

        return $this;
    }

    /**
     * Get xRot
     *
     * @return float
     */
    public function getXRot()
    {
        return $this->xRot;
    }

    /**
     * Set yRot
     *
     * @param float $yRot
     *
     * @return Object
     */
    public function setYRot($yRot)
    {
        $this->yRot = $yRot;

        return $this;
    }

    /**
     * Get yRot
     *
     * @return float
     */
    public function getYRot()
    {
        return $this->yRot;
    }

    /**
     * Set zRot
     *
     * @param float $zRot
     *
     * @return Object
     */
    public function setZRot($zRot)
    {
        $this->zRot = $zRot;

        return $this;
    }

    /**
     * Get zRot
     *
     * @return float
     */
    public function getZRot()
    {
        return $this->zRot;
    }

    /**
     * Set life
     *
     * @param integer $life
     *
     * @return Object
     */
    public function setLife($life)
    {
        $this->life = $life;

        return $this;
    }

    /**
     * Get life
     *
     * @return integer
     */
    public function getLife()
    {
        return $this->life;
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
