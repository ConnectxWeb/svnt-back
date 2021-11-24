<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Service\Generic\Entity\EntityBaseTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     attributes={
 *      "force_eager"=false,
 *      "normalization_context"={"groups"={"maraude:read"}, "enable_max_depth"=true},
 *      "denormalization_context"={"groups"={"maraude:write"}}
 *     }
 * )
 *
 * @ORM\Table(name="maraude", indexes={@ORM\Index(name="fk_assoc_copy1_assoc1", columns={"assoc_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\MaraudeRepository")
 */
class Maraude
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"maraude:read", "ville:read"})
     */
    private $id;

    use EntityBaseTrait;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom", type="string", length=128, nullable=false, unique=true)
     * @Groups({"maraude:read", "assoc:read", "ville:read"})
     */
    private $nom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="text", length=16777215, nullable=true)
     * @Groups({"maraude:read", "assoc:read", "ville:read"})
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="telephone", type="string", length=32, nullable=true)
     * @Groups({"maraude:read", "assoc:read", "ville:read"})
     */
    private $telephone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=false)
     * @Groups({"maraude:read", "assoc:read", "ville:read"})
     */
    private $adresse;

    /**
     * @var string|null
     *
     * @ORM\Column(name="longitude", type="string", length=32, nullable=true)
     * @Groups({"maraude:read", "assoc:read", "ville:read"})
     */
    private $longitude;

    /**
     * @var string|null
     *
     * @ORM\Column(name="latitude", type="string", length=32, nullable=true)
     * @Groups({"maraude:read", "assoc:read", "ville:read"})
     */
    private $latitude;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_debut", type="datetime", nullable=true)
     * @Groups({"maraude:read", "assoc:read", "ville:read"})
     */
    private $dateDebut;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_fin", type="datetime", nullable=true)
     * @Groups({"maraude:read", "assoc:read", "ville:read"})
     */
    private $dateFin;

    /**
     * @var \Assoc
     *
     * @ORM\ManyToOne(targetEntity="Assoc", inversedBy="maraudes", cascade={"persist"})
     * @ORM\JoinColumn(name="assoc_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     * @Groups({"maraude:read"})
     */
    private $assoc;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Ouverture", inversedBy="maraude", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="maraude_has_ouverture",
     *   joinColumns={
     *     @ORM\JoinColumn(name="maraude_id", referencedColumnName="id", onDelete="CASCADE")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="ouverture_id", referencedColumnName="id", onDelete="CASCADE")
     *   }
     * )
     *
     * @Groups({"maraude:read", "assoc:read", "ville:read"})
     */
    private $ouverture;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ouverture = new \Doctrine\Common\Collections\ArrayCollection();
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

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(?\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getAssoc(): ?Assoc
    {
        return $this->assoc;
    }

    public function setAssoc(?Assoc $assoc): self
    {
        $this->assoc = $assoc;

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

    /**
     * @return string|null
     */
    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    /**
     * @param string|null $telephone
     */
    public function setTelephone(?string $telephone): void
    {
        $this->telephone = $telephone;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

}
