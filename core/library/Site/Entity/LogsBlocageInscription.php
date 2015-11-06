<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LogsBlocageInscription
 *
 * @ORM\Table(name="site.logs_blocage_inscription")
 * @ORM\Entity
 */
class LogsBlocageInscription
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
     * @ORM\Column(name="date_blocage", type="string", length=20, nullable=true)
     */
    private $dateBlocage;

    /**
     * @var string
     *
     * @ORM\Column(name="date_deblocage", type="string", length=20, nullable=true)
     */
    private $dateDeblocage;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=15, nullable=true)
     */
    private $ip;



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
     * Set dateBlocage
     *
     * @param string $dateBlocage
     *
     * @return LogsBlocageInscription
     */
    public function setDateBlocage($dateBlocage)
    {
        $this->dateBlocage = $dateBlocage;

        return $this;
    }

    /**
     * Get dateBlocage
     *
     * @return string
     */
    public function getDateBlocage()
    {
        return $this->dateBlocage;
    }

    /**
     * Set dateDeblocage
     *
     * @param string $dateDeblocage
     *
     * @return LogsBlocageInscription
     */
    public function setDateDeblocage($dateDeblocage)
    {
        $this->dateDeblocage = $dateDeblocage;

        return $this;
    }

    /**
     * Get dateDeblocage
     *
     * @return string
     */
    public function getDateDeblocage()
    {
        return $this->dateDeblocage;
    }

    /**
     * Set ip
     *
     * @param string $ip
     *
     * @return LogsBlocageInscription
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
