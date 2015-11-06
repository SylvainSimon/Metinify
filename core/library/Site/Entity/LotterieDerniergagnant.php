<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LotterieDerniergagnant
 *
 * @ORM\Table(name="site.lotterie_derniergagnant")
 * @ORM\Entity
 */
class LotterieDerniergagnant
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
     * @return LotterieDerniergagnant
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
     * @return LotterieDerniergagnant
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
     * @return LotterieDerniergagnant
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
     * Set admin
     *
     * @param string $admin
     *
     * @return LotterieDerniergagnant
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
     * @return LotterieDerniergagnant
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
