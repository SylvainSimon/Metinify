<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GuildWarBet
 *
 * @ORM\Table(name="guild_war_bet")
 * @ORM\Entity
 */
class GuildWarBet
{
    /**
     * @var integer
     *
     * @ORM\Column(name="gold", type="integer", nullable=false)
     */
    private $gold = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="guild", type="integer", nullable=false)
     */
    private $guild = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="war_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $warId;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=24)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $login;



    /**
     * Set gold
     *
     * @param integer $gold
     *
     * @return GuildWarBet
     */
    public function setGold($gold)
    {
        $this->gold = $gold;

        return $this;
    }

    /**
     * Get gold
     *
     * @return integer
     */
    public function getGold()
    {
        return $this->gold;
    }

    /**
     * Set guild
     *
     * @param integer $guild
     *
     * @return GuildWarBet
     */
    public function setGuild($guild)
    {
        $this->guild = $guild;

        return $this;
    }

    /**
     * Get guild
     *
     * @return integer
     */
    public function getGuild()
    {
        return $this->guild;
    }

    /**
     * Set warId
     *
     * @param integer $warId
     *
     * @return GuildWarBet
     */
    public function setWarId($warId)
    {
        $this->warId = $warId;

        return $this;
    }

    /**
     * Get warId
     *
     * @return integer
     */
    public function getWarId()
    {
        return $this->warId;
    }

    /**
     * Set login
     *
     * @param string $login
     *
     * @return GuildWarBet
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }
}
