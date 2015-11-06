<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LotterieParticipants
 *
 * @ORM\Table(name="site.lotterie_participants")
 * @ORM\Entity
 */
class LotterieParticipants
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
     * @ORM\Column(name="compte", type="string", length=30, nullable=true)
     */
    private $compte;

    /**
     * @var string
     *
     * @ORM\Column(name="id_compte", type="string", length=20, nullable=true)
     */
    private $idCompte;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=30, nullable=true)
     */
    private $ip;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="string", length=30, nullable=true)
     */
    private $date;



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
     * Set compte
     *
     * @param string $compte
     *
     * @return LotterieParticipants
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
     * Set idCompte
     *
     * @param string $idCompte
     *
     * @return LotterieParticipants
     */
    public function setIdCompte($idCompte)
    {
        $this->idCompte = $idCompte;

        return $this;
    }

    /**
     * Get idCompte
     *
     * @return string
     */
    public function getIdCompte()
    {
        return $this->idCompte;
    }

    /**
     * Set ip
     *
     * @param string $ip
     *
     * @return LotterieParticipants
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
     * Set date
     *
     * @param string $date
     *
     * @return LotterieParticipants
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }
}
