<?php

namespace Player\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MessengerList
 *
 * @ORM\Table(name="messenger_list")
 * @ORM\Entity
 */
class MessengerList
{
    /**
     * @var string
     *
     * @ORM\Column(name="account", type="string", length=14)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $account;

    /**
     * @var string
     *
     * @ORM\Column(name="companion", type="string", length=14)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $companion;



    /**
     * Set account
     *
     * @param string $account
     *
     * @return MessengerList
     */
    public function setAccount($account)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * Get account
     *
     * @return string
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * Set companion
     *
     * @param string $companion
     *
     * @return MessengerList
     */
    public function setCompanion($companion)
    {
        $this->companion = $companion;

        return $this;
    }

    /**
     * Get companion
     *
     * @return string
     */
    public function getCompanion()
    {
        return $this->companion;
    }
}
