<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AdministrationUsers
 *
 * @ORM\Table(name="site.administration_users")
 * @ORM\Entity
 */
class AdministrationUsers {

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
     * @ORM\Column(name="id_compte", type="integer", nullable=true)
     */
    private $idCompte;

    /**
     * @var boolean
     *
     * @ORM\Column(name="pannel_admin", type="boolean", nullable=true)
     */
    private $pannelAdmin;

    /**
     * @var boolean
     *
     * @ORM\Column(name="support_ticket", type="boolean", nullable=true)
     */
    private $supportTicket;

    /**
     * @var boolean
     *
     * @ORM\Column(name="recherche_joueurs", type="boolean", nullable=true)
     */
    private $rechercheJoueurs;

    /**
     * @var boolean
     *
     * @ORM\Column(name="recherche_joueurs_admin", type="boolean", nullable=true)
     */
    private $rechercheJoueursAdmin;

    /**
     * @var boolean
     *
     * @ORM\Column(name="recherche_comptes", type="boolean", nullable=true)
     */
    private $rechercheComptes;

    /**
     * @var boolean
     *
     * @ORM\Column(name="recherche_guildes", type="boolean", nullable=true)
     */
    private $rechercheGuildes;

    /**
     * @var boolean
     *
     * @ORM\Column(name="recherche_emails", type="boolean", nullable=true)
     */
    private $rechercheEmails;

    /**
     * @var boolean
     *
     * @ORM\Column(name="recherche_ip", type="boolean", nullable=true)
     */
    private $rechercheIp;

    /**
     * @var boolean
     *
     * @ORM\Column(name="recherche_pecheurs", type="boolean", nullable=true)
     */
    private $recherchePecheurs;

    /**
     * @var boolean
     *
     * @ORM\Column(name="recherche_maries", type="boolean", nullable=true)
     */
    private $rechercheMaries;

    /**
     * @var boolean
     *
     * @ORM\Column(name="recherche_items", type="boolean", nullable=true)
     */
    private $rechercheItems;

    /**
     * @var boolean
     *
     * @ORM\Column(name="recherche_bannissements", type="boolean", nullable=true)
     */
    private $rechercheBannissements;

    /**
     * @var boolean
     *
     * @ORM\Column(name="recherche_renames", type="boolean", nullable=true)
     */
    private $rechercheRenames;

    /**
     * @var boolean
     *
     * @ORM\Column(name="bannissement", type="boolean", nullable=true)
     */
    private $bannissement;

    /**
     * @var boolean
     *
     * @ORM\Column(name="bannissement_ip", type="boolean", nullable=true)
     */
    private $bannissementIp;

    /**
     * @var boolean
     *
     * @ORM\Column(name="debannissement", type="boolean", nullable=true)
     */
    private $debannissement;

    /**
     * @var boolean
     *
     * @ORM\Column(name="debannissement_ip", type="boolean", nullable=true)
     */
    private $debannissementIp;

    /**
     * @var boolean
     *
     * @ORM\Column(name="voir_personnage", type="boolean", nullable=true)
     */
    private $voirPersonnage;

    /**
     * @var boolean
     *
     * @ORM\Column(name="voir_compte", type="boolean", nullable=true)
     */
    private $voirCompte;

    /**
     * @var boolean
     *
     * @ORM\Column(name="description_membre", type="boolean", nullable=true)
     */
    private $descriptionMembre;

    /**
     * @var boolean
     *
     * @ORM\Column(name="gerer_monnaies", type="boolean", nullable=true)
     */
    private $gererMonnaies;

    /**
     * @var boolean
     *
     * @ORM\Column(name="gerer_news", type="boolean", nullable=true)
     */
    private $gererNews;

    /**
     * @var boolean
     *
     * @ORM\Column(name="equipe", type="boolean", nullable=true)
     */
    private $equipe;

    /**
     * @var boolean
     *
     * @ORM\Column(name="commandes", type="boolean", nullable=true)
     */
    private $commandes;

    /**
     * @var boolean
     *
     * @ORM\Column(name="mp", type="boolean", nullable=true)
     */
    private $mp;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set idCompte
     *
     * @param integer $idCompte
     *
     * @return AdministrationUsers
     */
    public function setIdCompte($idCompte) {
        $this->idCompte = $idCompte;

        return $this;
    }

    /**
     * Get idCompte
     *
     * @return integer
     */
    public function getIdCompte() {
        return $this->idCompte;
    }

    /**
     * Set pannelAdmin
     *
     * @param boolean $pannelAdmin
     *
     * @return AdministrationUsers
     */
    public function setPannelAdmin($pannelAdmin) {
        $this->pannelAdmin = $pannelAdmin;

        return $this;
    }

    /**
     * Get pannelAdmin
     *
     * @return boolean
     */
    public function getPannelAdmin() {
        return $this->pannelAdmin;
    }

    /**
     * Set supportTicket
     *
     * @param boolean $supportTicket
     *
     * @return AdministrationUsers
     */
    public function setSupportTicket($supportTicket) {
        $this->supportTicket = $supportTicket;

        return $this;
    }

    /**
     * Get supportTicket
     *
     * @return boolean
     */
    public function getSupportTicket() {
        return $this->supportTicket;
    }

    /**
     * Set rechercheJoueurs
     *
     * @param boolean $rechercheJoueurs
     *
     * @return AdministrationUsers
     */
    public function setRechercheJoueurs($rechercheJoueurs) {
        $this->rechercheJoueurs = $rechercheJoueurs;

        return $this;
    }

    /**
     * Get rechercheJoueurs
     *
     * @return boolean
     */
    public function getRechercheJoueurs() {
        return $this->rechercheJoueurs;
    }

    /**
     * Set rechercheJoueursAdmin
     *
     * @param boolean $rechercheJoueursAdmin
     *
     * @return AdministrationUsers
     */
    public function setRechercheJoueursAdmin($rechercheJoueursAdmin) {
        $this->rechercheJoueursAdmin = $rechercheJoueursAdmin;

        return $this;
    }

    /**
     * Get rechercheJoueursAdmin
     *
     * @return boolean
     */
    public function getRechercheJoueursAdmin() {
        return $this->rechercheJoueursAdmin;
    }

    /**
     * Set rechercheComptes
     *
     * @param boolean $rechercheComptes
     *
     * @return AdministrationUsers
     */
    public function setRechercheComptes($rechercheComptes) {
        $this->rechercheComptes = $rechercheComptes;

        return $this;
    }

    /**
     * Get rechercheComptes
     *
     * @return boolean
     */
    public function getRechercheComptes() {
        return $this->rechercheComptes;
    }

    /**
     * Set rechercheGuildes
     *
     * @param boolean $rechercheGuildes
     *
     * @return AdministrationUsers
     */
    public function setRechercheGuildes($rechercheGuildes) {
        $this->rechercheGuildes = $rechercheGuildes;

        return $this;
    }

    /**
     * Get rechercheGuildes
     *
     * @return boolean
     */
    public function getRechercheGuildes() {
        return $this->rechercheGuildes;
    }

    /**
     * Set rechercheEmails
     *
     * @param boolean $rechercheEmails
     *
     * @return AdministrationUsers
     */
    public function setRechercheEmails($rechercheEmails) {
        $this->rechercheEmails = $rechercheEmails;

        return $this;
    }

    /**
     * Get rechercheEmails
     *
     * @return boolean
     */
    public function getRechercheEmails() {
        return $this->rechercheEmails;
    }

    /**
     * Set rechercheIp
     *
     * @param boolean $rechercheIp
     *
     * @return AdministrationUsers
     */
    public function setRechercheIp($rechercheIp) {
        $this->rechercheIp = $rechercheIp;

        return $this;
    }

    /**
     * Get rechercheIp
     *
     * @return boolean
     */
    public function getRechercheIp() {
        return $this->rechercheIp;
    }

    /**
     * Set recherchePecheurs
     *
     * @param boolean $recherchePecheurs
     *
     * @return AdministrationUsers
     */
    public function setRecherchePecheurs($recherchePecheurs) {
        $this->recherchePecheurs = $recherchePecheurs;

        return $this;
    }

    /**
     * Get recherchePecheurs
     *
     * @return boolean
     */
    public function getRecherchePecheurs() {
        return $this->recherchePecheurs;
    }

    /**
     * Set rechercheMaries
     *
     * @param boolean $rechercheMaries
     *
     * @return AdministrationUsers
     */
    public function setRechercheMaries($rechercheMaries) {
        $this->rechercheMaries = $rechercheMaries;

        return $this;
    }

    /**
     * Get rechercheMaries
     *
     * @return boolean
     */
    public function getRechercheMaries() {
        return $this->rechercheMaries;
    }

    /**
     * Set rechercheItems
     *
     * @param boolean $rechercheItems
     *
     * @return AdministrationUsers
     */
    public function setRechercheItems($rechercheItems) {
        $this->rechercheItems = $rechercheItems;

        return $this;
    }

    /**
     * Get rechercheItems
     *
     * @return boolean
     */
    public function getRechercheItems() {
        return $this->rechercheItems;
    }

    /**
     * Set rechercheBannissements
     *
     * @param boolean $rechercheBannissements
     *
     * @return AdministrationUsers
     */
    public function setRechercheBannissements($rechercheBannissements) {
        $this->rechercheBannissements = $rechercheBannissements;

        return $this;
    }

    /**
     * Get rechercheBannissements
     *
     * @return boolean
     */
    public function getRechercheBannissements() {
        return $this->rechercheBannissements;
    }

    /**
     * Set rechercheRenames
     *
     * @param boolean $rechercheRenames
     *
     * @return AdministrationUsers
     */
    public function setRechercheRenames($rechercheRenames) {
        $this->rechercheRenames = $rechercheRenames;

        return $this;
    }

    /**
     * Get rechercheRenames
     *
     * @return boolean
     */
    public function getRechercheRenames() {
        return $this->rechercheRenames;
    }

    /**
     * Set bannissement
     *
     * @param boolean $bannissement
     *
     * @return AdministrationUsers
     */
    public function setBannissement($bannissement) {
        $this->bannissement = $bannissement;

        return $this;
    }

    /**
     * Get bannissement
     *
     * @return boolean
     */
    public function getBannissement() {
        return $this->bannissement;
    }

    /**
     * Set bannissementIp
     *
     * @param boolean $bannissementIp
     *
     * @return AdministrationUsers
     */
    public function setBannissementIp($bannissementIp) {
        $this->bannissementIp = $bannissementIp;

        return $this;
    }

    /**
     * Get bannissementIp
     *
     * @return boolean
     */
    public function getBannissementIp() {
        return $this->bannissementIp;
    }

    /**
     * Set debannissement
     *
     * @param boolean $debannissement
     *
     * @return AdministrationUsers
     */
    public function setDebannissement($debannissement) {
        $this->debannissement = $debannissement;

        return $this;
    }

    /**
     * Get debannissement
     *
     * @return boolean
     */
    public function getDebannissement() {
        return $this->debannissement;
    }

    /**
     * Set debannissementIp
     *
     * @param boolean $debannissementIp
     *
     * @return AdministrationUsers
     */
    public function setDebannissementIp($debannissementIp) {
        $this->debannissementIp = $debannissementIp;

        return $this;
    }

    /**
     * Get debannissementIp
     *
     * @return boolean
     */
    public function getDebannissementIp() {
        return $this->debannissementIp;
    }

    /**
     * Set voirPersonnage
     *
     * @param boolean $voirPersonnage
     *
     * @return AdministrationUsers
     */
    public function setVoirPersonnage($voirPersonnage) {
        $this->voirPersonnage = $voirPersonnage;

        return $this;
    }

    /**
     * Get voirPersonnage
     *
     * @return boolean
     */
    public function getVoirPersonnage() {
        return $this->voirPersonnage;
    }

    /**
     * Set voirCompte
     *
     * @param boolean $voirCompte
     *
     * @return AdministrationUsers
     */
    public function setVoirCompte($voirCompte) {
        $this->voirCompte = $voirCompte;

        return $this;
    }

    /**
     * Get voirCompte
     *
     * @return boolean
     */
    public function getVoirCompte() {
        return $this->voirCompte;
    }

    /**
     * Set descriptionMembre
     *
     * @param boolean $descriptionMembre
     *
     * @return AdministrationUsers
     */
    public function setDescriptionMembre($descriptionMembre) {
        $this->descriptionMembre = $descriptionMembre;

        return $this;
    }

    /**
     * Get descriptionMembre
     *
     * @return boolean
     */
    public function getDescriptionMembre() {
        return $this->descriptionMembre;
    }

    /**
     * Set gererMonnaies
     *
     * @param boolean $gererMonnaies
     *
     * @return AdministrationUsers
     */
    public function setGererMonnaies($gererMonnaies) {
        $this->gererMonnaies = $gererMonnaies;

        return $this;
    }

    /**
     * Get gererMonnaies
     *
     * @return boolean
     */
    public function getGererMonnaies() {
        return $this->gererMonnaies;
    }

    /**
     * Set gererNews
     *
     * @param boolean $gererNews
     *
     * @return AdministrationUsers
     */
    public function setGererNews($gererNews) {
        $this->gererNews = $gererNews;

        return $this;
    }

    /**
     * Get gererNews
     *
     * @return boolean
     */
    public function getGererNews() {
        return $this->gererNews;
    }

    /**
     * Set equipe
     *
     * @param boolean $equipe
     *
     * @return AdministrationUsers
     */
    public function setEquipe($equipe) {
        $this->equipe = $equipe;

        return $this;
    }

    /**
     * Get equipe
     *
     * @return boolean
     */
    public function getEquipe() {
        return $this->equipe;
    }

    /**
     * Set commandes
     *
     * @param boolean $commandes
     *
     * @return AdministrationUsers
     */
    public function setCommandes($commandes) {
        $this->commandes = $commandes;

        return $this;
    }

    /**
     * Get commandes
     *
     * @return boolean
     */
    public function getCommandes() {
        return $this->commandes;
    }

    /**
     * Set mp
     *
     * @param boolean $mp
     *
     * @return AdministrationUsers
     */
    public function setMp($mp) {
        $this->mp = $mp;

        return $this;
    }

    /**
     * Get mp
     *
     * @return boolean
     */
    public function getMp() {
        return $this->mp;
    }

}
