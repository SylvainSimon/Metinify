<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ItemList
 *
 * @ORM\Table(name="site.item_list")
 * @ORM\Entity
 */
class ItemList
{
    /**
     * @var string
     *
     * @ORM\Column(name="chemin", type="string", length=255, nullable=true)
     */
    private $chemin;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="item", type="string", length=255)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $item;



    /**
     * Set chemin
     *
     * @param string $chemin
     *
     * @return ItemList
     */
    public function setChemin($chemin)
    {
        $this->chemin = $chemin;

        return $this;
    }

    /**
     * Get chemin
     *
     * @return string
     */
    public function getChemin()
    {
        return $this->chemin;
    }

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return ItemList
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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

    /**
     * Set item
     *
     * @param string $item
     *
     * @return ItemList
     */
    public function setItem($item)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * Get item
     *
     * @return string
     */
    public function getItem()
    {
        return $this->item;
    }
}
