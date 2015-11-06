<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LogsChangementMail
 *
 * @ORM\Table(name="site.logs_changement_mail")
 * @ORM\Entity
 */
class LogsChangementMail
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
     * @ORM\Column(name="ancien_mail", type="string", length=100, nullable=true)
     */
    private $ancienMail;

    /**
     * @var string
     *
     * @ORM\Column(name="nouveau_mail", type="string", length=100, nullable=true)
     */
    private $nouveauMail;

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
     * @return LogsChangementMail
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
     * @return LogsChangementMail
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
     * Set ancienMail
     *
     * @param string $ancienMail
     *
     * @return LogsChangementMail
     */
    public function setAncienMail($ancienMail)
    {
        $this->ancienMail = $ancienMail;

        return $this;
    }

    /**
     * Get ancienMail
     *
     * @return string
     */
    public function getAncienMail()
    {
        return $this->ancienMail;
    }

    /**
     * Set nouveauMail
     *
     * @param string $nouveauMail
     *
     * @return LogsChangementMail
     */
    public function setNouveauMail($nouveauMail)
    {
        $this->nouveauMail = $nouveauMail;

        return $this;
    }

    /**
     * Get nouveauMail
     *
     * @return string
     */
    public function getNouveauMail()
    {
        return $this->nouveauMail;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return LogsChangementMail
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
     * @return LogsChangementMail
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
