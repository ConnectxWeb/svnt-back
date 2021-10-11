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
 * Ville
 *
 * @ApiResource(
 *     attributes={
 *      "force_eager"=false,
 *      "normalization_context"={"groups"={"ville:read"}, "enable_max_depth"=true},
 *      "denormalization_context"={"groups"={"ville:write"}}
 *     }
 * )
 *
 * @ORM\Table(name="ville")
 * @ORM\Entity(repositoryClass="App\Repository\VilleRepository")
 */
class Ville
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"ville:read"})
     */
    private $id;

    use EntityBaseTrait;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom", type="string", length=64, nullable=false, unique=true)
     * @Groups({"ville:read", "assoc:read"})
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Assoc", mappedBy="ville", orphanRemoval=true)
     * @Groups({"ville:read"})
     */
    private $assocs;

    public function __construct()
    {
        $this->assocs = new ArrayCollection();
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
    public function getId()
    {
        return $this->id;
    }

    public function addAssoc(Assoc $assoc): self
    {
        if (!$this->assocs->contains($assoc)) {
            $this->assocs[] = $assoc;
            $assoc->setVille($this);
        }

        return $this;
    }

    public function removeAssoc(Assoc $assoc): self
    {
        if ($this->assocs->removeElement($assoc)) {
            // set the owning side to null (unless already changed)
            if ($assoc->getVille() === $this) {
                $assoc->setVille(null);
            }
        }

        return $this;
    }
}
