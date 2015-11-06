<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BannissementRaisons
 *
 * @ORM\Table(name="site.bannissement_raisons")
 * @ORM\Entity
 */
class BannissementRaisons {

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
     * @ORM\Column(name="raison", type="string", length=75, nullable=true)
     */
    private $raison;

    /**
     * @var integer
     *
     * @ORM\Column(name="sanction", type="integer", nullable=true)
     */
    private $sanction;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer", nullable=true)
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="recidive", type="integer", nullable=true)
     */
    private $recidive;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set raison
     *
     * @param string $raison
     *
     * @return BannissementRaisons
     */
    public function setRaison($raison) {
        $this->raison = $raison;

        return $this;
    }

    /**
     * Get raison
     *
     * @return string
     */
    public function getRaison() {
        return $this->raison;
    }

    /**
     * Set sanction
     *
     * @param integer $sanction
     *
     * @return BannissementRaisons
     */
    public function setSanction($sanction) {
        $this->sanction = $sanction;

        return $this;
    }

    /**
     * Get sanction
     *
     * @return integer
     */
    public function getSanction() {
        return $this->sanction;
    }

    /**
     * Set type
     *
     * @param integer $type
     *
     * @return BannissementRaisons
     */
    public function setType($type) {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Set recidive
     *
     * @param integer $recidive
     *
     * @return BannissementRaisons
     */
    public function setRecidive($recidive) {
        $this->recidive = $recidive;

        return $this;
    }

    /**
     * Get recidive
     *
     * @return integer
     */
    public function getRecidive() {
        return $this->recidive;
    }

}
