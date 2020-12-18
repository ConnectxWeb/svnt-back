<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Assoc
 *
 * @ORM\Table(name="assoc", indexes={@ORM\Index(name="fk_assoc_ville", columns={"ville_id"})})
 * @ORM\Entity
 */
class Assoc
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom", type="string", length=128, nullable=true)
     */
    private $nom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="text", length=16777215, nullable=true)
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="telephone", type="string", length=32, nullable=true)
     */
    private $telephone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @var string|null
     *
     * @ORM\Column(name="longitude", type="string", length=32, nullable=true)
     */
    private $longitude;

    /**
     * @var string|null
     *
     * @ORM\Column(name="latitude", type="string", length=32, nullable=true)
     */
    private $latitude;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="homme", type="boolean", nullable=true)
     */
    private $homme;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="femme", type="boolean", nullable=true)
     */
    private $femme;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="chien", type="boolean", nullable=true)
     */
    private $chien;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="handicap", type="boolean", nullable=true)
     */
    private $handicap;

    /**
     * @var \Ville
     *
     * @ORM\ManyToOne(targetEntity="Ville")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ville_id", referencedColumnName="id")
     * })
     */
    private $ville;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Ouverture", inversedBy="assoc")
     * @ORM\JoinTable(name="assoc_has_ouverture",
     *   joinColumns={
     *     @ORM\JoinColumn(name="assoc_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="ouverture_id", referencedColumnName="id")
     *   }
     * )
     */
    private $ouverture;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ouverture = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(?string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(?string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getHomme(): ?bool
    {
        return $this->homme;
    }

    public function setHomme(?bool $homme): self
    {
        $this->homme = $homme;

        return $this;
    }

    public function getFemme(): ?bool
    {
        return $this->femme;
    }

    public function setFemme(?bool $femme): self
    {
        $this->femme = $femme;

        return $this;
    }

    public function getChien(): ?bool
    {
        return $this->chien;
    }

    public function setChien(?bool $chien): self
    {
        $this->chien = $chien;

        return $this;
    }

    public function getHandicap(): ?bool
    {
        return $this->handicap;
    }

    public function setHandicap(?bool $handicap): self
    {
        $this->handicap = $handicap;

        return $this;
    }

    public function getVille(): ?Ville
    {
        return $this->ville;
    }

    public function setVille(?Ville $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * @return Collection|Ouverture[]
     */
    public function getOuverture(): Collection
    {
        return $this->ouverture;
    }

    public function addOuverture(Ouverture $ouverture): self
    {
        if (!$this->ouverture->contains($ouverture)) {
            $this->ouverture[] = $ouverture;
        }

        return $this;
    }

    public function removeOuverture(Ouverture $ouverture): self
    {
        $this->ouverture->removeElement($ouverture);

        return $this;
    }

}
