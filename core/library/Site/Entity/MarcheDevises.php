<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MarcheDevises
 *
 * @ORM\Table(name="site.marche_devises")
 * @ORM\Entity
 */
class MarcheDevises {

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
     * @ORM\Column(name="devise", type="string", length=255, nullable=true)
     */
    private $devise;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set devise
     *
     * @param string $devise
     *
     * @return MarcheDevises
     */
    public function setDevise($devise) {
        $this->devise = $devise;

        return $this;
    }

    /**
     * Get devise
     *
     * @return string
     */
    public function getDevise() {
        return $this->devise;
    }

}
