<?php

namespace Account\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Iptocountry
 *
 * @ORM\Table(name="account.iptocountry")
 * @ORM\Entity
 */
class Iptocountry {

    /**
     * @var string
     *
     * @ORM\Column(name="IP_FROM", type="string", length=16, nullable=true)
     */
    private $ipFrom;

    /**
     * @var string
     *
     * @ORM\Column(name="IP_TO", type="string", length=16, nullable=true)
     */
    private $ipTo;

    /**
     * @var string
     *
     * @ORM\Column(name="COUNTRY_NAME", type="string", length=16, nullable=true)
     */
    private $countryName;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Set ipFrom
     *
     * @param string $ipFrom
     *
     * @return Iptocountry
     */
    public function setIpFrom($ipFrom) {
        $this->ipFrom = $ipFrom;

        return $this;
    }

    /**
     * Get ipFrom
     *
     * @return string
     */
    public function getIpFrom() {
        return $this->ipFrom;
    }

    /**
     * Set ipTo
     *
     * @param string $ipTo
     *
     * @return Iptocountry
     */
    public function setIpTo($ipTo) {
        $this->ipTo = $ipTo;

        return $this;
    }

    /**
     * Get ipTo
     *
     * @return string
     */
    public function getIpTo() {
        return $this->ipTo;
    }

    /**
     * Set countryName
     *
     * @param string $countryName
     *
     * @return Iptocountry
     */
    public function setCountryName($countryName) {
        $this->countryName = $countryName;

        return $this;
    }

    /**
     * Get countryName
     *
     * @return string
     */
    public function getCountryName() {
        return $this->countryName;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

}
