<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IpPaysFr
 *
 * @ORM\Table(name="site.ip_pays_fr", indexes={@ORM\Index(name="COUNTRY_NAME", columns={"country_name"})})
 * @ORM\Entity
 */
class IpPaysFr
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="country_name", type="string", length=50)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $countryName;

    /**
     * @var string
     *
     * @ORM\Column(name="country_name_fr", type="string", length=80, nullable=false)
     */
    private $countryNameFr;



    /**
     * Set id
     *
     * @param integer $id
     *
     * @return IpPaysFr
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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

    /**
     * Set countryName
     *
     * @param string $countryName
     *
     * @return IpPaysFr
     */
    public function setCountryName($countryName)
    {
        $this->countryName = $countryName;

        return $this;
    }

    /**
     * Get countryName
     *
     * @return string
     */
    public function getCountryName()
    {
        return $this->countryName;
    }

    /**
     * Set countryNameFr
     *
     * @param string $countryNameFr
     *
     * @return IpPaysFr
     */
    public function setCountryNameFr($countryNameFr)
    {
        $this->countryNameFr = $countryNameFr;

        return $this;
    }

    /**
     * Get countryNameFr
     *
     * @return string
     */
    public function getCountryNameFr()
    {
        return $this->countryNameFr;
    }
}
