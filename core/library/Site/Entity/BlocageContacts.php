<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlocageContacts
 *
 * @ORM\Table(name="site.blocage_contacts")
 * @ORM\Entity
 */
class BlocageContacts
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
     * @ORM\Column(name="ip", type="string", length=15, nullable=true)
     */
    private $ip;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_de_blocage", type="datetime", nullable=true)
     */
    private $dateDeBlocage;



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
     * Set ip
     *
     * @param string $ip
     *
     * @return BlocageContacts
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
     * Set dateDeBlocage
     *
     * @param \DateTime $dateDeBlocage
     *
     * @return BlocageContacts
     */
    public function setDateDeBlocage($dateDeBlocage)
    {
        $this->dateDeBlocage = $dateDeBlocage;

        return $this;
    }

    /**
     * Get dateDeBlocage
     *
     * @return \DateTime
     */
    public function getDateDeBlocage()
    {
        return $this->dateDeBlocage;
    }
}
