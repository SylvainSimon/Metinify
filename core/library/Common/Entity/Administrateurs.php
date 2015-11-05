<?php

namespace Common\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Administrateurs
 *
 * @ORM\Table(name="common.administrateurs")
 * @ORM\Entity
 */
class Administrateurs {

    /**
     * @var string
     *
     * @ORM\Column(name="pseudo", type="string", length=255, nullable=true)
     */
    private $pseudo;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Set pseudo
     *
     * @param string $pseudo
     *
     * @return Administrateurs
     */
    public function setPseudo($pseudo) {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get pseudo
     *
     * @return string
     */
    public function getPseudo() {
        return $this->pseudo;
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
