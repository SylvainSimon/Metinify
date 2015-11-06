<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LotterieAdmin
 *
 * @ORM\Table(name="site.lotterie_admin")
 * @ORM\Entity
 */
class LotterieAdmin
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
     * @ORM\Column(name="date_debut", type="string", length=30, nullable=true)
     */
    private $dateDebut;

    /**
     * @var string
     *
     * @ORM\Column(name="date_fin", type="string", length=30, nullable=true)
     */
    private $dateFin;

    /**
     * @var string
     *
     * @ORM\Column(name="date_debutcompteur", type="string", length=30, nullable=true)
     */
    private $dateDebutcompteur;

    /**
     * @var string
     *
     * @ORM\Column(name="date_pour_compteur", type="string", length=30, nullable=true)
     */
    private $datePourCompteur;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=20, nullable=true)
     */
    private $etat;

    /**
     * @var string
     *
     * @ORM\Column(name="admin", type="string", length=30, nullable=true)
     */
    private $admin;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=30, nullable=true)
     */
    private $ip;



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
     * Set dateDebut
     *
     * @param string $dateDebut
     *
     * @return LotterieAdmin
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return string
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param string $dateFin
     *
     * @return LotterieAdmin
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return string
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set dateDebutcompteur
     *
     * @param string $dateDebutcompteur
     *
     * @return LotterieAdmin
     */
    public function setDateDebutcompteur($dateDebutcompteur)
    {
        $this->dateDebutcompteur = $dateDebutcompteur;

        return $this;
    }

    /**
     * Get dateDebutcompteur
     *
     * @return string
     */
    public function getDateDebutcompteur()
    {
        return $this->dateDebutcompteur;
    }

    /**
     * Set datePourCompteur
     *
     * @param string $datePourCompteur
     *
     * @return LotterieAdmin
     */
    public function setDatePourCompteur($datePourCompteur)
    {
        $this->datePourCompteur = $datePourCompteur;

        return $this;
    }

    /**
     * Get datePourCompteur
     *
     * @return string
     */
    public function getDatePourCompteur()
    {
        return $this->datePourCompteur;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return LotterieAdmin
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set admin
     *
     * @param string $admin
     *
     * @return LotterieAdmin
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;

        return $this;
    }

    /**
     * Get admin
     *
     * @return string
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * Set ip
     *
     * @param string $ip
     *
     * @return LotterieAdmin
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }
}
