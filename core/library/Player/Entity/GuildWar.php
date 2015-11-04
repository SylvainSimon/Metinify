<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GuildWar
 *
 * @ORM\Table(name="guild_war")
 * @ORM\Entity
 */
class GuildWar
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_from", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idFrom;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_to", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idTo;



    /**
     * Set idFrom
     *
     * @param integer $idFrom
     *
     * @return GuildWar
     */
    public function setIdFrom($idFrom)
    {
        $this->idFrom = $idFrom;

        return $this;
    }

    /**
     * Get idFrom
     *
     * @return integer
     */
    public function getIdFrom()
    {
        return $this->idFrom;
    }

    /**
     * Set idTo
     *
     * @param integer $idTo
     *
     * @return GuildWar
     */
    public function setIdTo($idTo)
    {
        $this->idTo = $idTo;

        return $this;
    }

    /**
     * Get idTo
     *
     * @return integer
     */
    public function getIdTo()
    {
        return $this->idTo;
    }
}
