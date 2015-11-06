<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LogsDeblocageYangs
 *
 * @ORM\Table(name="site.logs_deblocage_yangs")
 * @ORM\Entity
 */
class LogsDeblocageYangs
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
     * @ORM\Column(name="id_perso", type="string", length=11, nullable=true)
     */
    private $idPerso;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_compte", type="integer", nullable=true)
     */
    private $idCompte;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=20, nullable=true)
     */
    private $ip;

    /**
     * @var integer
     *
     * @ORM\Column(name="log_yangs", type="integer", nullable=true)
     */
    private $logYangs;



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
     * @param string $idPerso
     *
     * @return LogsDeblocageYangs
     */
    public function setIdPerso($idPerso)
    {
        $this->idPerso = $idPerso;

        return $this;
    }

    /**
     * Get idPerso
     *
     * @return string
     */
    public function getIdPerso()
    {
        return $this->idPerso;
    }

    /**
     * Set idCompte
     *
     * @param integer $idCompte
     *
     * @return LogsDeblocageYangs
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return LogsDeblocageYangs
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
     * Set ip
     *
     * @param string $ip
     *
     * @return LogsDeblocageYangs
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

    /**
     * Set logYangs
     *
     * @param integer $logYangs
     *
     * @return LogsDeblocageYangs
     */
    public function setLogYangs($logYangs)
    {
        $this->logYangs = $logYangs;

        return $this;
    }

    /**
     * Get logYangs
     *
     * @return integer
     */
    public function getLogYangs()
    {
        return $this->logYangs;
    }
}
