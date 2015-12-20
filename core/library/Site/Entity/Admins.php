<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Admins
 *
 * @ORM\Table(name="site.admins")
 * @ORM\Entity(repositoryClass="Site\Repository\AdminsRepository")
 */
class Admins {

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
     * @ORM\Column(name="droits", type="string", nullable=true)
     */
    private $droits;

    /**
     * @var boolean
     *
     * @ORM\Column(name="est_actif", type="boolean", nullable=true)
     */
    private $estActif;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", nullable=true)
     */
    private $name;

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
     * @return Admins
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
     * Set droits
     *
     * @param string $droits
     *
     * @return Admins
     */
    public function setDroits($droits) {

        $this->droits = serialize(json_encode($droits));

        return $this;
    }

    /**
     * Get droits
     *
     * @return string
     */
    public function getDroits() {
        return json_decode(unserialize($this->droits));
    }

    /**
     * Set estActif
     *
     * @param boolean $estActif
     *
     * @return Admins
     */
    public function setEstActif($estActif) {
        $this->estActif = $estActif;

        return $this;
    }

    /**
     * Get estActif
     *
     * @return boolean
     */
    public function getEstActif() {
        return $this->estActif;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Admins
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

}
