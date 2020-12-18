<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ouverture
 *
 * @ORM\Table(name="ouverture")
 * @ORM\Entity
 */
class Ouverture
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="jour_index", type="boolean", nullable=true)
     */
    private $jourIndex;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="heure_debut", type="time", nullable=true)
     */
    private $heureDebut;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="heure_fin", type="time", nullable=true)
     */
    private $heureFin;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Assoc", mappedBy="ouverture")
     */
    private $assoc;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Maraude", mappedBy="ouverture")
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

}
