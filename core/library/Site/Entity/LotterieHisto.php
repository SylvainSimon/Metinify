<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LotterieHisto
 *
 * @ORM\Table(name="site.lotterie_histo")
 * @ORM\Entity
 */
class LotterieHisto
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
     * @var string
     *
     * @ORM\Column(name="date", type="string", length=30, nullable=true)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="gagnant", type="string", length=30, nullable=true)
     */
    private $gagnant;

    /**
     * @var string
     *
     * @ORM\Column(name="recompense", type="string", length=50, nullable=true)
     */
    private $recompense;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=30, nullable=true)
     */
    private $ip;

    /**
     * @var string
     *
     * @ORM\Column(name="admin", type="string", length=30, nullable=true)
     */
    private $admin;

    /**
     * @var string
     *
     * @ORM\Column(name="ip_admin", type="string", length=30, nullable=true)
     */
    private $ipAdmin;



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
     * Set date
     *
     * @param string $date
     *
     * @return LotterieHisto
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set gagnant
     *
     * @param string $gagnant
     *
     * @return LotterieHisto
     */
    public function setGagnant($gagnant)
    {
        $this->gagnant = $gagnant;

        return $this;
    }

    /**
     * Get gagnant
     *
     * @return string
     */
    public function getGagnant()
    {
        return $this->gagnant;
    }

    /**
     * Set recompense
     *
     * @param string $recompense
     *
     * @return LotterieHisto
     */
    public function setRecompense($recompense)
    {
        $this->recompense = $recompense;

        return $this;
    }

    /**
     * Get recompense
     *
     * @return string
     */
    public function getRecompense()
    {
        return $this->recompense;
    }

    /**
     * Set ip
     *
     * @param string $ip
     *
     * @return LotterieHisto
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

    /**
     * Set admin
     *
     * @param string $admin
     *
     * @return LotterieHisto
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;

        return $this;
    }

    /**
     * Get admin
     *
     * @return string
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * Set ipAdmin
     *
     * @param string $ipAdmin
     *
     * @return LotterieHisto
     */
    public function setIpAdmin($ipAdmin)
    {
        $this->ipAdmin = $ipAdmin;

        return $this;
    }

    /**
     * Get ipAdmin
     *
     * @return string
     */
    public function getIpAdmin()
    {
        return $this->ipAdmin;
    }
}
