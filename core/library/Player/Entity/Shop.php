<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Shop
 *
 * @ORM\Table(name="shop")
 * @ORM\Entity
 */
class Shop
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=32, nullable=false)
     */
    private $name = 'Noname';

    /**
     * @var integer
     *
     * @ORM\Column(name="npc_vnum", type="smallint", nullable=false)
     */
    private $npcVnum = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="vnum", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $vnum;



    /**
     * Set name
     *
     * @param string $name
     *
     * @return Shop
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
     * Set npcVnum
     *
     * @param integer $npcVnum
     *
     * @return Shop
     */
    public function setNpcVnum($npcVnum)
    {
        $this->npcVnum = $npcVnum;

        return $this;
    }

    /**
     * Get npcVnum
     *
     * @return integer
     */
    public function getNpcVnum()
    {
        return $this->npcVnum;
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
}
