<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LogsRepairPosition
 *
 * @ORM\Table(name="site.logs_repair_position")
 * @ORM\Entity
 */
class LogsRepairPosition {

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
     * @ORM\Column(name="id_player", type="integer", nullable=true)
     */
    private $idPlayer;

    /**
     * @var string
     *
     * @ORM\Column(name="name_player", type="string", length=50, nullable=true)
     */
    private $namePlayer;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_compte", type="integer", nullable=true)
     */
    private $idCompte;

    /**
     * @var integer
     *
     * @ORM\Column(name="old_map_index", type="integer", nullable=true)
     */
    private $oldMapIndex;

    /**
     * @var integer
     *
     * @ORM\Column(name="old_x", type="integer", nullable=true)
     */
    private $oldX;

    /**
     * @var integer
     *
     * @ORM\Column(name="old_y", type="integer", nullable=true)
     */
    private $oldY;

    /**
     * @var integer
     *
     * @ORM\Column(name="new_map_index", type="integer", nullable=true)
     */
    private $newMapIndex;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="new_x", type="integer", nullable=true)
     */
    private $newX;

    /**
     * @var integer
     *
     * @ORM\Column(name="new_y", type="integer", nullable=true)
     */
    private $newY;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=25, nullable=true)
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
     * Set idPlayer
     *
     * @param integer $idPlayer
     *
     * @return LogsRepairPosition
     */
    public function setIdPlayer($idPlayer) {
        $this->idPlayer = $idPlayer;

        return $this;
    }

    /**
     * Get idPlayer
     *
     * @return integer
     */
    public function getIdPlayer() {
        return $this->idPlayer;
    }

    /**
     * Set namePlayer
     *
     * @param string $namePlayer
     *
     * @return LogsRepairPosition
     */
    public function setNamePlayer($namePlayer) {
        $this->namePlayer = $namePlayer;

        return $this;
    }

    /**
     * Get namePlayer
     *
     * @return string
     */
    public function getNamePlayer() {
        return $this->namePlayer;
    }

    /**
     * Set idCompte
     *
     * @param integer $idCompte
     *
     * @return LogsRepairPosition
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
     * Set oldMapIndex
     *
     * @param integer $oldMapIndex
     *
     * @return LogsRepairPosition
     */
    public function setOldMapIndex($oldMapIndex) {
        $this->oldMapIndex = $oldMapIndex;

        return $this;
    }

    /**
     * Get oldMapIndex
     *
     * @return integer
     */
    public function getOldMapIndex() {
        return $this->oldMapIndex;
    }
    
    /**
     * Set oldX
     *
     * @param integer $oldX
     *
     * @return LogsRepairPosition
     */
    public function setOldX($oldX) {
        $this->oldX = $oldX;

        return $this;
    }

    /**
     * Get oldX
     *
     * @return integer
     */
    public function getOldX() {
        return $this->oldX;
    }
    
    /**
     * Set oldY
     *
     * @param integer $oldY
     *
     * @return LogsRepairPosition
     */
    public function setOldY($oldY) {
        $this->oldY = $oldY;

        return $this;
    }

    /**
     * Get oldY
     *
     * @return integer
     */
    public function getOldY() {
        return $this->oldY;
    }
    
    /**
     * Set newMapIndex
     *
     * @param integer $newMapIndex
     *
     * @return LogsRepairPosition
     */
    public function setNewMapIndex($newMapIndex) {
        $this->newMapIndex = $newMapIndex;

        return $this;
    }

    /**
     * Get newMapIndex
     *
     * @return integer
     */
    public function getNewMapIndex() {
        return $this->newMapIndex;
    }
    
    /**
     * Set newX
     *
     * @param integer $newX
     *
     * @return LogsRepairPosition
     */
    public function setNewX($newX) {
        $this->newX = $newX;

        return $this;
    }

    /**
     * Get newX
     *
     * @return integer
     */
    public function getNewX() {
        return $this->newX;
    }
    
    /**
     * Set newY
     *
     * @param integer $newY
     *
     * @return LogsRepairPosition
     */
    public function setNewY($newY) {
        $this->newY = $newY;

        return $this;
    }

    /**
     * Get newY
     *
     * @return integer
     */
    public function getNewY() {
        return $this->newY;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return LogsRepairPosition
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
     * @return LogsRepairPosition
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
