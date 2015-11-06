<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VotesListeSites
 *
 * @ORM\Table(name="site.votes_liste_sites")
 * @ORM\Entity
 */
class VotesListeSites {

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
     * @ORM\Column(name="id_site_vote", type="integer", nullable=true)
     */
    private $idSiteVote;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_site_vote", type="string", length=255, nullable=true)
     */
    private $nomSiteVote;

    /**
     * @var string
     *
     * @ORM\Column(name="lien_site_vote", type="string", length=255, nullable=true)
     */
    private $lienSiteVote;

    /**
     * @var integer
     *
     * @ORM\Column(name="actif", type="integer", nullable=true)
     */
    private $actif;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set idSiteVote
     *
     * @param integer $idSiteVote
     *
     * @return VotesListeSites
     */
    public function setIdSiteVote($idSiteVote) {
        $this->idSiteVote = $idSiteVote;

        return $this;
    }

    /**
     * Get idSiteVote
     *
     * @return integer
     */
    public function getIdSiteVote() {
        return $this->idSiteVote;
    }

    /**
     * Set nomSiteVote
     *
     * @param string $nomSiteVote
     *
     * @return VotesListeSites
     */
    public function setNomSiteVote($nomSiteVote) {
        $this->nomSiteVote = $nomSiteVote;

        return $this;
    }

    /**
     * Get nomSiteVote
     *
     * @return string
     */
    public function getNomSiteVote() {
        return $this->nomSiteVote;
    }

    /**
     * Set lienSiteVote
     *
     * @param string $lienSiteVote
     *
     * @return VotesListeSites
     */
    public function setLienSiteVote($lienSiteVote) {
        $this->lienSiteVote = $lienSiteVote;

        return $this;
    }

    /**
     * Get lienSiteVote
     *
     * @return string
     */
    public function getLienSiteVote() {
        return $this->lienSiteVote;
    }

    /**
     * Set actif
     *
     * @param integer $actif
     *
     * @return VotesListeSites
     */
    public function setActif($actif) {
        $this->actif = $actif;

        return $this;
    }

    /**
     * Get actif
     *
     * @return integer
     */
    public function getActif() {
        return $this->actif;
    }

}
