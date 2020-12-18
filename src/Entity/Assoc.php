<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Assoc
 *
 * @ORM\Table(name="assoc", indexes={@ORM\Index(name="fk_assoc_ville", columns={"ville_id"})})
 * @ORM\Entity
 */
class Assoc
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
     * @ORM\Column(name="telephone", type="string", length=32, nullable=true)
     */
    private $telephone;

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
     * @var bool|null
     *
     * @ORM\Column(name="homme", type="boolean", nullable=true)
     */
    private $homme;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="femme", type="boolean", nullable=true)
     */
    private $femme;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="chien", type="boolean", nullable=true)
     */
    private $chien;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="handicap", type="boolean", nullable=true)
     */
    private $handicap;

    /**
     * @var \Ville
     *
     * @ORM\ManyToOne(targetEntity="Ville")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ville_id", referencedColumnName="id")
     * })
     */
    private $ville;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Ouverture", inversedBy="assoc")
     * @ORM\JoinTable(name="assoc_has_ouverture",
     *   joinColumns={
     *     @ORM\JoinColumn(name="assoc_id", referencedColumnName="id")
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
