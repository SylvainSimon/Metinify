<?php

namespace Player\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShopClass
 *
 * @ORM\Table(name="shop_class")
 * @ORM\Entity
 */
class ShopClass
{
    /**
     * @var string
     *
     * @ORM\Column(name="classname", type="string", length=255, nullable=true)
     */
    private $classname;

    /**
     * @var integer
     *
     * @ORM\Column(name="classid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $classid;



    /**
     * Set classname
     *
     * @param string $classname
     *
     * @return ShopClass
     */
    public function setClassname($classname)
    {
        $this->classname = $classname;

        return $this;
    }

    /**
     * Get classname
     *
     * @return string
     */
    public function getClassname()
    {
        return $this->classname;
    }

    /**
     * Get classid
     *
     * @return integer
     */
    public function getClassid()
    {
        return $this->classid;
    }
}
