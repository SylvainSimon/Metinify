<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MarchePersonnages
 *
 * @ORM\Table(name="site.marche_personnages")
 * @ORM\Entity(repositoryClass="Site\Repository\MarchePersonnagesRepository")
 */
class MarchePersonnages {

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
     * @ORM\Column(name="id_proprietaire", type="integer", nullable=true)
     */
    private $idProprietaire;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_personnage", type="integer", nullable=true)
     */
    private $idPersonnage;

    /**
     * @var string
     *
     * @ORM\Column(name="pid", type="string", length=255, nullable=true)
     */
    private $pid;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set idProprietaire
     *
     * @param integer $idProprietaire
     *
     * @return MarchePersonnages
     */
    public function setIdProprietaire($idProprietaire) {
        $this->idProprietaire = $idProprietaire;

        return $this;
    }

    /**
     * Get idProprietaire
     *
     * @return integer
     */
    public function getIdProprietaire() {
        return $this->idProprietaire;
    }

    /**
     * Set idPersonnage
     *
     * @param integer $idPersonnage
     *
     * @return MarchePersonnages
     */
    public function setIdPersonnage($idPersonnage) {
        $this->idPersonnage = $idPersonnage;

        return $this;
    }

    /**
     * Get idPersonnage
     *
     * @return integer
     */
    public function getIdPersonnage() {
        return $this->idPersonnage;
    }

    /**
     * Set pid
     *
     * @param string $pid
     *
     * @return MarchePersonnages
     */
    public function setPid($pid) {
        $this->pid = $pid;

        return $this;
    }

    /**
     * Get pid
     *
     * @return string
     */
    public function getPid() {
        return $this->pid;
    }

}
