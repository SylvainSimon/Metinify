<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Banword
 *
 * @ORM\Table(name="banword")
 * @ORM\Entity
 */
class Banword
{
    /**
     * @var string
     *
     * @ORM\Column(name="word", type="string", length=24)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $word;



    /**
     * Get word
     *
     * @return string
     */
    public function getWord()
    {
        return $this->word;
    }
}
