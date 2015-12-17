<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ControleChangementMotDePasse
 *
 * @ORM\Table(name="site.controle_changement_mot_de_passe")
 * @ORM\Entity(repositoryClass="Site\Repository\ControleChangementMotDePasseRepository")
 */
class ControleChangementMotDePasse {

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
     * @ORM\Column(name="nouveau_mot_de_passe", type="string", length=100, nullable=true)
     */
    private $nouveauMotDePasse;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero_verif", type="integer", nullable=true)
     */
    private $numeroVerif;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="string", length=20, nullable=true)
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
    public function getId() {
        return $this->id;
    }

    /**
     * Set idCompte
     *
     * @param integer $idCompte
     *
     * @return ControleChangementMotDePasse
     */
    public function setIdCompte($idCompte) {
        $this->idCompte = $idCompte;

        return $this;
    }

    /**
     * Get idCompte
     *
     * @return integer
     */
    public function getIdCompte() {
        return $this->idCompte;
    }

    /**
     * Set compte
     *
     * @param string $compte
     *
     * @return ControleChangementMotDePasse
     */
    public function setCompte($compte) {
        $this->compte = $compte;

        return $this;
    }

    /**
     * Get compte
     *
     * @return string
     */
    public function getCompte() {
        return $this->compte;
    }

    /**
     * Set nouveauMotDePasse
     *
     * @param string $nouveauMotDePasse
     *
     * @return ControleChangementMotDePasse
     */
    public function setNouveauMotDePasse($nouveauMotDePasse) {
        $this->nouveauMotDePasse = $nouveauMotDePasse;

        return $this;
    }

    /**
     * Get nouveauMotDePasse
     *
     * @return string
     */
    public function getNouveauMotDePasse() {
        return $this->nouveauMotDePasse;
    }

    /**
     * Set numeroVerif
     *
     * @param integer $numeroVerif
     *
     * @return ControleChangementMotDePasse
     */
    public function setNumeroVerif($numeroVerif) {
        $this->numeroVerif = $numeroVerif;

        return $this;
    }

    /**
     * Get numeroVerif
     *
     * @return integer
     */
    public function getNumeroVerif() {
        return $this->numeroVerif;
    }

    /**
     * Set date
     *
     * @param string $date
     *
     * @return ControleChangementMotDePasse
     */
    public function setDate($date) {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return string
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * Set ip
     *
     * @param string $ip
     *
     * @return ControleChangementMotDePasse
     */
    public function setIp($ip) {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp() {
        return $this->ip;
    }

}
