<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MonarchElection
 *
 * @ORM\Table(name="monarch_election")
 * @ORM\Entity
 */
class MonarchElection
{
    /**
     * @var integer
     *
     * @ORM\Column(name="selectedpid", type="integer", nullable=true)
     */
    private $selectedpid = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="electiondata", type="datetime", nullable=true)
     */
    private $electiondata = '0000-00-00 00:00:00';

    /**
     * @var integer
     *
     * @ORM\Column(name="pid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $pid;



    /**
     * Set selectedpid
     *
     * @param integer $selectedpid
     *
     * @return MonarchElection
     */
    public function setSelectedpid($selectedpid)
    {
        $this->selectedpid = $selectedpid;

        return $this;
    }

    /**
     * Get selectedpid
     *
     * @return integer
     */
    public function getSelectedpid()
    {
        return $this->selectedpid;
    }

    /**
     * Set electiondata
     *
     * @param \DateTime $electiondata
     *
     * @return MonarchElection
     */
    public function setElectiondata($electiondata)
    {
        $this->electiondata = $electiondata;

        return $this;
    }

    /**
     * Get electiondata
     *
     * @return \DateTime
     */
    public function getElectiondata()
    {
        return $this->electiondata;
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
