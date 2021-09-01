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
     * @ORM\ManyToOne(targetEntity="App\Entity\Assoc", inversedBy="categories", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="assoc_id", referencedColumnName="id", nullable=true, onDelete="CASCADE")
     */
    private $assocs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SousCategorie", mappedBy="categorie")
     * @Groups({"categorie:read"})
     */
    private $sousCategories;


    public function __construct()
    {
        $this->sousCategories = new ArrayCollection();
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
}
