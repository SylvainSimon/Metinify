<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ControleChangementMail
 *
 * @ORM\Table(name="site.controle_changement_mail")
 * @ORM\Entity(repositoryClass="Site\Repository\ControleChangementMailRepository")
 */
class ControleChangementMail {

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
     * @ORM\Column(name="email", type="string", length=100, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_verif", type="string", length=18, nullable=true)
     */
    private $numeroVerif;

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
    public function getId() {
        return $this->id;
    }

    /**
     * Set idCompte
     *
     * @param integer $idCompte
     *
     * @return ControleChangementMail
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
     * @return ControleChangementMail
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
     * Set email
     *
     * @param string $email
     *
     * @return ControleChangementMail
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set numeroVerif
     *
     * @param string $numeroVerif
     *
     * @return ControleChangementMail
     */
    public function setNumeroVerif($numeroVerif) {
        $this->numeroVerif = $numeroVerif;

        return $this;
    }

    /**
     * Get numeroVerif
     *
     * @return string
     */
    public function getNumeroVerif() {
        return $this->numeroVerif;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return ControleChangementMail
     */
    public function setDate($date) {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * Set ip
     *
     * @param string $ip
     *
     * @return ControleChangementMail
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
