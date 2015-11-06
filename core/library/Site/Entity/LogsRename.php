<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LogsRename
 *
 * @ORM\Table(name="site.logs_rename")
 * @ORM\Entity
 */
class LogsRename
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
     * @ORM\Column(name="ancien_nom", type="string", length=100, nullable=true)
     */
    private $ancienNom;

    /**
     * @var string
     *
     * @ORM\Column(name="nouveau_nom", type="string", length=100, nullable=true)
     */
    private $nouveauNom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

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
     * @return LogsRename
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
     * Set ancienNom
     *
     * @param string $ancienNom
     *
     * @return LogsRename
     */
    public function setAncienNom($ancienNom)
    {
        $this->ancienNom = $ancienNom;

        return $this;
    }

    /**
     * Get ancienNom
     *
     * @return string
     */
    public function getAncienNom()
    {
        return $this->ancienNom;
    }

    /**
     * Set nouveauNom
     *
     * @param string $nouveauNom
     *
     * @return LogsRename
     */
    public function setNouveauNom($nouveauNom)
    {
        $this->nouveauNom = $nouveauNom;

        return $this;
    }

    /**
     * Get nouveauNom
     *
     * @return string
     */
    public function getNouveauNom()
    {
        return $this->nouveauNom;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return LogsRename
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
     * @return LogsRename
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
