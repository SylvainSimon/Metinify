<?php

namespace Common\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gmhost
 *
 * @ORM\Table(name="common.gmhost")
 * @ORM\Entity
 */
class Gmhost {

    /**
     * @var string
     *
     * @ORM\Column(name="mIP", type="string", length=16)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $mip;

    /**
     * Get mip
     *
     * @return string
     */
    public function getMip() {
        return $this->mip;
    }

}
