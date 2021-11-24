<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\GpxRepository;
use App\Service\Generic\Entity\EntityBaseTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     attributes={
 *      "force_eager"=false,
 *      "normalization_context"={"groups"={"gpx:read"}, "enable_max_depth"=true},
 *      "denormalization_context"={"groups"={"gpx:write"}}
 *     }
 * )
 *
 * @ORM\Entity(repositoryClass=GpxRepository::class)
 */
class Gpx
{
    const LOGO_PATH = '/upload/gpx/picto';
    const GPX_PATH = '/upload/gpx';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    use EntityBaseTrait;

    /**
     * @ORM\ManyToOne(targetEntity=Ville::class)
     * @ORM\JoinColumn(nullable=false)
     *
     * @Groups({"gpx:read", "ville:read"})
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Groups({"gpx:read", "ville:read"})
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"gpx:read", "ville:read"})
     */
    private $logoFilename;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Groups({"gpx:read", "ville:read"})
     */
    private $gpxFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"gpx:read", "ville:read"})
     */
    private $traceColor;

    /**
     * @ORM\Column(type="boolean", options={"default":"0"}, nullable=true)
     * @Groups({"gpx:read", "ville:read"})
     */
    private $isValid = false;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVille(): ?ville
    {
        return $this->ville;
    }

    public function setVille(?ville $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getGpxFile(): ?string
    {
        return $this->gpxFile;
    }

    public function setGpxFile(string $gpxFile): self
    {
        $this->gpxFile = $gpxFile;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLogoFilename()
    {
        return $this->logoFilename;
    }

    /**
     * @param mixed $logoFilename
     */
    public function setLogoFilename($logoFilename): void
    {
        $this->logoFilename = $logoFilename;
    }

    /**
     * @Groups({"gpx:read", "ville:read"})
     */
    public function getApiLogo(): ?string //for front
    {
        if ($this->getLogoFilename() !== null) {
            return self::LOGO_PATH . '/' . $this->getLogoFilename();
        }

        return null;
    }

    /**
     * @Groups({"gpx:read", "ville:read"})
     */
    public function getApiGpxFile(): ?string //for front
    {
        if ($this->getGpxFile() !== null) {
            return self::GPX_PATH . '/' . $this->getGpxFile();
        }

        return null;
    }

    /**
     * @return mixed
     */
    public function getTraceColor()
    {
        return $this->traceColor;
    }

    /**
     * @param mixed $traceColor
     */
    public function setTraceColor($traceColor): void
    {
        $this->traceColor = $traceColor;
    }

    /**
     * @return mixed
     */
    public function getIsValid()
    {
        return $this->isValid;
    }

    /**
     * @param mixed $isValid
     */
    public function setIsValid($isValid): void
    {
        $this->isValid = $isValid;
    }
}
