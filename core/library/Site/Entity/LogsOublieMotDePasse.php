<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LogsOublieMotDePasse
 *
 * @ORM\Table(name="site.logs_oublie_mot_de_passe")
 * @ORM\Entity
 */
class LogsOublieMotDePasse
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
     * @ORM\Column(name="compte_essaye", type="string", length=20, nullable=true)
     */
    private $compteEssaye;

    /**
     * @var string
     *
     * @ORM\Column(name="email_essaye", type="string", length=100, nullable=true)
     */
    private $emailEssaye;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_essai", type="datetime", nullable=true)
     */
    private $dateEssai;

    /**
     * @var integer
     *
     * @ORM\Column(name="resultat_demande", type="integer", nullable=true)
     */
    private $resultatDemande;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=15, nullable=true)
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
     * Set compteEssaye
     *
     * @param string $compteEssaye
     *
     * @return LogsOublieMotDePasse
     */
    public function setCompteEssaye($compteEssaye)
    {
        $this->compteEssaye = $compteEssaye;

        return $this;
    }

    /**
     * Get compteEssaye
     *
     * @return string
     */
    public function getCompteEssaye()
    {
        return $this->compteEssaye;
    }

    /**
     * Set emailEssaye
     *
     * @param string $emailEssaye
     *
     * @return LogsOublieMotDePasse
     */
    public function setEmailEssaye($emailEssaye)
    {
        $this->emailEssaye = $emailEssaye;

        return $this;
    }

    /**
     * Get emailEssaye
     *
     * @return string
     */
    public function getEmailEssaye()
    {
        return $this->emailEssaye;
    }

    /**
     * Set dateEssai
     *
     * @param \DateTime $dateEssai
     *
     * @return LogsOublieMotDePasse
     */
    public function setDateEssai($dateEssai)
    {
        $this->dateEssai = $dateEssai;

        return $this;
    }

    /**
     * Get dateEssai
     *
     * @return \DateTime
     */
    public function getDateEssai()
    {
        return $this->dateEssai;
    }

    /**
     * Set resultatDemande
     *
     * @param integer $resultatDemande
     *
     * @return LogsOublieMotDePasse
     */
    public function setResultatDemande($resultatDemande)
    {
        $this->resultatDemande = $resultatDemande;

        return $this;
    }

    /**
     * Get resultatDemande
     *
     * @return integer
     */
    public function getResultatDemande()
    {
        return $this->resultatDemande;
    }

    /**
     * Set ip
     *
     * @param string $ip
     *
     * @return LogsOublieMotDePasse
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
