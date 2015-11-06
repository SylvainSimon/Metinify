<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StatistiquesTampon
 *
 * @ORM\Table(name="site.statistiques_tampon")
 * @ORM\Entity
 */
class StatistiquesTampon {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="type_stati", type="integer", nullable=true)
     */
    private $typeStati;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_insertion", type="datetime", nullable=true)
     */
    private $dateInsertion;

    /**
     * @var integer
     *
     * @ORM\Column(name="comptes", type="integer", nullable=true)
     */
    private $comptes;

    /**
     * @var integer
     *
     * @ORM\Column(name="joueurs", type="integer", nullable=true)
     */
    private $joueurs;

    /**
     * @var integer
     *
     * @ORM\Column(name="hommes", type="integer", nullable=true)
     */
    private $hommes;

    /**
     * @var integer
     *
     * @ORM\Column(name="femmes", type="integer", nullable=true)
     */
    private $femmes;

    /**
     * @var integer
     *
     * @ORM\Column(name="shinsoo", type="integer", nullable=true)
     */
    private $shinsoo;

    /**
     * @var integer
     *
     * @ORM\Column(name="chunjo", type="integer", nullable=true)
     */
    private $chunjo;

    /**
     * @var integer
     *
     * @ORM\Column(name="jinno", type="integer", nullable=true)
     */
    private $jinno;

    /**
     * @var integer
     *
     * @ORM\Column(name="guerriers", type="integer", nullable=true)
     */
    private $guerriers;

    /**
     * @var integer
     *
     * @ORM\Column(name="suras", type="integer", nullable=true)
     */
    private $suras;

    /**
     * @var integer
     *
     * @ORM\Column(name="ninjas", type="integer", nullable=true)
     */
    private $ninjas;

    /**
     * @var integer
     *
     * @ORM\Column(name="shamans", type="integer", nullable=true)
     */
    private $shamans;

    /**
     * @var integer
     *
     * @ORM\Column(name="connexion_site", type="integer", nullable=true)
     */
    private $connexionSite;

    /**
     * @var integer
     *
     * @ORM\Column(name="connexion_site_unique", type="integer", nullable=true)
     */
    private $connexionSiteUnique;

    /**
     * @var integer
     *
     * @ORM\Column(name="changement_mail", type="integer", nullable=true)
     */
    private $changementMail;

    /**
     * @var integer
     *
     * @ORM\Column(name="recup_mdp", type="integer", nullable=true)
     */
    private $recupMdp;

    /**
     * @var integer
     *
     * @ORM\Column(name="changement_mdp", type="integer", nullable=true)
     */
    private $changementMdp;

    /**
     * @var integer
     *
     * @ORM\Column(name="changement_entrepot", type="integer", nullable=true)
     */
    private $changementEntrepot;

    /**
     * @var integer
     *
     * @ORM\Column(name="deblocage_yangs", type="integer", nullable=true)
     */
    private $deblocageYangs;

    /**
     * @var integer
     *
     * @ORM\Column(name="tickets_ouvert", type="integer", nullable=true)
     */
    private $ticketsOuvert;

    /**
     * @var integer
     *
     * @ORM\Column(name="message_ecrits", type="integer", nullable=true)
     */
    private $messageEcrits;

    /**
     * @var integer
     *
     * @ORM\Column(name="discussion_archives", type="integer", nullable=true)
     */
    private $discussionArchives;

    /**
     * @var integer
     *
     * @ORM\Column(name="pays_fr", type="integer", nullable=true)
     */
    private $paysFr;

    /**
     * @var integer
     *
     * @ORM\Column(name="pays_ch", type="integer", nullable=true)
     */
    private $paysCh;

    /**
     * @var integer
     *
     * @ORM\Column(name="pays_gb", type="integer", nullable=true)
     */
    private $paysGb;

    /**
     * @var integer
     *
     * @ORM\Column(name="pays_de", type="integer", nullable=true)
     */
    private $paysDe;

    /**
     * @var integer
     *
     * @ORM\Column(name="pays_ro", type="integer", nullable=true)
     */
    private $paysRo;

    /**
     * @var integer
     *
     * @ORM\Column(name="pays_us", type="integer", nullable=true)
     */
    private $paysUs;

    /**
     * @var integer
     *
     * @ORM\Column(name="pays_it", type="integer", nullable=true)
     */
    private $paysIt;

    /**
     * @var integer
     *
     * @ORM\Column(name="pays_es", type="integer", nullable=true)
     */
    private $paysEs;

    /**
     * @var integer
     *
     * @ORM\Column(name="pays_pl", type="integer", nullable=true)
     */
    private $paysPl;

    /**
     * @var integer
     *
     * @ORM\Column(name="pays_pt", type="integer", nullable=true)
     */
    private $paysPt;

    /**
     * @var integer
     *
     * @ORM\Column(name="pays_tn", type="integer", nullable=true)
     */
    private $paysTn;

    /**
     * @var integer
     *
     * @ORM\Column(name="pays_dz", type="integer", nullable=true)
     */
    private $paysDz;

    /**
     * @var integer
     *
     * @ORM\Column(name="pays_jp", type="integer", nullable=true)
     */
    private $paysJp;

    /**
     * @var integer
     *
     * @ORM\Column(name="pays_be", type="integer", nullable=true)
     */
    private $paysBe;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set typeStati
     *
     * @param integer $typeStati
     *
     * @return StatistiquesTampon
     */
    public function setTypeStati($typeStati) {
        $this->typeStati = $typeStati;

        return $this;
    }

    /**
     * Get typeStati
     *
     * @return integer
     */
    public function getTypeStati() {
        return $this->typeStati;
    }

    /**
     * Set dateInsertion
     *
     * @param \DateTime $dateInsertion
     *
     * @return StatistiquesTampon
     */
    public function setDateInsertion($dateInsertion) {
        $this->dateInsertion = $dateInsertion;

        return $this;
    }

    /**
     * Get dateInsertion
     *
     * @return \DateTime
     */
    public function getDateInsertion() {
        return $this->dateInsertion;
    }

    /**
     * Set comptes
     *
     * @param integer $comptes
     *
     * @return StatistiquesTampon
     */
    public function setComptes($comptes) {
        $this->comptes = $comptes;

        return $this;
    }

    /**
     * Get comptes
     *
     * @return integer
     */
    public function getComptes() {
        return $this->comptes;
    }

    /**
     * Set joueurs
     *
     * @param integer $joueurs
     *
     * @return StatistiquesTampon
     */
    public function setJoueurs($joueurs) {
        $this->joueurs = $joueurs;

        return $this;
    }

    /**
     * Get joueurs
     *
     * @return integer
     */
    public function getJoueurs() {
        return $this->joueurs;
    }

    /**
     * Set hommes
     *
     * @param integer $hommes
     *
     * @return StatistiquesTampon
     */
    public function setHommes($hommes) {
        $this->hommes = $hommes;

        return $this;
    }

    /**
     * Get hommes
     *
     * @return integer
     */
    public function getHommes() {
        return $this->hommes;
    }

    /**
     * Set femmes
     *
     * @param integer $femmes
     *
     * @return StatistiquesTampon
     */
    public function setFemmes($femmes) {
        $this->femmes = $femmes;

        return $this;
    }

    /**
     * Get femmes
     *
     * @return integer
     */
    public function getFemmes() {
        return $this->femmes;
    }

    /**
     * Set shinsoo
     *
     * @param integer $shinsoo
     *
     * @return StatistiquesTampon
     */
    public function setShinsoo($shinsoo) {
        $this->shinsoo = $shinsoo;

        return $this;
    }

    /**
     * Get shinsoo
     *
     * @return integer
     */
    public function getShinsoo() {
        return $this->shinsoo;
    }

    /**
     * Set chunjo
     *
     * @param integer $chunjo
     *
     * @return StatistiquesTampon
     */
    public function setChunjo($chunjo) {
        $this->chunjo = $chunjo;

        return $this;
    }

    /**
     * Get chunjo
     *
     * @return integer
     */
    public function getChunjo() {
        return $this->chunjo;
    }

    /**
     * Set jinno
     *
     * @param integer $jinno
     *
     * @return StatistiquesTampon
     */
    public function setJinno($jinno) {
        $this->jinno = $jinno;

        return $this;
    }

    /**
     * Get jinno
     *
     * @return integer
     */
    public function getJinno() {
        return $this->jinno;
    }

    /**
     * Set guerriers
     *
     * @param integer $guerriers
     *
     * @return StatistiquesTampon
     */
    public function setGuerriers($guerriers) {
        $this->guerriers = $guerriers;

        return $this;
    }

    /**
     * Get guerriers
     *
     * @return integer
     */
    public function getGuerriers() {
        return $this->guerriers;
    }

    /**
     * Set suras
     *
     * @param integer $suras
     *
     * @return StatistiquesTampon
     */
    public function setSuras($suras) {
        $this->suras = $suras;

        return $this;
    }

    /**
     * Get suras
     *
     * @return integer
     */
    public function getSuras() {
        return $this->suras;
    }

    /**
     * Set ninjas
     *
     * @param integer $ninjas
     *
     * @return StatistiquesTampon
     */
    public function setNinjas($ninjas) {
        $this->ninjas = $ninjas;

        return $this;
    }

    /**
     * Get ninjas
     *
     * @return integer
     */
    public function getNinjas() {
        return $this->ninjas;
    }

    /**
     * Set shamans
     *
     * @param integer $shamans
     *
     * @return StatistiquesTampon
     */
    public function setShamans($shamans) {
        $this->shamans = $shamans;

        return $this;
    }

    /**
     * Get shamans
     *
     * @return integer
     */
    public function getShamans() {
        return $this->shamans;
    }

    /**
     * Set connexionSite
     *
     * @param integer $connexionSite
     *
     * @return StatistiquesTampon
     */
    public function setConnexionSite($connexionSite) {
        $this->connexionSite = $connexionSite;

        return $this;
    }

    /**
     * Get connexionSite
     *
     * @return integer
     */
    public function getConnexionSite() {
        return $this->connexionSite;
    }

    /**
     * Set connexionSiteUnique
     *
     * @param integer $connexionSiteUnique
     *
     * @return StatistiquesTampon
     */
    public function setConnexionSiteUnique($connexionSiteUnique) {
        $this->connexionSiteUnique = $connexionSiteUnique;

        return $this;
    }

    /**
     * Get connexionSiteUnique
     *
     * @return integer
     */
    public function getConnexionSiteUnique() {
        return $this->connexionSiteUnique;
    }

    /**
     * Set changementMail
     *
     * @param integer $changementMail
     *
     * @return StatistiquesTampon
     */
    public function setChangementMail($changementMail) {
        $this->changementMail = $changementMail;

        return $this;
    }

    /**
     * Get changementMail
     *
     * @return integer
     */
    public function getChangementMail() {
        return $this->changementMail;
    }

    /**
     * Set recupMdp
     *
     * @param integer $recupMdp
     *
     * @return StatistiquesTampon
     */
    public function setRecupMdp($recupMdp) {
        $this->recupMdp = $recupMdp;

        return $this;
    }

    /**
     * Get recupMdp
     *
     * @return integer
     */
    public function getRecupMdp() {
        return $this->recupMdp;
    }

    /**
     * Set changementMdp
     *
     * @param integer $changementMdp
     *
     * @return StatistiquesTampon
     */
    public function setChangementMdp($changementMdp) {
        $this->changementMdp = $changementMdp;

        return $this;
    }

    /**
     * Get changementMdp
     *
     * @return integer
     */
    public function getChangementMdp() {
        return $this->changementMdp;
    }

    /**
     * Set changementEntrepot
     *
     * @param integer $changementEntrepot
     *
     * @return StatistiquesTampon
     */
    public function setChangementEntrepot($changementEntrepot) {
        $this->changementEntrepot = $changementEntrepot;

        return $this;
    }

    /**
     * Get changementEntrepot
     *
     * @return integer
     */
    public function getChangementEntrepot() {
        return $this->changementEntrepot;
    }

    /**
     * Set deblocageYangs
     *
     * @param integer $deblocageYangs
     *
     * @return StatistiquesTampon
     */
    public function setDeblocageYangs($deblocageYangs) {
        $this->deblocageYangs = $deblocageYangs;

        return $this;
    }

    /**
     * Get deblocageYangs
     *
     * @return integer
     */
    public function getDeblocageYangs() {
        return $this->deblocageYangs;
    }

    /**
     * Set ticketsOuvert
     *
     * @param integer $ticketsOuvert
     *
     * @return StatistiquesTampon
     */
    public function setTicketsOuvert($ticketsOuvert) {
        $this->ticketsOuvert = $ticketsOuvert;

        return $this;
    }

    /**
     * Get ticketsOuvert
     *
     * @return integer
     */
    public function getTicketsOuvert() {
        return $this->ticketsOuvert;
    }

    /**
     * Set messageEcrits
     *
     * @param integer $messageEcrits
     *
     * @return StatistiquesTampon
     */
    public function setMessageEcrits($messageEcrits) {
        $this->messageEcrits = $messageEcrits;

        return $this;
    }

    /**
     * Get messageEcrits
     *
     * @return integer
     */
    public function getMessageEcrits() {
        return $this->messageEcrits;
    }

    /**
     * Set discussionArchives
     *
     * @param integer $discussionArchives
     *
     * @return StatistiquesTampon
     */
    public function setDiscussionArchives($discussionArchives) {
        $this->discussionArchives = $discussionArchives;

        return $this;
    }

    /**
     * Get discussionArchives
     *
     * @return integer
     */
    public function getDiscussionArchives() {
        return $this->discussionArchives;
    }

    /**
     * Set paysFr
     *
     * @param integer $paysFr
     *
     * @return StatistiquesTampon
     */
    public function setPaysFr($paysFr) {
        $this->paysFr = $paysFr;

        return $this;
    }

    /**
     * Get paysFr
     *
     * @return integer
     */
    public function getPaysFr() {
        return $this->paysFr;
    }

    /**
     * Set paysCh
     *
     * @param integer $paysCh
     *
     * @return StatistiquesTampon
     */
    public function setPaysCh($paysCh) {
        $this->paysCh = $paysCh;

        return $this;
    }

    /**
     * Get paysCh
     *
     * @return integer
     */
    public function getPaysCh() {
        return $this->paysCh;
    }

    /**
     * Set paysGb
     *
     * @param integer $paysGb
     *
     * @return StatistiquesTampon
     */
    public function setPaysGb($paysGb) {
        $this->paysGb = $paysGb;

        return $this;
    }

    /**
     * Get paysGb
     *
     * @return integer
     */
    public function getPaysGb() {
        return $this->paysGb;
    }

    /**
     * Set paysDe
     *
     * @param integer $paysDe
     *
     * @return StatistiquesTampon
     */
    public function setPaysDe($paysDe) {
        $this->paysDe = $paysDe;

        return $this;
    }

    /**
     * Get paysDe
     *
     * @return integer
     */
    public function getPaysDe() {
        return $this->paysDe;
    }

    /**
     * Set paysRo
     *
     * @param integer $paysRo
     *
     * @return StatistiquesTampon
     */
    public function setPaysRo($paysRo) {
        $this->paysRo = $paysRo;

        return $this;
    }

    /**
     * Get paysRo
     *
     * @return integer
     */
    public function getPaysRo() {
        return $this->paysRo;
    }

    /**
     * Set paysUs
     *
     * @param integer $paysUs
     *
     * @return StatistiquesTampon
     */
    public function setPaysUs($paysUs) {
        $this->paysUs = $paysUs;

        return $this;
    }

    /**
     * Get paysUs
     *
     * @return integer
     */
    public function getPaysUs() {
        return $this->paysUs;
    }

    /**
     * Set paysIt
     *
     * @param integer $paysIt
     *
     * @return StatistiquesTampon
     */
    public function setPaysIt($paysIt) {
        $this->paysIt = $paysIt;

        return $this;
    }

    /**
     * Get paysIt
     *
     * @return integer
     */
    public function getPaysIt() {
        return $this->paysIt;
    }

    /**
     * Set paysEs
     *
     * @param integer $paysEs
     *
     * @return StatistiquesTampon
     */
    public function setPaysEs($paysEs) {
        $this->paysEs = $paysEs;

        return $this;
    }

    /**
     * Get paysEs
     *
     * @return integer
     */
    public function getPaysEs() {
        return $this->paysEs;
    }

    /**
     * Set paysPl
     *
     * @param integer $paysPl
     *
     * @return StatistiquesTampon
     */
    public function setPaysPl($paysPl) {
        $this->paysPl = $paysPl;

        return $this;
    }

    /**
     * Get paysPl
     *
     * @return integer
     */
    public function getPaysPl() {
        return $this->paysPl;
    }

    /**
     * Set paysPt
     *
     * @param integer $paysPt
     *
     * @return StatistiquesTampon
     */
    public function setPaysPt($paysPt) {
        $this->paysPt = $paysPt;

        return $this;
    }

    /**
     * Get paysPt
     *
     * @return integer
     */
    public function getPaysPt() {
        return $this->paysPt;
    }

    /**
     * Set paysTn
     *
     * @param integer $paysTn
     *
     * @return StatistiquesTampon
     */
    public function setPaysTn($paysTn) {
        $this->paysTn = $paysTn;

        return $this;
    }

    /**
     * Get paysTn
     *
     * @return integer
     */
    public function getPaysTn() {
        return $this->paysTn;
    }

    /**
     * Set paysDz
     *
     * @param integer $paysDz
     *
     * @return StatistiquesTampon
     */
    public function setPaysDz($paysDz) {
        $this->paysDz = $paysDz;

        return $this;
    }

    /**
     * Get paysDz
     *
     * @return integer
     */
    public function getPaysDz() {
        return $this->paysDz;
    }

    /**
     * Set paysJp
     *
     * @param integer $paysJp
     *
     * @return StatistiquesTampon
     */
    public function setPaysJp($paysJp) {
        $this->paysJp = $paysJp;

        return $this;
    }

    /**
     * Get paysJp
     *
     * @return integer
     */
    public function getPaysJp() {
        return $this->paysJp;
    }

    /**
     * Set paysBe
     *
     * @param integer $paysBe
     *
     * @return StatistiquesTampon
     */
    public function setPaysBe($paysBe) {
        $this->paysBe = $paysBe;

        return $this;
    }

    /**
     * Get paysBe
     *
     * @return integer
     */
    public function getPaysBe() {
        return $this->paysBe;
    }

}
