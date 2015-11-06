<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SupportTicketAttente
 *
 * @ORM\Table(name="site.support_ticket_attente", uniqueConstraints={@ORM\UniqueConstraint(name="numero_discussion", columns={"numero_discussion"})})
 * @ORM\Entity
 */
class SupportTicketAttente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="numero_discussion", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $numeroDiscussion;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_compte", type="integer", nullable=true)
     */
    private $idCompte;

    /**
     * @var string
     *
     * @ORM\Column(name="objet_message", type="string", length=100, nullable=true)
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
     * Get numeroDiscussion
     *
     * @return integer
     */
    public function getNumeroDiscussion()
    {
        return $this->numeroDiscussion;
    }

    /**
     * Set idCompte
     *
     * @param integer $idCompte
     *
     * @return SupportTicketAttente
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
     * Set objetMessage
     *
     * @param string $objetMessage
     *
     * @return SupportTicketAttente
     */
    public function setObjetMessage($objetMessage)
    {
        $this->objetMessage = $objetMessage;

        return $this;
    }

    /**
     * Get objetMessage
     *
     * @return string
     */
    public function getObjetMessage()
    {
        return $this->objetMessage;
    }

    /**
     * Set contenueMessage
     *
     * @param string $contenueMessage
     *
     * @return SupportTicketAttente
     */
    public function setContenueMessage($contenueMessage)
    {
        $this->contenueMessage = $contenueMessage;

        return $this;
    }

    /**
     * Get contenueMessage
     *
     * @return string
     */
    public function getContenueMessage()
    {
        return $this->contenueMessage;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return SupportTicketAttente
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
     * @return SupportTicketAttente
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
