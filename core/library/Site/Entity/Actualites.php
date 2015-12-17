<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Actualites
 *
 * @ORM\Table(name="site.actualites")
 * @ORM\Entity(repositoryClass="Site\Repository\ActualitesRepository")
 */
class Actualites {

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
     * @ORM\Column(name="auteur", type="integer", nullable=true)
     */
    private $auteur;

    /**
     * @var string
     *
     * @ORM\Column(name="titre_message", type="string", length=255, nullable=true)
     */
    private $titreMessage;

    /**
     * @var string
     *
     * @ORM\Column(name="contenue_message", type="string", length=10240, nullable=true)
     */
    private $contenueMessage;

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
    public function getId() {
        return $this->id;
    }

    /**
     * Set auteur
     *
     * @param integer $auteur
     *
     * @return Actualites
     */
    public function setAuteur($auteur) {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return integer
     */
    public function getAuteur() {
        return $this->auteur;
    }

    /**
     * Set titreMessage
     *
     * @param string $titreMessage
     *
     * @return Actualites
     */
    public function setTitreMessage($titreMessage) {
        $this->titreMessage = $titreMessage;

        return $this;
    }

    /**
     * Get titreMessage
     *
     * @return string
     */
    public function getTitreMessage() {
        return $this->titreMessage;
    }

    /**
     * Set contenueMessage
     *
     * @param string $contenueMessage
     *
     * @return Actualites
     */
    public function setContenueMessage($contenueMessage) {
        $this->contenueMessage = $contenueMessage;

        return $this;
    }

    /**
     * Get contenueMessage
     *
     * @return string
     */
    public function getContenueMessage() {
        return $this->contenueMessage;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Actualites
     */
    public function setDate($date) {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate() {
        return $this->date;
    }

}
