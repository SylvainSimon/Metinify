<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ItemshopCategories
 *
 * @ORM\Table(name="site.itemshop_categories")
 * @ORM\Entity
 */
class ItemshopCategories
{
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
     * @ORM\Column(name="cat", type="integer", nullable=true)
     */
    private $cat;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=50, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;



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
     * Set cat
     *
     * @param integer $cat
     *
     * @return ItemshopCategories
     */
    public function setCat($cat)
    {
        $this->cat = $cat;

        return $this;
    }

    /**
     * Get cat
     *
     * @return integer
     */
    public function getCat()
    {
        return $this->cat;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return ItemshopCategories
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return ItemshopCategories
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
