<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EquipeDescription
 *
 * @ORM\Table(name="site.equipe_description")
 * @ORM\Entity
 */
class EquipeDescription {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_compte", type="integer", nullable=true)
     */
    private $idCompte;

    /**
     * @var string
     *
     * @ORM\Column(name="image_profil", type="string", length=255, nullable=true)
     */
    private $imageProfil;

    /**
     * @var string
     *
     * @ORM\Column(name="description_profil", type="string", length=1024, nullable=true)
     */
    private $descriptionProfil;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set idCompte
     *
     * @param integer $idCompte
     *
     * @return EquipeDescription
     */
    public function setIdCompte($idCompte) {
        $this->idCompte = $idCompte;

        return $this;
    }

    /**
     * Get idCompte
     *
     * @return integer
     */
    public function getIdCompte() {
        return $this->idCompte;
    }

    /**
     * Set imageProfil
     *
     * @param string $imageProfil
     *
     * @return EquipeDescription
     */
    public function setImageProfil($imageProfil) {
        $this->imageProfil = $imageProfil;

        return $this;
    }

    /**
     * Get imageProfil
     *
     * @return string
     */
    public function getImageProfil() {
        return $this->imageProfil;
    }

    /**
     * Set descriptionProfil
     *
     * @param string $descriptionProfil
     *
     * @return EquipeDescription
     */
    public function setDescriptionProfil($descriptionProfil) {
        $this->descriptionProfil = $descriptionProfil;

        return $this;
    }

    /**
     * Get descriptionProfil
     *
     * @return string
     */
    public function getDescriptionProfil() {
        return $this->descriptionProfil;
    }

}
