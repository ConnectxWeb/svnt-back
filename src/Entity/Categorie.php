<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     attributes={
 *      "force_eager"=false,
 *      "normalization_context"={"groups"={"categorie:read"}, "enable_max_depth"=true},
 *      "denormalization_context"={"groups"={"categorie:write"}}
 *     }
 * )
 *
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */
class Categorie
{
    const LOGO_PATH = '/upload/cat';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"categorie:read", "ville:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"categorie:read", "ville:read"})
     */
    private $nom;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"categorie:read", "ville:read"})
     */
    private $html;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Assoc", mappedBy="categories", orphanRemoval=true, cascade={"persist"})
     */
    private $assocs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SousCategorie", mappedBy="categorie")
     * @Groups({"categorie:read"})
     */
    private $sousCategories;

    /**
     * @ORM\Column(type="integer", options={"default":"999", "unsigned"=true}, nullable=true)
     * @Groups({"categorie:read", "ville:read"})
     */
    private $ordre = 999;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logoFilename;

    public function __construct()
    {
        $this->assocs = new ArrayCollection();
        $this->sousCategories = new ArrayCollection();
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

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|SousCategorie[]
     */
    public function getSousCategories(): Collection
    {
        return $this->sousCategories;
    }

    public function addSousCategorie(SousCategorie $sousCategorie): self
    {
        if (!$this->sousCategories->contains($sousCategorie)) {
            $this->sousCategories[] = $sousCategorie;
            $sousCategorie->setCategorie($this);
        }

        return $this;
    }

    public function removeSousCategorie(SousCategorie $sousCategorie): self
    {
        if ($this->sousCategories->removeElement($sousCategorie)) {
            // set the owning side to null (unless already changed)
            if ($sousCategorie->getCategorie() === $this) {
                $sousCategorie->setCategorie(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getNom();
    }

    /**
     * @return mixed
     */
    public function getAssocs()
    {
        return $this->assocs;
    }

    /**
     * @param mixed $assocs
     */
    public function setAssocs($assocs): void
    {
        $this->assocs = $assocs;
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

    public function addAssoc(Assoc $assoc): self
    {
        if (!$this->assocs->contains($assoc)) {
            $this->assocs[] = $assoc;
            $assoc->addCategory($this);
        }

        return $this;
    }

    public function removeAssoc(Assoc $assoc): self
    {
        if ($this->assocs->removeElement($assoc)) {
            $assoc->removeCategory($this);
        }

        return $this;
    }

    public function addSousCategory(SousCategorie $sousCategory): self
    {
        if (!$this->sousCategories->contains($sousCategory)) {
            $this->sousCategories[] = $sousCategory;
            $sousCategory->setCategorie($this);
        }

        return $this;
    }

    public function removeSousCategory(SousCategorie $sousCategory): self
    {
        if ($this->sousCategories->removeElement($sousCategory)) {
            // set the owning side to null (unless already changed)
            if ($sousCategory->getCategorie() === $this) {
                $sousCategory->setCategorie(null);
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
     * @return mixed
     */
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * @param mixed $html
     */
    public function setHtml($html): void
    {
        $this->html = $html;
    }
}
