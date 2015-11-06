<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SupportTicketTraitement
 *
 * @ORM\Table(name="site.support_ticket_traitement", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="id_recepteur", columns={"id_emmeteur"})})
 * @ORM\Entity
 */
class SupportTicketTraitement {

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
     * @ORM\Column(name="id_emmeteur", type="integer", nullable=true)
     */
    private $idEmmeteur;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_recepteur", type="integer", nullable=true)
     */
    private $idRecepteur;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero_discussion", type="integer", nullable=true)
     */
    private $numeroDiscussion;

    /**
     * @var string
     *
     * @ORM\Column(name="objet_message", type="string", length=50, nullable=true)
     */
    private $objetMessage;

    /**
     * @var string
     *
     * @ORM\Column(name="contenue_message", type="text", length=65535, nullable=true)
     */
    private $contenueMessage;

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
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=15, nullable=true)
     */
    private $etat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_vue", type="datetime", nullable=true)
     */
    private $dateVue;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=20, nullable=true)
     */
    private $type = 'Support';

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set idEmmeteur
     *
     * @param integer $idEmmeteur
     *
     * @return SupportTicketTraitement
     */
    public function setIdEmmeteur($idEmmeteur) {
        $this->idEmmeteur = $idEmmeteur;

        return $this;
    }

    /**
     * Get idEmmeteur
     *
     * @return integer
     */
    public function getIdEmmeteur() {
        return $this->idEmmeteur;
    }

    /**
     * Set idRecepteur
     *
     * @param integer $idRecepteur
     *
     * @return SupportTicketTraitement
     */
    public function setIdRecepteur($idRecepteur) {
        $this->idRecepteur = $idRecepteur;

        return $this;
    }

    /**
     * Get idRecepteur
     *
     * @return integer
     */
    public function getIdRecepteur() {
        return $this->idRecepteur;
    }

    /**
     * Set numeroDiscussion
     *
     * @param integer $numeroDiscussion
     *
     * @return SupportTicketTraitement
     */
    public function setNumeroDiscussion($numeroDiscussion) {
        $this->numeroDiscussion = $numeroDiscussion;

        return $this;
    }

    /**
     * Get numeroDiscussion
     *
     * @return integer
     */
    public function getNumeroDiscussion() {
        return $this->numeroDiscussion;
    }

    /**
     * Set objetMessage
     *
     * @param string $objetMessage
     *
     * @return SupportTicketTraitement
     */
    public function setObjetMessage($objetMessage) {
        $this->objetMessage = $objetMessage;

        return $this;
    }

    /**
     * Get objetMessage
     *
     * @return string
     */
    public function getObjetMessage() {
        return $this->objetMessage;
    }

    /**
     * Set contenueMessage
     *
     * @param string $contenueMessage
     *
     * @return SupportTicketTraitement
     */
    public function setContenueMessage($contenueMessage) {
        $this->contenueMessage = $contenueMessage;

        return $this;
    }

    /**
     * Get contenueMessage
     *
     * @return string
     */
    public function getContenueMessage() {
        return $this->contenueMessage;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return SupportTicketTraitement
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
     * @return SupportTicketTraitement
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

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return SupportTicketTraitement
     */
    public function setEtat($etat) {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat() {
        return $this->etat;
    }

    /**
     * Set dateVue
     *
     * @param \DateTime $dateVue
     *
     * @return SupportTicketTraitement
     */
    public function setDateVue($dateVue) {
        $this->dateVue = $dateVue;

        return $this;
    }

    /**
     * Get dateVue
     *
     * @return \DateTime
     */
    public function getDateVue() {
        return $this->dateVue;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return SupportTicketTraitement
     */
    public function setType($type) {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType() {
        return $this->type;
    }

}
