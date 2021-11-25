<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Service\Generic\Entity\EntityBaseTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;


/**
 * @ApiResource(
 *     attributes={
 *      "force_eager"=false,
 *      "normalization_context"={"groups"={"annuaireCategorie:read"}, "enable_max_depth"=true},
 *      "denormalization_context"={"groups"={"annuaireCategorie:write"}}
 *     }
 * )
 *
 * @ORM\Table(name="annuaire_categorie")
 * @ORM\Entity(repositoryClass="App\Repository\AnnuaireCategorieRepository")
 */
class AnnuaireCategorie
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    use EntityBaseTrait;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom", type="string", length=128, nullable=false, unique=true)
     * @Groups({"annuaireCategorie:read"})
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AnnuaireOrganisme", mappedBy="categorie", orphanRemoval=true)
     * @Groups({"ville:read"})
     */
    private $organismes;

    public function __construct()
    {
        $this->organismes = new ArrayCollection();
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

    public function __toString()
    {
        return $this->nom;
    }

    /**
     * @return mixed
     */
    public function getOrganismes()
    {
        return $this->organismes;
    }

    /**
     * @param mixed $organismes
     */
    public function setOrganismes($organismes): void
    {
        $this->organismes = $organismes;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function addOrganisme(AnnuaireOrganisme $organisme): self
    {
        if (!$this->organismes->contains($organisme)) {
            $this->organismes[] = $organisme;
            $organisme->setCategorie($this);
        }

        return $this;
    }

    public function removeOrganisme(AnnuaireOrganisme $organisme): self
    {
        if ($this->organismes->removeElement($organisme)) {
            // set the owning side to null (unless already changed)
            if ($organisme->getCategorie() === $this) {
                $organisme->setCategorie(null);
            }
        }

        return $this;
    }
}
