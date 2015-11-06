<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LogsRechargements
 *
 * @ORM\Table(name="site.logs_rechargements")
 * @ORM\Entity
 */
class LogsRechargements
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
     * @ORM\Column(name="id_compte", type="integer", nullable=true)
     */
    private $idCompte;

    /**
     * @var string
     *
     * @ORM\Column(name="compte", type="string", length=20, nullable=true)
     */
    private $compte;

    /**
     * @var string
     *
     * @ORM\Column(name="email_compte", type="string", length=100, nullable=true)
     */
    private $emailCompte;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=10, nullable=true)
     */
    private $code;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombre_vamonaies", type="integer", nullable=true)
     */
    private $nombreVamonaies;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="resultat", type="string", length=200, nullable=true)
     */
    private $resultat;

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
     * Set idCompte
     *
     * @param integer $idCompte
     *
     * @return LogsRechargements
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
     * Set compte
     *
     * @param string $compte
     *
     * @return LogsRechargements
     */
    public function setCompte($compte)
    {
        $this->compte = $compte;

        return $this;
    }

    /**
     * Get compte
     *
     * @return string
     */
    public function getCompte()
    {
        return $this->compte;
    }

    /**
     * Set emailCompte
     *
     * @param string $emailCompte
     *
     * @return LogsRechargements
     */
    public function setEmailCompte($emailCompte)
    {
        $this->emailCompte = $emailCompte;

        return $this;
    }

    /**
     * Get emailCompte
     *
     * @return string
     */
    public function getEmailCompte()
    {
        return $this->emailCompte;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return LogsRechargements
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set nombreVamonaies
     *
     * @param integer $nombreVamonaies
     *
     * @return LogsRechargements
     */
    public function setNombreVamonaies($nombreVamonaies)
    {
        $this->nombreVamonaies = $nombreVamonaies;

        return $this;
    }

    /**
     * Get nombreVamonaies
     *
     * @return integer
     */
    public function getNombreVamonaies()
    {
        return $this->nombreVamonaies;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return LogsRechargements
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

    /**
     * Set resultat
     *
     * @param string $resultat
     *
     * @return LogsRechargements
     */
    public function setResultat($resultat)
    {
        $this->resultat = $resultat;

        return $this;
    }

    /**
     * Get resultat
     *
     * @return string
     */
    public function getResultat()
    {
        return $this->resultat;
    }

    /**
     * Set ip
     *
     * @param string $ip
     *
     * @return LogsRechargements
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
