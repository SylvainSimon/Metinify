<?php

namespace Common\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SpamDb
 *
 * @ORM\Table(name="common.spam_db")
 * @ORM\Entity
 */
class SpamDb {

    /**
     * @var string
     *
     * @ORM\Column(name="word", type="string", length=15, nullable=true)
     */
    private $word;

    /**
     * @var string
     *
     * @ORM\Column(name="score", type="string", length=15, nullable=true)
     */
    private $score;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=15, nullable=true)
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Set word
     *
     * @param string $word
     *
     * @return SpamDb
     */
    public function setWord($word) {
        $this->word = $word;

        return $this;
    }

    /**
     * Get word
     *
     * @return string
     */
    public function getWord() {
        return $this->word;
    }

    /**
     * Set score
     *
     * @param string $score
     *
     * @return SpamDb
     */
    public function setScore($score) {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return string
     */
    public function getScore() {
        return $this->score;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return SpamDb
     */
    public function setType($type) {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType() {
        return $this->type;
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
