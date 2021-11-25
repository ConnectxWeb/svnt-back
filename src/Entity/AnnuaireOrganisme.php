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
 *      "normalization_context"={"groups"={"annuaireOrganisme:read"}, "enable_max_depth"=true},
 *      "denormalization_context"={"groups"={"annuaireOrganisme:write"}}
 *     }
 * )
 *
 * @ORM\Table(name="annuaire_organisme")
 * @ORM\Entity(repositoryClass="App\Repository\AnnuaireOrganismeRepository")
 */
class AnnuaireOrganisme
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
     * @ORM\Column(name="nom", type="string", length=255, nullable=false, unique=true)
     * @Groups({"annuaireOrganisme:read"})
     */
    private $nom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="telephone", type="string", length=32, nullable=false, unique=true)
     * @Groups({"annuaireOrganisme:read"})
     */
    private $telephone;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AnnuaireCategorie", inversedBy="organismes", cascade={"persist"})
     * @ORM\JoinColumn(referencedColumnName="id", nullable=false, onDelete="CASCADE")
     *
     * @Groups({"annuaireOrganisme:read"})
     */
    private $categorie;

    public function __construct()
    {
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
    public function getId()
    {
        return $this->id;
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
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param mixed $categorie
     */
    public function setCategorie($categorie): void
    {
        $this->categorie = $categorie;
    }
}
