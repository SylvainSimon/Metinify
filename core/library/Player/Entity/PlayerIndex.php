<?php

namespace Player\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlayerIndex
 *
 * @ORM\Table(name="player.player_index", indexes={@ORM\Index(name="pid1_key", columns={"pid1"}), @ORM\Index(name="pid2_key", columns={"pid2"}), @ORM\Index(name="pid3_key", columns={"pid3"}), @ORM\Index(name="pid4_key", columns={"pid4"})})
 * @ORM\Entity
 */
class PlayerIndex
{
    /**
     * @var integer
     *
     * @ORM\Column(name="pid1", type="integer", nullable=false)
     */
    private $pid1 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="pid2", type="integer", nullable=false)
     */
    private $pid2 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="pid3", type="integer", nullable=false)
     */
    private $pid3 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="pid4", type="integer", nullable=false)
     */
    private $pid4 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="empire", type="integer", nullable=false)
     */
    private $empire = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set pid1
     *
     * @param integer $pid1
     *
     * @return PlayerIndex
     */
    public function setPid1($pid1)
    {
        $this->pid1 = $pid1;

        return $this;
    }

    /**
     * Get pid1
     *
     * @return integer
     */
    public function getPid1()
    {
        return $this->pid1;
    }

    /**
     * Set pid2
     *
     * @param integer $pid2
     *
     * @return PlayerIndex
     */
    public function setPid2($pid2)
    {
        $this->pid2 = $pid2;

        return $this;
    }

    /**
     * Get pid2
     *
     * @return integer
     */
    public function getPid2()
    {
        return $this->pid2;
    }

    /**
     * Set pid3
     *
     * @param integer $pid3
     *
     * @return PlayerIndex
     */
    public function setPid3($pid3)
    {
        $this->pid3 = $pid3;

        return $this;
    }

    /**
     * Get pid3
     *
     * @return integer
     */
    public function getPid3()
    {
        return $this->pid3;
    }

    /**
     * Set pid4
     *
     * @param integer $pid4
     *
     * @return PlayerIndex
     */
    public function setPid4($pid4)
    {
        $this->pid4 = $pid4;

        return $this;
    }

    /**
     * Get pid4
     *
     * @return integer
     */
    public function getPid4()
    {
        return $this->pid4;
    }

    /**
     * Set empire
     *
     * @param integer $empire
     *
     * @return PlayerIndex
     */
    public function setEmpire($empire)
    {
        $this->empire = $empire;

        return $this;
    }

    /**
     * Get empire
     *
     * @return integer
     */
    public function getEmpire()
    {
        return $this->empire;
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
}
