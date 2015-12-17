<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LogsAdminGererMonnaie
 *
 * @ORM\Table(name="site.logs_admin_gerer_monnaie")
 * @ORM\Entity(repositoryClass="Site\Repository\LogsAdminGererMonnaieRepository")
 */
class LogsAdminGererMonnaie {

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
     * @ORM\Column(name="montant", type="integer", nullable=true)
     */
    private $montant;

    /**
     * @var integer
     *
     * @ORM\Column(name="devise", type="integer", nullable=true)
     */
    private $devise;

    /**
     * @var integer
     *
     * @ORM\Column(name="operation", type="integer", nullable=true)
     */
    private $operation;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_gm", type="integer", nullable=true)
     */
    private $idGm;

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
    public function getId() {
        return $this->id;
    }

    /**
     * Set idCompte
     *
     * @param integer $idCompte
     *
     * @return LogsAdminGererMonnaie
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
     * Set montant
     *
     * @param integer $montant
     *
     * @return LogsAdminGererMonnaie
     */
    public function setMontant($montant) {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return integer
     */
    public function getMontant() {
        return $this->montant;
    }

    /**
     * Set devise
     *
     * @param integer $devise
     *
     * @return LogsAdminGererMonnaie
     */
    public function setDevise($devise) {
        $this->devise = $devise;

        return $this;
    }

    /**
     * Get devise
     *
     * @return integer
     */
    public function getDevise() {
        return $this->devise;
    }

    /**
     * Set operation
     *
     * @param integer $operation
     *
     * @return LogsAdminGererMonnaie
     */
    public function setOperation($operation) {
        $this->operation = $operation;

        return $this;
    }

    /**
     * Get operation
     *
     * @return integer
     */
    public function getOperation() {
        return $this->operation;
    }

    /**
     * Set idGm
     *
     * @param integer $idGm
     *
     * @return LogsAdminGererMonnaie
     */
    public function setIdGm($idGm) {
        $this->idGm = $idGm;

        return $this;
    }

    /**
     * Get idGm
     *
     * @return integer
     */
    public function getIdGm() {
        return $this->idGm;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return LogsAdminGererMonnaie
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
     * @return LogsAdminGererMonnaie
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
