<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AdminNews
 *
 * @ORM\Table(name="site.admin_news", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})})
 * @ORM\Entity
 */
class AdminNews
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
     * @ORM\Column(name="auteur", type="integer", nullable=true)
     */
    private $auteur;

    /**
     * @var string
     *
     * @ORM\Column(name="titre_message", type="string", length=255, nullable=true)
     */
    private $titreMessage;

    /**
     * @var string
     *
     * @ORM\Column(name="contenue_message", type="string", length=10240, nullable=true)
     */
    private $contenueMessage;

    /**
     * @var string
     *
     * @ORM\Column(name="lien_illustration", type="string", length=255, nullable=true)
     */
    private $lienIllustration;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
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
     * Set auteur
     *
     * @param integer $auteur
     *
     * @return AdminNews
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return integer
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set titreMessage
     *
     * @param string $titreMessage
     *
     * @return AdminNews
     */
    public function setTitreMessage($titreMessage)
    {
        $this->titreMessage = $titreMessage;

        return $this;
    }

    /**
     * Get titreMessage
     *
     * @return string
     */
    public function getTitreMessage()
    {
        return $this->titreMessage;
    }

    /**
     * Set contenueMessage
     *
     * @param string $contenueMessage
     *
     * @return AdminNews
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
     * Set lienIllustration
     *
     * @param string $lienIllustration
     *
     * @return AdminNews
     */
    public function setLienIllustration($lienIllustration)
    {
        $this->lienIllustration = $lienIllustration;

        return $this;
    }

    /**
     * Get lienIllustration
     *
     * @return string
     */
    public function getLienIllustration()
    {
        return $this->lienIllustration;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return AdminNews
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
}
