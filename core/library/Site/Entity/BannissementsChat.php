<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BannissementsChat
 *
 * @ORM\Table(name="site.bannissements_chat")
 * @ORM\Entity
 */
class BannissementsChat
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="perso", type="string", length=255, nullable=true)
     */
    private $perso;

    /**
     * @var string
     *
     * @ORM\Column(name="staff", type="string", length=255, nullable=true)
     */
    private $staff;

    /**
     * @var string
     *
     * @ORM\Column(name="duree", type="string", length=255, nullable=true)
     */
    private $duree;

    /**
     * @var string
     *
     * @ORM\Column(name="screen", type="string", length=255, nullable=true)
     */
    private $screen;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set perso
     *
     * @param string $perso
     *
     * @return BannissementsChat
     */
    public function setPerso($perso)
    {
        $this->perso = $perso;

        return $this;
    }

    /**
     * Get perso
     *
     * @return string
     */
    public function getPerso()
    {
        return $this->perso;
    }

    /**
     * Set staff
     *
     * @param string $staff
     *
     * @return BannissementsChat
     */
    public function setStaff($staff)
    {
        $this->staff = $staff;

        return $this;
    }

    /**
     * Get staff
     *
     * @return string
     */
    public function getStaff()
    {
        return $this->staff;
    }

    /**
     * Set duree
     *
     * @param string $duree
     *
     * @return BannissementsChat
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree
     *
     * @return string
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set screen
     *
     * @param string $screen
     *
     * @return BannissementsChat
     */
    public function setScreen($screen)
    {
        $this->screen = $screen;

        return $this;
    }

    /**
     * Get screen
     *
     * @return string
     */
    public function getScreen()
    {
        return $this->screen;
    }
}
