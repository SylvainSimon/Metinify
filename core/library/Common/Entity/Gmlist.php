<?php

namespace Common\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gmlist
 *
 * @ORM\Table(name="common.gmlist")
 * @ORM\Entity(repositoryClass="Common\Repository\GmlistRepository")
 */
class Gmlist {

    /**
     * @var string
     *
     * @ORM\Column(name="mAccount", type="string", length=16, nullable=false)
     */
    private $maccount = '';

    /**
     * @var string
     *
     * @ORM\Column(name="mName", type="string", length=16, nullable=false)
     */
    private $mname = '';

    /**
     * @var string
     *
     * @ORM\Column(name="mContactIP", type="string", length=16, nullable=false)
     */
    private $mcontactip = '';

    /**
     * @var string
     *
     * @ORM\Column(name="mServerIP", type="string", length=16, nullable=false)
     */
    private $mserverip = 'ALL';

    /**
     * @var string
     *
     * @ORM\Column(name="mAuthority", type="string", nullable=true)
     */
    private $mauthority = 'PLAYER';

    /**
     * @var integer
     *
     * @ORM\Column(name="mID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $mid;

    /**
     * Set maccount
     *
     * @param string $maccount
     *
     * @return Gmlist
     */
    public function setMaccount($maccount) {
        $this->maccount = $maccount;

        return $this;
    }

    /**
     * Get maccount
     *
     * @return string
     */
    public function getMaccount() {
        return $this->maccount;
    }

    /**
     * Set mname
     *
     * @param string $mname
     *
     * @return Gmlist
     */
    public function setMname($mname) {
        $this->mname = $mname;

        return $this;
    }

    /**
     * Get mname
     *
     * @return string
     */
    public function getMname() {
        return $this->mname;
    }

    /**
     * Set mcontactip
     *
     * @param string $mcontactip
     *
     * @return Gmlist
     */
    public function setMcontactip($mcontactip) {
        $this->mcontactip = $mcontactip;

        return $this;
    }

    /**
     * Get mcontactip
     *
     * @return string
     */
    public function getMcontactip() {
        return $this->mcontactip;
    }

    /**
     * Set mserverip
     *
     * @param string $mserverip
     *
     * @return Gmlist
     */
    public function setMserverip($mserverip) {
        $this->mserverip = $mserverip;

        return $this;
    }

    /**
     * Get mserverip
     *
     * @return string
     */
    public function getMserverip() {
        return $this->mserverip;
    }

    /**
     * Set mauthority
     *
     * @param string $mauthority
     *
     * @return Gmlist
     */
    public function setMauthority($mauthority) {
        $this->mauthority = $mauthority;

        return $this;
    }

    /**
     * Get mauthority
     *
     * @return string
     */
    public function getMauthority() {
        return $this->mauthority;
    }

    /**
     * Get mid
     *
     * @return integer
     */
    public function getMid() {
        return $this->mid;
    }

}
