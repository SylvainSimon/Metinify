<?php

namespace Common\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LocaleBug
 *
 * @ORM\Table(name="common.locale_bug")
 * @ORM\Entity
 */
class LocaleBug {

    /**
     * @var string
     *
     * @ORM\Column(name="mValue", type="string", length=255, nullable=false)
     */
    private $mvalue = '';

    /**
     * @var string
     *
     * @ORM\Column(name="mKey", type="string", length=255)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $mkey;

    /**
     * Set mvalue
     *
     * @param string $mvalue
     *
     * @return LocaleBug
     */
    public function setMvalue($mvalue) {
        $this->mvalue = $mvalue;

        return $this;
    }

    /**
     * Get mvalue
     *
     * @return string
     */
    public function getMvalue() {
        return $this->mvalue;
    }

    /**
     * Get mkey
     *
     * @return string
     */
    public function getMkey() {
        return $this->mkey;
    }

}
