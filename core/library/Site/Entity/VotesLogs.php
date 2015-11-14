<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VotesLogs
 *
 * @ORM\Table(name="site.votes_logs")
 * @ORM\Entity(repositoryClass="Site\Repository\VotesLogsRepository")
 */
class VotesLogs {

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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=255, nullable=true)
     */
    private $ip;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_site_vote", type="integer", nullable=true)
     */
    private $idSiteVote;

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
     * @return VotesLogs
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return VotesLogs
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
     * @return VotesLogs
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
     * Set idSiteVote
     *
     * @param integer $idSiteVote
     *
     * @return VotesLogs
     */
    public function setIdSiteVote($idSiteVote) {
        $this->idSiteVote = $idSiteVote;

        return $this;
    }

    /**
     * Get idSiteVote
     *
     * @return integer
     */
    public function getIdSiteVote() {
        return $this->idSiteVote;
    }

}
