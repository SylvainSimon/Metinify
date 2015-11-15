<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MarcheArticles
 *
 * @ORM\Table(name="site.marche_articles")
 * @ORM\Entity(repositoryClass="Site\Repository\MarcheArticlesRepository")
 */
class MarcheArticles {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="designation", type="string", length=255, nullable=true)
     */
    private $designation;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="categorie", type="integer", nullable=true)
     */
    private $categorie;

    /**
     * @var integer
     *
     * @ORM\Column(name="identifiant_article", type="integer", nullable=true)
     */
    private $identifiantArticle;

    /**
     * @var integer
     *
     * @ORM\Column(name="prix", type="integer", nullable=true)
     */
    private $prix;

    /**
     * @var integer
     *
     * @ORM\Column(name="devise", type="integer", nullable=true)
     */
    private $devise;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_ajout", type="datetime", nullable=true)
     */
    private $dateAjout;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=50, nullable=true)
     */
    private $ip;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set designation
     *
     * @param string $designation
     *
     * @return MarcheArticles
     */
    public function setDesignation($designation) {
        $this->designation = $designation;

        return $this;
    }

    /**
     * Get designation
     *
     * @return string
     */
    public function getDesignation() {
        return $this->designation;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return MarcheArticles
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set categorie
     *
     * @param integer $categorie
     *
     * @return MarcheArticles
     */
    public function setCategorie($categorie) {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return integer
     */
    public function getCategorie() {
        return $this->categorie;
    }

    /**
     * Set identifiantArticle
     *
     * @param integer $identifiantArticle
     *
     * @return MarcheArticles
     */
    public function setIdentifiantArticle($identifiantArticle) {
        $this->identifiantArticle = $identifiantArticle;

        return $this;
    }

    /**
     * Get identifiantArticle
     *
     * @return integer
     */
    public function getIdentifiantArticle() {
        return $this->identifiantArticle;
    }

    /**
     * Set prix
     *
     * @param integer $prix
     *
     * @return MarcheArticles
     */
    public function setPrix($prix) {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return integer
     */
    public function getPrix() {
        return $this->prix;
    }

    /**
     * Set devise
     *
     * @param integer $devise
     *
     * @return MarcheArticles
     */
    public function setDevise($devise) {
        $this->devise = $devise;

        return $this;
    }

    /**
     * Get devise
     *
     * @return integer
     */
    public function getDevise() {
        return $this->devise;
    }

    /**
     * Set dateAjout
     *
     * @param \DateTime $dateAjout
     *
     * @return MarcheArticles
     */
    public function setDateAjout($dateAjout) {
        $this->dateAjout = $dateAjout;

        return $this;
    }

    /**
     * Get dateAjout
     *
     * @return \DateTime
     */
    public function getDateAjout() {
        return $this->dateAjout;
    }

    /**
     * Set ip
     *
     * @param string $ip
     *
     * @return MarcheArticles
     */
    public function setIp($ip) {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp() {
        return $this->ip;
    }

}
