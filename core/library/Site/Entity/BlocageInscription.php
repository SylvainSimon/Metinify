<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlocageInscription
 *
 * @ORM\Table(name="site.blocage_inscription")
 * @ORM\Entity(repositoryClass="Site\Repository\BlocageInscriptionRepository")
 */
class BlocageInscription {

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
     * @var string
     *
     * @ORM\Column(name="date_de_blocage", type="string", length=20, nullable=true)
     */
    private $dateDeBlocage;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set ip
     *
     * @param string $ip
     *
     * @return BlocageInscription
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
     * Set dateDeBlocage
     *
     * @param string $dateDeBlocage
     *
     * @return BlocageInscription
     */
    public function setDateDeBlocage($dateDeBlocage) {
        $this->dateDeBlocage = $dateDeBlocage;

        return $this;
    }

    /**
     * Get dateDeBlocage
     *
     * @return string
     */
    public function getDateDeBlocage() {
        return $this->dateDeBlocage;
    }

}
