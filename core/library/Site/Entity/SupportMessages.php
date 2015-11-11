<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SupportMessages
 *
 * @ORM\Table(name="site.support_messages")
 * @ORM\Entity(repositoryClass="Site\Repository\SupportMessagesRepository")
 */
class SupportMessages {

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
     * @ORM\Column(name="idDiscussion", type="integer", nullable=false)
     */
    private $idDiscussion = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="string", nullable=false)
     */
    private $message;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date = '0000-00-00 00:00:00';

    /**
     * @var integer
     *
     * @ORM\Column(name="etat", type="integer", nullable=false)
     */
    private $etat = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateChangementEtat", type="datetime", nullable=false)
     */
    private $datechangementetat = '0000-00-00 00:00:00';

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
     * @return SupportMessages
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
     * Set idDiscussion
     *
     * @param integer $idDiscussion
     *
     * @return SupportMessages
     */
    public function setIdDiscussion($idDiscussion) {
        $this->idDiscussion = $idDiscussion;

        return $this;
    }

    /**
     * Get idDiscussion
     *
     * @return integer
     */
    public function getIdDiscussion() {
        return $this->idDiscussion;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return SupportMessages
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
     * @return SupportMessages
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
     * Set etat
     *
     * @param integer $etat
     *
     * @return SupportMessages
     */
    public function setEtat($etat) {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return integer
     */
    public function getEtat() {
        return $this->etat;
    }

    /**
     * Set datechangementetat
     *
     * @param \DateTime $datechangementetat
     *
     * @return SupportMessages
     */
    public function setDatechangementEtat($datechangementetat) {
        $this->datechangementetat = $datechangementetat;

        return $this;
    }

    /**
     * Get datechangementetat
     *
     * @return \DateTime
     */
    public function getDatechangementEtat() {
        return $this->datechangementetat;
    }

    /**
     * Set ip
     *
     * @param integer $ip
     *
     * @return SupportMessages
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
