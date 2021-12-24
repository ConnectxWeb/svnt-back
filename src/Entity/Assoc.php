<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use App\Service\Generic\Entity\EntityBaseTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * Assoc
 *
 * @ApiResource(
 *     attributes={
 *      "force_eager"=false,
 *      "normalization_context"={"groups"={"assoc:read"}, "enable_max_depth"=true},
 *      "denormalization_context"={"groups"={"assoc:write"}}
 *     }
 * )
 * @ApiFilter(SearchFilter::class, properties={"nom": "exact"})
 * @ApiFilter(BooleanFilter::class, properties={"animauxAuthorises", "accesPmr"})
 *
 * @ORM\Table(name="assoc", indexes={@ORM\Index(name="fk_assoc_ville", columns={"ville_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\AssocRepository")
 */
class Assoc
{
    const LOGO_PATH = '/upload/assoc';

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Groups({"assoc:read", "ville:read"})
     */
    private $id;

    use EntityBaseTrait;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom", type="string", length=128, nullable=false, unique=true)
     *
     * @Groups({"assoc:read", "ville:read"})
     */
    private $nom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="text", length=16777215, nullable=true)
     *
     * @Groups({"assoc:read", "ville:read"})
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="telephone", type="string", length=32, nullable=true)
     *
     * @Groups({"assoc:read", "ville:read"})
     */
    private $telephone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=false)
     *
     * @Groups({"assoc:read", "ville:read"})
     */
    private $adresse;

    /**
     * @var string|null
     *
     * @ORM\Column(name="longitude", type="string", length=32, nullable=true)
     *
     * @Groups({"assoc:read", "ville:read"})
     */
    private $longitude;

    /**
     * @var string|null
     * @ORM\Column(name="latitude", type="string", length=32, nullable=true)
     * @Groups({"assoc:read", "ville:read"})
     */
    private $latitude;

    /**
     * @var bool|null
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"assoc:read", "ville:read"})
     */
    private $animauxAuthorises = false;

    /**
     * @var bool|null
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"assoc:read", "ville:read"})
     */
    private $accesPmr = false;

    /**
     * @var bool|null
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"assoc:read", "ville:read"})
     */
    private $sourdMalentendant = false;

    /**
     * @var bool|null
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"assoc:read", "ville:read"})
     */
    private $malVoyant = false;

    /**
     * @var bool|null
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"assoc:read", "ville:read"})
     */
    private $femmeUniquement = false;

    /**
     * @ORM\ManyToOne(targetEntity="Ville", inversedBy="assocs", cascade={"persist"})
     * @ORM\JoinColumn(name="ville_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     *
     * @Groups({"assoc:read"})
     */
    private $ville;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Maraude", mappedBy="assoc", orphanRemoval=true)
     *
     * @Groups({"assoc:read", "ville:read"})
     */
    private $maraudes;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Ouverture", inversedBy="assoc", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="assoc_has_ouverture",
     *   joinColumns={
     *     @ORM\JoinColumn(name="assoc_id", referencedColumnName="id", onDelete="CASCADE")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="ouverture_id", referencedColumnName="id", onDelete="CASCADE")
     *   }
     * )
     *
     * @Groups({"assoc:read", "ville:read"})
     */
    private $ouverture;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Categorie", inversedBy="assocs", cascade={"persist"})
     * @ORM\JoinTable(name="assoc_has_category",
     *   joinColumns={
     *     @ORM\JoinColumn(name="assoc_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     *   }
     * )
     *
     * @Groups({"assoc:read", "ville:read"})
     */
    private $categories;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\SousCategorie", inversedBy="assocs", cascade={"persist"})
     * @ORM\JoinTable(name="assoc_has_sousCategory",
     *   joinColumns={
     *     @ORM\JoinColumn(name="assoc_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="sousCategory_id", referencedColumnName="id")
     *   }
     * )
     *
     * @Groups({"assoc:read", "ville:read"})
     */
    private $sousCategories;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logoFilename;


    public function __construct()
    {
        $this->ouverture = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->sousCategories = new ArrayCollection();
        $this->maraudes = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nom;
    }

    /**
     * @Groups({"assoc:read", "ville:read"})
     */
    public function getApiLogo(): ?string //for front
    {
        if ($this->getLogoFilename() !== null) {
            return self::LOGO_PATH . '/' . $this->getLogoFilename();
        }

        return null;
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

    public function getAnimauxAuthorises(): ?bool
    {
        return $this->animauxAuthorises;
    }

    public function setAnimauxAuthorises(?bool $animauxAuthorises): self
    {
        $this->animauxAuthorises = $animauxAuthorises;

        return $this;
    }

    public function getAccesPmr(): ?bool
    {
        return $this->accesPmr;
    }

    public function setAccesPmr(?bool $accesPmr): self
    {
        $this->accesPmr = $accesPmr;

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

    /**
     * @return mixed
     */
    public function getMaraudes()
    {
        return $this->maraudes;
    }

    /**
     * @param mixed $maraudes
     */
    public function setMaraudes($maraudes): void
    {
        $this->maraudes = $maraudes;
    }

    /**
     * @return Collection|SousCategorie[]
     */
    public function getSousCategories(): Collection
    {
        return $this->sousCategories;
    }

    public function addSousCategory(SousCategorie $sousCategorie
    ): self //magic method: must be written "category" to be detected by easyadmin update
    {
        if (!$this->sousCategories->contains($sousCategorie)) {
            $this->sousCategories[] = $sousCategorie;
            $sousCategorie->setAssocs($this);
        }

        return $this;
    }

    public function removeSousCategory(SousCategorie $sousCategorie): self
    {
        if ($this->sousCategories->removeElement($sousCategorie)) {
            // set the owning side to null (unless already changed)
            if ($sousCategorie->getAssocs() === $this) {
                $sousCategorie->setAssocs(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param Categorie $categorie
     * @return Assoc
     */
    public function addCategory(Categorie $categorie): self
    { //magic method: should be written "category" to be detected by easyadmin update
        if (!$this->categories->contains($categorie)) {
            $this->categories[] = $categorie;
            $categorie->setAssocs($this);
        }

        return $this;
    }

    public function removeCategory(Categorie $categorie): self
    {
        if ($this->categories->removeElement($categorie)) {
            // set the owning side to null (unless already changed)
            if ($categorie->getAssocs() === $this) {
                $categorie->setAssocs(null);
            }
        }

        return $this;
    }

    public function addMaraude(Maraude $maraude): self
    {
        if (!$this->maraudes->contains($maraude)) {
            $this->maraudes[] = $maraude;
            $maraude->setAssoc($this);
        }

        return $this;
    }

    public function removeMaraude(Maraude $maraude): self
    {
        if ($this->maraudes->removeElement($maraude)) {
            // set the owning side to null (unless already changed)
            if ($maraude->getAssoc() === $this) {
                $maraude->setAssoc(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLogoFilename()
    {
        return $this->logoFilename;
    }

    /**
     * @param mixed $logoFilename
     */
    public function setLogoFilename($logoFilename): void
    {
        $this->logoFilename = $logoFilename;
    }

    /**
     * @return bool|null
     */
    public function getFemmeUniquement(): ?bool
    {
        return $this->femmeUniquement;
    }

    /**
     * @param bool|null $femmeUniquement
     */
    public function setFemmeUniquement(?bool $femmeUniquement): void
    {
        $this->femmeUniquement = $femmeUniquement;
    }

    /**
     * @return bool|null
     */
    public function getMalVoyant(): ?bool
    {
        return $this->malVoyant;
    }

    /**
     * @param bool|null $malVoyant
     */
    public function setMalVoyant(?bool $malVoyant): void
    {
        $this->malVoyant = $malVoyant;
    }

    /**
     * @return bool|null
     */
    public function getSourdMalentendant(): ?bool
    {
        return $this->sourdMalentendant;
    }

    /**
     * @param bool|null $sourdMalentendant
     */
    public function setSourdMalentendant(?bool $sourdMalentendant): void
    {
        $this->sourdMalentendant = $sourdMalentendant;
    }

}
