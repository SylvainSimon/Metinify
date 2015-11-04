<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MonarchCandidacy
 *
 * @ORM\Table(name="monarch_candidacy")
 * @ORM\Entity
 */
class MonarchCandidacy
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date = '0000-00-00 00:00:00';

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=16, nullable=true)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="windate", type="datetime", nullable=true)
     */
    private $windate;

    /**
     * @var integer
     *
     * @ORM\Column(name="pid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $pid;



    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return MonarchCandidacy
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return MonarchCandidacy
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set windate
     *
     * @param \DateTime $windate
     *
     * @return MonarchCandidacy
     */
    public function setWindate($windate)
    {
        $this->windate = $windate;

        return $this;
    }

    /**
     * Get windate
     *
     * @return \DateTime
     */
    public function getWindate()
    {
        return $this->windate;
    }

    /**
     * Get pid
     *
     * @return integer
     */
    public function getPid()
    {
        return $this->pid;
    }
}
