<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IpToCountry
 *
 * @ORM\Table(name="site.ip_to_country")
 * @ORM\Entity
 */
class IpToCountry {

    /**
     * @var integer
     *
     * @ORM\Column(name="IP_FROM", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $ipFrom;

    /**
     * @var integer
     *
     * @ORM\Column(name="IP_TO", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $ipTo;

    /**
     * @var string
     *
     * @ORM\Column(name="REGISTRY", type="string", length=7, nullable=false)
     */
    private $registry;

    /**
     * @var integer
     *
     * @ORM\Column(name="ASSIGNED", type="bigint", nullable=false)
     */
    private $assigned;

    /**
     * @var string
     *
     * @ORM\Column(name="CTRY", type="string", length=2, nullable=false)
     */
    private $ctry;

    /**
     * @var string
     *
     * @ORM\Column(name="CNTRY", type="string", length=3, nullable=false)
     */
    private $cntry;

    /**
     * @var string
     *
     * @ORM\Column(name="COUNTRY", type="string", length=100, nullable=false)
     */
    private $country;

    /**
     * Set ipFrom
     *
     * @param integer $ipFrom
     *
     * @return IpToCountry
     */
    public function setIpFrom($ipFrom) {
        $this->ipFrom = $ipFrom;

        return $this;
    }

    /**
     * Get ipFrom
     *
     * @return integer
     */
    public function getIpFrom() {
        return $this->ipFrom;
    }

    /**
     * Set ipTo
     *
     * @param integer $ipTo
     *
     * @return IpToCountry
     */
    public function setIpTo($ipTo) {
        $this->ipTo = $ipTo;

        return $this;
    }

    /**
     * Get ipTo
     *
     * @return integer
     */
    public function getIpTo() {
        return $this->ipTo;
    }

    /**
     * Set registry
     *
     * @param string $registry
     *
     * @return IpToCountry
     */
    public function setRegistry($registry) {
        $this->registry = $registry;

        return $this;
    }

    /**
     * Get registry
     *
     * @return string
     */
    public function getRegistry() {
        return $this->registry;
    }

    /**
     * Set assigned
     *
     * @param integer $assigned
     *
     * @return IpToCountry
     */
    public function setAssigned($assigned) {
        $this->assigned = $assigned;

        return $this;
    }

    /**
     * Get assigned
     *
     * @return integer
     */
    public function getAssigned() {
        return $this->assigned;
    }

    /**
     * Set ctry
     *
     * @param string $ctry
     *
     * @return IpToCountry
     */
    public function setCtry($ctry) {
        $this->ctry = $ctry;

        return $this;
    }

    /**
     * Get ctry
     *
     * @return string
     */
    public function getCtry() {
        return $this->ctry;
    }

    /**
     * Set cntry
     *
     * @param string $cntry
     *
     * @return IpToCountry
     */
    public function setCntry($cntry) {
        $this->cntry = $cntry;

        return $this;
    }

    /**
     * Get cntry
     *
     * @return string
     */
    public function getCntry() {
        return $this->cntry;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return IpToCountry
     */
    public function setCountry($country) {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry() {
        return $this->country;
    }

}
