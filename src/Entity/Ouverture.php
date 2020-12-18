<?php

namespace App\Entity;

use App\Service\Generic\Entity\EntityBaseTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Ouverture
 *
 * @ORM\Table(name="ouverture")
 * @ORM\Entity(repositoryClass="App\Repository\OuvertureRepository")
 */
class Ouverture
{
    use EntityBaseTrait;

    /**
     * @var integer|null
     *
     * @ORM\Column(name="jour_index", type="smallint", nullable=false)
     */
    private $jourIndex;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="heure_debut", type="time", nullable=false)
     */
    private $heureDebut;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="heure_fin", type="time", nullable=false)
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

    public function getJourIndex(): ?bool
    {
        return $this->jourIndex;
    }

    public function setJourIndex(?bool $jourIndex): self
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
