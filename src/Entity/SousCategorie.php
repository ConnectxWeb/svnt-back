<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SousCategorieRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=SousCategorieRepository::class)
 */
class SousCategorie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie", inversedBy="sousCategories")
     * @ORM\JoinColumn(name="categorie_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $categorie;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Assoc", inversedBy="sousCategories")
     */
    private $assocs;

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

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getAssocs(): ?Assoc
    {
        return $this->assocs;
    }

    public function setAssocs(?Assoc $assocs): self
    {
        $this->assocs = $assocs;

        return $this;
    }

    public function __toString()
    {
        return $this->getNom();
    }
}
