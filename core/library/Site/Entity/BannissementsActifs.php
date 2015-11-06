<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BannissementsActifs
 *
 * @ORM\Table(name="site.bannissements_actifs", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="definitif", columns={"definitif"})})
 * @ORM\Entity
 */
class BannissementsActifs
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_compte", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idCompte = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut_bannissement", type="datetime", nullable=true)
     */
    private $dateDebutBannissement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin_bannissement", type="datetime", nullable=true)
     */
    private $dateFinBannissement;

    /**
     * @var integer
     *
     * @ORM\Column(name="raison_bannissement", type="integer", nullable=true)
     */
    private $raisonBannissement;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire_bannissement", type="string", length=255, nullable=true)
     */
    private $commentaireBannissement;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_compte_gm", type="integer", nullable=true)
     */
    private $idCompteGm;

    /**
     * @var string
     *
     * @ORM\Column(name="ip_gm", type="string", length=20, nullable=true)
     */
    private $ipGm;

    /**
     * @var integer
     *
     * @ORM\Column(name="duree", type="integer", nullable=true)
     */
    private $duree;

    /**
     * @var integer
     *
     * @ORM\Column(name="definitif", type="integer", nullable=true)
     */
    private $definitif;

    /**
     * @var integer
     *
     * @ORM\Column(name="debann_par", type="integer", nullable=true)
     */
    private $debannPar;



    /**
     * Set id
     *
     * @param integer $id
     *
     * @return BannissementsActifs
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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

    /**
     * Set idCompte
     *
     * @param integer $idCompte
     *
     * @return BannissementsActifs
     */
    public function setIdCompte($idCompte)
    {
        $this->idCompte = $idCompte;

        return $this;
    }

    /**
     * Get idCompte
     *
     * @return integer
     */
    public function getIdCompte()
    {
        return $this->idCompte;
    }

    /**
     * Set dateDebutBannissement
     *
     * @param \DateTime $dateDebutBannissement
     *
     * @return BannissementsActifs
     */
    public function setDateDebutBannissement($dateDebutBannissement)
    {
        $this->dateDebutBannissement = $dateDebutBannissement;

        return $this;
    }

    /**
     * Get dateDebutBannissement
     *
     * @return \DateTime
     */
    public function getDateDebutBannissement()
    {
        return $this->dateDebutBannissement;
    }

    /**
     * Set dateFinBannissement
     *
     * @param \DateTime $dateFinBannissement
     *
     * @return BannissementsActifs
     */
    public function setDateFinBannissement($dateFinBannissement)
    {
        $this->dateFinBannissement = $dateFinBannissement;

        return $this;
    }

    /**
     * Get dateFinBannissement
     *
     * @return \DateTime
     */
    public function getDateFinBannissement()
    {
        return $this->dateFinBannissement;
    }

    /**
     * Set raisonBannissement
     *
     * @param integer $raisonBannissement
     *
     * @return BannissementsActifs
     */
    public function setRaisonBannissement($raisonBannissement)
    {
        $this->raisonBannissement = $raisonBannissement;

        return $this;
    }

    /**
     * Get raisonBannissement
     *
     * @return integer
     */
    public function getRaisonBannissement()
    {
        return $this->raisonBannissement;
    }

    /**
     * Set commentaireBannissement
     *
     * @param string $commentaireBannissement
     *
     * @return BannissementsActifs
     */
    public function setCommentaireBannissement($commentaireBannissement)
    {
        $this->commentaireBannissement = $commentaireBannissement;

        return $this;
    }

    /**
     * Get commentaireBannissement
     *
     * @return string
     */
    public function getCommentaireBannissement()
    {
        return $this->commentaireBannissement;
    }

    /**
     * Set idCompteGm
     *
     * @param integer $idCompteGm
     *
     * @return BannissementsActifs
     */
    public function setIdCompteGm($idCompteGm)
    {
        $this->idCompteGm = $idCompteGm;

        return $this;
    }

    /**
     * Get idCompteGm
     *
     * @return integer
     */
    public function getIdCompteGm()
    {
        return $this->idCompteGm;
    }

    /**
     * Set ipGm
     *
     * @param string $ipGm
     *
     * @return BannissementsActifs
     */
    public function setIpGm($ipGm)
    {
        $this->ipGm = $ipGm;

        return $this;
    }

    /**
     * Get ipGm
     *
     * @return string
     */
    public function getIpGm()
    {
        return $this->ipGm;
    }

    /**
     * Set duree
     *
     * @param integer $duree
     *
     * @return BannissementsActifs
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree
     *
     * @return integer
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set definitif
     *
     * @param integer $definitif
     *
     * @return BannissementsActifs
     */
    public function setDefinitif($definitif)
    {
        $this->definitif = $definitif;

        return $this;
    }

    /**
     * Get definitif
     *
     * @return integer
     */
    public function getDefinitif()
    {
        return $this->definitif;
    }

    /**
     * Set debannPar
     *
     * @param integer $debannPar
     *
     * @return BannissementsActifs
     */
    public function setDebannPar($debannPar)
    {
        $this->debannPar = $debannPar;

        return $this;
    }

    /**
     * Get debannPar
     *
     * @return integer
     */
    public function getDebannPar()
    {
        return $this->debannPar;
    }
}
