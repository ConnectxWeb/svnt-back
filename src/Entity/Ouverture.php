<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Service\Generic\Entity\EntityBaseTrait;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Ouverture
 *
 * @ApiResource(
 *     attributes={
 *      "force_eager"=false,
 *      "normalization_context"={"groups"={"ouverture:read"}, "enable_max_depth"=true},
 *      "denormalization_context"={"groups"={"ouverture:write"}}
 *     }
 * )
 *
 * @ORM\Table(name="ouverture")
 * @ORM\Entity(repositoryClass="App\Repository\OuvertureRepository")
 */
class Ouverture
{
    use EntityBaseTrait;

    /**
     * @var int|null
     *
     * @ORM\Column(name="jour_index", type="smallint", nullable=false)
     * @Assert\Range(
     *      min = 1,
     *      max = 7,
     *      notInRangeMessage = "Le jour de la semaine doit être copris entre {{ min }} et {{ max }}.",
     * )
     * @Groups({"ouverture:read", "assoc:read"})
     */
    private $jourIndex;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="heure_debut", type="time", nullable=false)
     * @Groups({"ouverture:read", "assoc:read"})
     */
    private $heureDebut;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="heure_fin", type="time", nullable=false)
     * @Groups({"ouverture:read", "assoc:read"})
     */
    private $heureFin;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Assoc", mappedBy="ouverture", orphanRemoval=true, cascade={"persist"})
     */
    private $assoc;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Maraude", mappedBy="ouverture", orphanRemoval=true, cascade={"persist"})
     */
    private $maraude;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->assoc = new \Doctrine\Common\Collections\ArrayCollection();
        $this->maraude = new \Doctrine\Common\Collections\ArrayCollection();
    }

//    public function __toString()
//    {
//        return sprintf('Jour %s', $this->getJourIndex());
//    }

    public function getJourIndex(): ?int
    {
        return $this->jourIndex;
    }

    public function setJourIndex(?int $jourIndex): self
    {
        $this->jourIndex = $jourIndex;

        return $this;
    }

    public function getHeureDebut(): ?\DateTimeInterface
    {
        return $this->heureDebut;
    }

    public function setHeureDebut(?\DateTimeInterface $heureDebut): self
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    public function getHeureFin(): ?\DateTimeInterface
    {
        return $this->heureFin;
    }

    public function setHeureFin(?\DateTimeInterface $heureFin): self
    {
        $this->heureFin = $heureFin;

        return $this;
    }

    /**
     * @return Collection|Assoc[]
     */
    public function getAssoc(): Collection
    {
        return $this->assoc;
    }

    public function addAssoc(Assoc $assoc): self
    {
        if (!$this->assoc->contains($assoc)) {
            $this->assoc[] = $assoc;
            $assoc->addOuverture($this);
        }

        return $this;
    }

    public function removeAssoc(Assoc $assoc): self
    {
        if ($this->assoc->removeElement($assoc)) {
            $assoc->removeOuverture($this);
        }

        return $this;
    }

    /**
     * @return Collection|Maraude[]
     */
    public function getMaraude(): Collection
    {
        return $this->maraude;
    }

    public function addMaraude(Maraude $maraude): self
    {
        if (!$this->maraude->contains($maraude)) {
            $this->maraude[] = $maraude;
            $maraude->addOuverture($this);
        }

        return $this;
    }

    public function removeMaraude(Maraude $maraude): self
    {
        if ($this->maraude->removeElement($maraude)) {
            $maraude->removeOuverture($this);
        }

        return $this;
    }

}
