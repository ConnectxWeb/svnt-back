<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Maraude
 *
 * @ORM\Table(name="maraude", indexes={@ORM\Index(name="fk_assoc_copy1_assoc1", columns={"assoc_id"})})
 * @ORM\Entity
 */
class Maraude
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
     * @var string|null
     *
     * @ORM\Column(name="nom", type="string", length=128, nullable=true)
     */
    private $nom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="text", length=16777215, nullable=true)
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @var string|null
     *
     * @ORM\Column(name="longitude", type="string", length=32, nullable=true)
     */
    private $longitude;

    /**
     * @var string|null
     *
     * @ORM\Column(name="latitude", type="string", length=32, nullable=true)
     */
    private $latitude;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_debut", type="datetime", nullable=true)
     */
    private $dateDebut;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_fin", type="datetime", nullable=true)
     */
    private $dateFin;

    /**
     * @var \Assoc
     *
     * @ORM\ManyToOne(targetEntity="Assoc")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="assoc_id", referencedColumnName="id")
     * })
     */
    private $assoc;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Ouverture", inversedBy="maraude")
     * @ORM\JoinTable(name="maraude_has_ouverture",
     *   joinColumns={
     *     @ORM\JoinColumn(name="maraude_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="ouverture_id", referencedColumnName="id")
     *   }
     * )
     */
    private $ouverture;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ouverture = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
