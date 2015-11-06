<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LogsDeblocagePersos
 *
 * @ORM\Table(name="site.logs_deblocage_persos")
 * @ORM\Entity
 */
class LogsDeblocagePersos
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
     * @var integer
     *
     * @ORM\Column(name="id_compte", type="integer", nullable=true)
     */
    private $idCompte;

    /**
     * @var integer
     *
     * @ORM\Column(name="map_index", type="integer", nullable=true)
     */
    private $mapIndex;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=25, nullable=true)
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
     * Set idPerso
     *
     * @param integer $idPerso
     *
     * @return LogsDeblocagePersos
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
     * Set idCompte
     *
     * @param integer $idCompte
     *
     * @return LogsDeblocagePersos
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
     * Set mapIndex
     *
     * @param integer $mapIndex
     *
     * @return LogsDeblocagePersos
     */
    public function setMapIndex($mapIndex)
    {
        $this->mapIndex = $mapIndex;

        return $this;
    }

    /**
     * Get mapIndex
     *
     * @return integer
     */
    public function getMapIndex()
    {
        return $this->mapIndex;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return LogsDeblocagePersos
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
     * @return LogsDeblocagePersos
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
