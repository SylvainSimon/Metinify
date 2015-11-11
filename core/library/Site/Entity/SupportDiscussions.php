<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SupportDiscussions
 *
 * @ORM\Table(name="site.support_discussions")
 * @ORM\Entity(repositoryClass="Site\Repository\SupportDiscussionsRepository")
 */
class SupportDiscussions {

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
     * @ORM\Column(name="idCompte", type="integer", nullable=false)
     */
    private $idCompte = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="idAdmin", type="integer", nullable=false)
     */
    private $idAdmin = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="idObjet", type="integer", nullable=false)
     */
    private $idObjet = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", length=65535, nullable=false)
     */
    private $message;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date = '0000-00-00 00:00:00';

    /**
     * @var boolean
     *
     * @ORM\Column(name="estArchive", type="boolean", nullable=false)
     */
    private $estArchive = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="ip", type="integer", nullable=false)
     */
    private $ip = '0';

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
     * @return SupportDiscussions
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
     * Set idAdmin
     *
     * @param integer $idAdmin
     *
     * @return SupportDiscussions
     */
    public function setIdAdmin($idAdmin) {
        $this->idAdmin = $idAdmin;

        return $this;
    }

    /**
     * Get idAdmin
     *
     * @return integer
     */
    public function getIdAdmin() {
        return $this->idAdmin;
    }

    /**
     * Set idObjet
     *
     * @param integer $idObjet
     *
     * @return SupportDiscussions
     */
    public function setIdObjet($idObjet) {
        $this->idObjet = $idObjet;

        return $this;
    }

    /**
     * Get idObjet
     *
     * @return integer
     */
    public function getIdObjet() {
        return $this->idObjet;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return SupportDiscussions
     */
    public function setMessage($message) {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage() {
        return $this->message;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return SupportDiscussions
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
     * Set estArchive
     *
     * @param boolean $estArchive
     *
     * @return SupportDiscussions
     */
    public function setEstArchive($estArchive) {
        $this->estArchive = $estArchive;

        return $this;
    }

    /**
     * Get estArchive
     *
     * @return boolean
     */
    public function getEstArchive() {
        return $this->estArchive;
    }

    /**
     * Set ip
     *
     * @param integer $ip
     *
     * @return SupportDiscussions
     */
    public function setIp($ip) {
        $this->ip = ip2long($ip);
        return $this;
    }

    /**
     * Get ip
     *
     * @return integer
     */
    public function getIp() {
        return long2ip($this->ip);
    }

}
