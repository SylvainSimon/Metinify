<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LogsCreationJoueurs
 *
 * @ORM\Table(name="site.logs_creation_joueurs", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})})
 * @ORM\Entity
 */
class LogsCreationJoueurs
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
     * @var integer
     *
     * @ORM\Column(name="id_perso", type="integer", nullable=true)
     */
    private $idPerso;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;



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
     * Set idPerso
     *
     * @param integer $idPerso
     *
     * @return LogsCreationJoueurs
     */
    public function setIdPerso($idPerso)
    {
        $this->idPerso = $idPerso;

        return $this;
    }

    /**
     * Get idPerso
     *
     * @return integer
     */
    public function getIdPerso()
    {
        return $this->idPerso;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return LogsCreationJoueurs
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
}
