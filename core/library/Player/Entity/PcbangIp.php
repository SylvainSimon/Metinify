<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PcbangIp
 *
 * @ORM\Table(name="pcbang_ip", uniqueConstraints={@ORM\UniqueConstraint(name="ip", columns={"ip"})}, indexes={@ORM\Index(name="pcbang_id", columns={"pcbang_id"})})
 * @ORM\Entity
 */
class PcbangIp
{
    /**
     * @var integer
     *
     * @ORM\Column(name="pcbang_id", type="integer", nullable=false)
     */
    private $pcbangId = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=15, nullable=false)
     */
    private $ip = '000.000.000.000';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set pcbangId
     *
     * @param integer $pcbangId
     *
     * @return PcbangIp
     */
    public function setPcbangId($pcbangId)
    {
        $this->pcbangId = $pcbangId;

        return $this;
    }

    /**
     * Get pcbangId
     *
     * @return integer
     */
    public function getPcbangId()
    {
        return $this->pcbangId;
    }

    /**
     * Set ip
     *
     * @param string $ip
     *
     * @return PcbangIp
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
