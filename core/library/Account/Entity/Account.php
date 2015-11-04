<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Account
 *
 * @ORM\Table(name="account", uniqueConstraints={@ORM\UniqueConstraint(name="login", columns={"login"})}, indexes={@ORM\Index(name="social_id", columns={"social_id"})})
 * @ORM\Entity
 */
class Account
{
    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=30, nullable=false)
     */
    private $login = '';

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=45, nullable=false)
     */
    private $password = '';

    /**
     * @var string
     *
     * @ORM\Column(name="real_name", type="string", length=16, nullable=false)
     */
    private $realName = '';

    /**
     * @var string
     *
     * @ORM\Column(name="social_id", type="string", length=7, nullable=false)
     */
    private $socialId = '';

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=64, nullable=false)
     */
    private $email = '';

    /**
     * @var string
     *
     * @ORM\Column(name="phone1", type="string", length=16, nullable=true)
     */
    private $phone1;

    /**
     * @var string
     *
     * @ORM\Column(name="phone2", type="string", length=16, nullable=true)
     */
    private $phone2;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=128, nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="zipcode", type="string", length=7, nullable=false)
     */
    private $zipcode = '';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_time", type="datetime", nullable=false)
     */
    private $createTime = '0000-00-00 00:00:00';

    /**
     * @var string
     *
     * @ORM\Column(name="question1", type="string", length=48, nullable=true)
     */
    private $question1;

    /**
     * @var string
     *
     * @ORM\Column(name="answer1", type="string", length=48, nullable=true)
     */
    private $answer1;

    /**
     * @var string
     *
     * @ORM\Column(name="question2", type="string", length=48, nullable=true)
     */
    private $question2;

    /**
     * @var string
     *
     * @ORM\Column(name="answer2", type="string", length=48, nullable=true)
     */
    private $answer2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_testor", type="boolean", nullable=false)
     */
    private $isTestor = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=8, nullable=false)
     */
    private $status = 'OK';

    /**
     * @var string
     *
     * @ORM\Column(name="securitycode", type="string", length=192, nullable=true)
     */
    private $securitycode = '';

    /**
     * @var boolean
     *
     * @ORM\Column(name="newsletter", type="boolean", nullable=false)
     */
    private $newsletter = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="empire", type="boolean", nullable=false)
     */
    private $empire = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="name_checked", type="boolean", nullable=false)
     */
    private $nameChecked = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="availDt", type="datetime", nullable=false)
     */
    private $availdt = '0000-00-00 00:00:00';

    /**
     * @var integer
     *
     * @ORM\Column(name="mileage", type="integer", nullable=false)
     */
    private $mileage = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="cash", type="integer", nullable=false)
     */
    private $cash = '200000';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="gold_expire", type="datetime", nullable=false)
     */
    private $goldExpire = '0000-00-00 00:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="silver_expire", type="datetime", nullable=false)
     */
    private $silverExpire = '0000-00-00 00:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="safebox_expire", type="datetime", nullable=false)
     */
    private $safeboxExpire = '2016-01-01 00:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="autoloot_expire", type="datetime", nullable=false)
     */
    private $autolootExpire = '2016-01-01 00:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fish_mind_expire", type="datetime", nullable=false)
     */
    private $fishMindExpire = '0000-00-00 00:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="marriage_fast_expire", type="datetime", nullable=false)
     */
    private $marriageFastExpire = '0000-00-00 00:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="money_drop_rate_expire", type="datetime", nullable=false)
     */
    private $moneyDropRateExpire = '0000-00-00 00:00:00';

    /**
     * @var integer
     *
     * @ORM\Column(name="ttl_cash", type="integer", nullable=false)
     */
    private $ttlCash = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="ttl_mileage", type="integer", nullable=false)
     */
    private $ttlMileage = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="channel_company", type="string", length=30, nullable=false)
     */
    private $channelCompany = '';

    /**
     * @var string
     *
     * @ORM\Column(name="ip_creation", type="string", length=30, nullable=true)
     */
    private $ipCreation;

    /**
     * @var string
     *
     * @ORM\Column(name="last_play", type="string", length=30, nullable=true)
     */
    private $lastPlay;

    /**
     * @var string
     *
     * @ORM\Column(name="langue", type="string", length=3, nullable=true)
     */
    private $langue;

    /**
     * @var string
     *
     * @ORM\Column(name="pseudo_messagerie", type="string", length=30, nullable=true)
     */
    private $pseudoMessagerie;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=30, nullable=true)
     */
    private $ip;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set login
     *
     * @param string $login
     *
     * @return Account
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Account
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set realName
     *
     * @param string $realName
     *
     * @return Account
     */
    public function setRealName($realName)
    {
        $this->realName = $realName;

        return $this;
    }

    /**
     * Get realName
     *
     * @return string
     */
    public function getRealName()
    {
        return $this->realName;
    }

    /**
     * Set socialId
     *
     * @param string $socialId
     *
     * @return Account
     */
    public function setSocialId($socialId)
    {
        $this->socialId = $socialId;

        return $this;
    }

    /**
     * Get socialId
     *
     * @return string
     */
    public function getSocialId()
    {
        return $this->socialId;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Account
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phone1
     *
     * @param string $phone1
     *
     * @return Account
     */
    public function setPhone1($phone1)
    {
        $this->phone1 = $phone1;

        return $this;
    }

    /**
     * Get phone1
     *
     * @return string
     */
    public function getPhone1()
    {
        return $this->phone1;
    }

    /**
     * Set phone2
     *
     * @param string $phone2
     *
     * @return Account
     */
    public function setPhone2($phone2)
    {
        $this->phone2 = $phone2;

        return $this;
    }

    /**
     * Get phone2
     *
     * @return string
     */
    public function getPhone2()
    {
        return $this->phone2;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Account
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set zipcode
     *
     * @param string $zipcode
     *
     * @return Account
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * Get zipcode
     *
     * @return string
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set createTime
     *
     * @param \DateTime $createTime
     *
     * @return Account
     */
    public function setCreateTime($createTime)
    {
        $this->createTime = $createTime;

        return $this;
    }

    /**
     * Get createTime
     *
     * @return \DateTime
     */
    public function getCreateTime()
    {
        return $this->createTime;
    }

    /**
     * Set question1
     *
     * @param string $question1
     *
     * @return Account
     */
    public function setQuestion1($question1)
    {
        $this->question1 = $question1;

        return $this;
    }

    /**
     * Get question1
     *
     * @return string
     */
    public function getQuestion1()
    {
        return $this->question1;
    }

    /**
     * Set answer1
     *
     * @param string $answer1
     *
     * @return Account
     */
    public function setAnswer1($answer1)
    {
        $this->answer1 = $answer1;

        return $this;
    }

    /**
     * Get answer1
     *
     * @return string
     */
    public function getAnswer1()
    {
        return $this->answer1;
    }

    /**
     * Set question2
     *
     * @param string $question2
     *
     * @return Account
     */
    public function setQuestion2($question2)
    {
        $this->question2 = $question2;

        return $this;
    }

    /**
     * Get question2
     *
     * @return string
     */
    public function getQuestion2()
    {
        return $this->question2;
    }

    /**
     * Set answer2
     *
     * @param string $answer2
     *
     * @return Account
     */
    public function setAnswer2($answer2)
    {
        $this->answer2 = $answer2;

        return $this;
    }

    /**
     * Get answer2
     *
     * @return string
     */
    public function getAnswer2()
    {
        return $this->answer2;
    }

    /**
     * Set isTestor
     *
     * @param boolean $isTestor
     *
     * @return Account
     */
    public function setIsTestor($isTestor)
    {
        $this->isTestor = $isTestor;

        return $this;
    }

    /**
     * Get isTestor
     *
     * @return boolean
     */
    public function getIsTestor()
    {
        return $this->isTestor;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Account
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set securitycode
     *
     * @param string $securitycode
     *
     * @return Account
     */
    public function setSecuritycode($securitycode)
    {
        $this->securitycode = $securitycode;

        return $this;
    }

    /**
     * Get securitycode
     *
     * @return string
     */
    public function getSecuritycode()
    {
        return $this->securitycode;
    }

    /**
     * Set newsletter
     *
     * @param boolean $newsletter
     *
     * @return Account
     */
    public function setNewsletter($newsletter)
    {
        $this->newsletter = $newsletter;

        return $this;
    }

    /**
     * Get newsletter
     *
     * @return boolean
     */
    public function getNewsletter()
    {
        return $this->newsletter;
    }

    /**
     * Set empire
     *
     * @param boolean $empire
     *
     * @return Account
     */
    public function setEmpire($empire)
    {
        $this->empire = $empire;

        return $this;
    }

    /**
     * Get empire
     *
     * @return boolean
     */
    public function getEmpire()
    {
        return $this->empire;
    }

    /**
     * Set nameChecked
     *
     * @param boolean $nameChecked
     *
     * @return Account
     */
    public function setNameChecked($nameChecked)
    {
        $this->nameChecked = $nameChecked;

        return $this;
    }

    /**
     * Get nameChecked
     *
     * @return boolean
     */
    public function getNameChecked()
    {
        return $this->nameChecked;
    }

    /**
     * Set availdt
     *
     * @param \DateTime $availdt
     *
     * @return Account
     */
    public function setAvaildt($availdt)
    {
        $this->availdt = $availdt;

        return $this;
    }

    /**
     * Get availdt
     *
     * @return \DateTime
     */
    public function getAvaildt()
    {
        return $this->availdt;
    }

    /**
     * Set mileage
     *
     * @param integer $mileage
     *
     * @return Account
     */
    public function setMileage($mileage)
    {
        $this->mileage = $mileage;

        return $this;
    }

    /**
     * Get mileage
     *
     * @return integer
     */
    public function getMileage()
    {
        return $this->mileage;
    }

    /**
     * Set cash
     *
     * @param integer $cash
     *
     * @return Account
     */
    public function setCash($cash)
    {
        $this->cash = $cash;

        return $this;
    }

    /**
     * Get cash
     *
     * @return integer
     */
    public function getCash()
    {
        return $this->cash;
    }

    /**
     * Set goldExpire
     *
     * @param \DateTime $goldExpire
     *
     * @return Account
     */
    public function setGoldExpire($goldExpire)
    {
        $this->goldExpire = $goldExpire;

        return $this;
    }

    /**
     * Get goldExpire
     *
     * @return \DateTime
     */
    public function getGoldExpire()
    {
        return $this->goldExpire;
    }

    /**
     * Set silverExpire
     *
     * @param \DateTime $silverExpire
     *
     * @return Account
     */
    public function setSilverExpire($silverExpire)
    {
        $this->silverExpire = $silverExpire;

        return $this;
    }

    /**
     * Get silverExpire
     *
     * @return \DateTime
     */
    public function getSilverExpire()
    {
        return $this->silverExpire;
    }

    /**
     * Set safeboxExpire
     *
     * @param \DateTime $safeboxExpire
     *
     * @return Account
     */
    public function setSafeboxExpire($safeboxExpire)
    {
        $this->safeboxExpire = $safeboxExpire;

        return $this;
    }

    /**
     * Get safeboxExpire
     *
     * @return \DateTime
     */
    public function getSafeboxExpire()
    {
        return $this->safeboxExpire;
    }

    /**
     * Set autolootExpire
     *
     * @param \DateTime $autolootExpire
     *
     * @return Account
     */
    public function setAutolootExpire($autolootExpire)
    {
        $this->autolootExpire = $autolootExpire;

        return $this;
    }

    /**
     * Get autolootExpire
     *
     * @return \DateTime
     */
    public function getAutolootExpire()
    {
        return $this->autolootExpire;
    }

    /**
     * Set fishMindExpire
     *
     * @param \DateTime $fishMindExpire
     *
     * @return Account
     */
    public function setFishMindExpire($fishMindExpire)
    {
        $this->fishMindExpire = $fishMindExpire;

        return $this;
    }

    /**
     * Get fishMindExpire
     *
     * @return \DateTime
     */
    public function getFishMindExpire()
    {
        return $this->fishMindExpire;
    }

    /**
     * Set marriageFastExpire
     *
     * @param \DateTime $marriageFastExpire
     *
     * @return Account
     */
    public function setMarriageFastExpire($marriageFastExpire)
    {
        $this->marriageFastExpire = $marriageFastExpire;

        return $this;
    }

    /**
     * Get marriageFastExpire
     *
     * @return \DateTime
     */
    public function getMarriageFastExpire()
    {
        return $this->marriageFastExpire;
    }

    /**
     * Set moneyDropRateExpire
     *
     * @param \DateTime $moneyDropRateExpire
     *
     * @return Account
     */
    public function setMoneyDropRateExpire($moneyDropRateExpire)
    {
        $this->moneyDropRateExpire = $moneyDropRateExpire;

        return $this;
    }

    /**
     * Get moneyDropRateExpire
     *
     * @return \DateTime
     */
    public function getMoneyDropRateExpire()
    {
        return $this->moneyDropRateExpire;
    }

    /**
     * Set ttlCash
     *
     * @param integer $ttlCash
     *
     * @return Account
     */
    public function setTtlCash($ttlCash)
    {
        $this->ttlCash = $ttlCash;

        return $this;
    }

    /**
     * Get ttlCash
     *
     * @return integer
     */
    public function getTtlCash()
    {
        return $this->ttlCash;
    }

    /**
     * Set ttlMileage
     *
     * @param integer $ttlMileage
     *
     * @return Account
     */
    public function setTtlMileage($ttlMileage)
    {
        $this->ttlMileage = $ttlMileage;

        return $this;
    }

    /**
     * Get ttlMileage
     *
     * @return integer
     */
    public function getTtlMileage()
    {
        return $this->ttlMileage;
    }

    /**
     * Set channelCompany
     *
     * @param string $channelCompany
     *
     * @return Account
     */
    public function setChannelCompany($channelCompany)
    {
        $this->channelCompany = $channelCompany;

        return $this;
    }

    /**
     * Get channelCompany
     *
     * @return string
     */
    public function getChannelCompany()
    {
        return $this->channelCompany;
    }

    /**
     * Set ipCreation
     *
     * @param string $ipCreation
     *
     * @return Account
     */
    public function setIpCreation($ipCreation)
    {
        $this->ipCreation = $ipCreation;

        return $this;
    }

    /**
     * Get ipCreation
     *
     * @return string
     */
    public function getIpCreation()
    {
        return $this->ipCreation;
    }

    /**
     * Set lastPlay
     *
     * @param string $lastPlay
     *
     * @return Account
     */
    public function setLastPlay($lastPlay)
    {
        $this->lastPlay = $lastPlay;

        return $this;
    }

    /**
     * Get lastPlay
     *
     * @return string
     */
    public function getLastPlay()
    {
        return $this->lastPlay;
    }

    /**
     * Set langue
     *
     * @param string $langue
     *
     * @return Account
     */
    public function setLangue($langue)
    {
        $this->langue = $langue;

        return $this;
    }

    /**
     * Get langue
     *
     * @return string
     */
    public function getLangue()
    {
        return $this->langue;
    }

    /**
     * Set pseudoMessagerie
     *
     * @param string $pseudoMessagerie
     *
     * @return Account
     */
    public function setPseudoMessagerie($pseudoMessagerie)
    {
        $this->pseudoMessagerie = $pseudoMessagerie;

        return $this;
    }

    /**
     * Get pseudoMessagerie
     *
     * @return string
     */
    public function getPseudoMessagerie()
    {
        return $this->pseudoMessagerie;
    }

    /**
     * Set ip
     *
     * @param string $ip
     *
     * @return Account
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
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
