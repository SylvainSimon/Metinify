<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LogsMarcheMiseEnVente
 *
 * @ORM\Table(name="site.logs_marche_mise_en_vente")
 * @ORM\Entity
 */
class LogsMarcheMiseEnVente
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
     * @var integer
     *
     * @ORM\Column(name="id_personnage", type="integer", nullable=true)
     */
    private $idPersonnage;

    /**
     * @var integer
     *
     * @ORM\Column(name="prix", type="integer", nullable=true)
     */
    private $prix;

    /**
     * @var integer
     *
     * @ORM\Column(name="devise", type="integer", nullable=true)
     */
    private $devise;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=50, nullable=true)
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
     * @return LogsMarcheMiseEnVente
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
     * Set idPersonnage
     *
     * @param integer $idPersonnage
     *
     * @return LogsMarcheMiseEnVente
     */
    public function setIdPersonnage($idPersonnage)
    {
        $this->idPersonnage = $idPersonnage;

        return $this;
    }

    /**
     * Get idPersonnage
     *
     * @return integer
     */
    public function getIdPersonnage()
    {
        return $this->idPersonnage;
    }

    /**
     * Set prix
     *
     * @param integer $prix
     *
     * @return LogsMarcheMiseEnVente
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return integer
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set devise
     *
     * @param integer $devise
     *
     * @return LogsMarcheMiseEnVente
     */
    public function setDevise($devise)
    {
        $this->devise = $devise;

        return $this;
    }

    /**
     * Get devise
     *
     * @return integer
     */
    public function getDevise()
    {
        return $this->devise;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return LogsMarcheMiseEnVente
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
     * @return LogsMarcheMiseEnVente
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
