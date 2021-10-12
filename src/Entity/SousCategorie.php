<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SousCategorieRepository;
use App\Service\Generic\Entity\EntityBaseTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=SousCategorieRepository::class)
 */
class SousCategorie
{
    const LOGO_PATH = '/upload/subCat';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @Groups({"categorie:read", "ville:read"})
     */
    private $id;

    use EntityBaseTrait;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Groups({"categorie:read", "ville:read"})
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie", inversedBy="sousCategories")
     * @ORM\JoinColumn(name="categorie_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     *
     * @Groups({"categorie:read", "ville:read"})
     */
    private $categorie;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Assoc", mappedBy="sousCategories", orphanRemoval=true, cascade={"persist"})
     * @var Collection
     */
    private $assocs;

    /**
     * @ORM\Column(type="integer", options={"default"="999", "unsigned"=true}, nullable=true)
     *
     * @Groups({"categorie:read", "ville:read"})
     */
    private $ordre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logoFilename;


    public function __construct()
    {
        $this->assocs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @Groups({"categorie:read", "ville:read"})
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

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getAssocs(): ?Collection
    {
        return $this->assocs;
    }

    public function setAssocs(?Collection $assocs): self
    {
        $this->assocs = $assocs;

        return $this;
    }

    public function __toString()
    {
        return $this->getNom();
    }

    /**
     * @return mixed
     */
    public function getOrdre()
    {
        return $this->ordre;
    }

    /**
     * @param mixed $ordre
     */
    public function setOrdre($ordre): void
    {
        $this->ordre = $ordre;
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

    public function addAssoc(Assoc $assoc): self
    {
        if (!$this->assocs->contains($assoc)) {
            $this->assocs[] = $assoc;
            $assoc->addSousCategory($this);
        }

        return $this;
    }

    public function removeAssoc(Assoc $assoc): self
    {
        if ($this->assocs->removeElement($assoc)) {
            $assoc->removeSousCategory($this);
        }

        return $this;
    }
}
