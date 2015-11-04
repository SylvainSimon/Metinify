<?php

namespace Player\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GuildWarReservation
 *
 * @ORM\Table(name="player.guild_war_reservation")
 * @ORM\Entity
 */
class GuildWarReservation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="guild1", type="integer", nullable=false)
     */
    private $guild1 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="guild2", type="integer", nullable=false)
     */
    private $guild2 = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="datetime", nullable=false)
     */
    private $time = '0000-00-00 00:00:00';

    /**
     * @var boolean
     *
     * @ORM\Column(name="type", type="boolean", nullable=false)
     */
    private $type = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="warprice", type="integer", nullable=false)
     */
    private $warprice = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="initscore", type="integer", nullable=false)
     */
    private $initscore = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="started", type="boolean", nullable=false)
     */
    private $started = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="bet_from", type="integer", nullable=false)
     */
    private $betFrom = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="bet_to", type="integer", nullable=false)
     */
    private $betTo = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="winner", type="integer", nullable=false)
     */
    private $winner = '-1';

    /**
     * @var integer
     *
     * @ORM\Column(name="power1", type="integer", nullable=false)
     */
    private $power1 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="power2", type="integer", nullable=false)
     */
    private $power2 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="handicap", type="integer", nullable=false)
     */
    private $handicap = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="result1", type="integer", nullable=false)
     */
    private $result1 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="result2", type="integer", nullable=false)
     */
    private $result2 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set guild1
     *
     * @param integer $guild1
     *
     * @return GuildWarReservation
     */
    public function setGuild1($guild1)
    {
        $this->guild1 = $guild1;

        return $this;
    }

    /**
     * Get guild1
     *
     * @return integer
     */
    public function getGuild1()
    {
        return $this->guild1;
    }

    /**
     * Set guild2
     *
     * @param integer $guild2
     *
     * @return GuildWarReservation
     */
    public function setGuild2($guild2)
    {
        $this->guild2 = $guild2;

        return $this;
    }

    /**
     * Get guild2
     *
     * @return integer
     */
    public function getGuild2()
    {
        return $this->guild2;
    }

    /**
     * Set time
     *
     * @param \DateTime $time
     *
     * @return GuildWarReservation
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set type
     *
     * @param boolean $type
     *
     * @return GuildWarReservation
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return boolean
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set warprice
     *
     * @param integer $warprice
     *
     * @return GuildWarReservation
     */
    public function setWarprice($warprice)
    {
        $this->warprice = $warprice;

        return $this;
    }

    /**
     * Get warprice
     *
     * @return integer
     */
    public function getWarprice()
    {
        return $this->warprice;
    }

    /**
     * Set initscore
     *
     * @param integer $initscore
     *
     * @return GuildWarReservation
     */
    public function setInitscore($initscore)
    {
        $this->initscore = $initscore;

        return $this;
    }

    /**
     * Get initscore
     *
     * @return integer
     */
    public function getInitscore()
    {
        return $this->initscore;
    }

    /**
     * Set started
     *
     * @param boolean $started
     *
     * @return GuildWarReservation
     */
    public function setStarted($started)
    {
        $this->started = $started;

        return $this;
    }

    /**
     * Get started
     *
     * @return boolean
     */
    public function getStarted()
    {
        return $this->started;
    }

    /**
     * Set betFrom
     *
     * @param integer $betFrom
     *
     * @return GuildWarReservation
     */
    public function setBetFrom($betFrom)
    {
        $this->betFrom = $betFrom;

        return $this;
    }

    /**
     * Get betFrom
     *
     * @return integer
     */
    public function getBetFrom()
    {
        return $this->betFrom;
    }

    /**
     * Set betTo
     *
     * @param integer $betTo
     *
     * @return GuildWarReservation
     */
    public function setBetTo($betTo)
    {
        $this->betTo = $betTo;

        return $this;
    }

    /**
     * Get betTo
     *
     * @return integer
     */
    public function getBetTo()
    {
        return $this->betTo;
    }

    /**
     * Set winner
     *
     * @param integer $winner
     *
     * @return GuildWarReservation
     */
    public function setWinner($winner)
    {
        $this->winner = $winner;

        return $this;
    }

    /**
     * Get winner
     *
     * @return integer
     */
    public function getWinner()
    {
        return $this->winner;
    }

    /**
     * Set power1
     *
     * @param integer $power1
     *
     * @return GuildWarReservation
     */
    public function setPower1($power1)
    {
        $this->power1 = $power1;

        return $this;
    }

    /**
     * Get power1
     *
     * @return integer
     */
    public function getPower1()
    {
        return $this->power1;
    }

    /**
     * Set power2
     *
     * @param integer $power2
     *
     * @return GuildWarReservation
     */
    public function setPower2($power2)
    {
        $this->power2 = $power2;

        return $this;
    }

    /**
     * Get power2
     *
     * @return integer
     */
    public function getPower2()
    {
        return $this->power2;
    }

    /**
     * Set handicap
     *
     * @param integer $handicap
     *
     * @return GuildWarReservation
     */
    public function setHandicap($handicap)
    {
        $this->handicap = $handicap;

        return $this;
    }

    /**
     * Get handicap
     *
     * @return integer
     */
    public function getHandicap()
    {
        return $this->handicap;
    }

    /**
     * Set result1
     *
     * @param integer $result1
     *
     * @return GuildWarReservation
     */
    public function setResult1($result1)
    {
        $this->result1 = $result1;

        return $this;
    }

    /**
     * Get result1
     *
     * @return integer
     */
    public function getResult1()
    {
        return $this->result1;
    }

    /**
     * Set result2
     *
     * @param integer $result2
     *
     * @return GuildWarReservation
     */
    public function setResult2($result2)
    {
        $this->result2 = $result2;

        return $this;
    }

    /**
     * Get result2
     *
     * @return integer
     */
    public function getResult2()
    {
        return $this->result2;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
