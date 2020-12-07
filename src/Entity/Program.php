<?php
/**
 * This code is open source and licensed under the MIT License
 * Author: Benjamin Leveque <info@connectx.fr>
 * Copyright (c) - connectX
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is furnished
 * to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Program
 *
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"program_read"}},
 *     "denormalization_context"={"groups"={"program_write"}}
 * })
 *
 * @ORM\Table(name="program", indexes={@ORM\Index(name="fk_program_coach1_idx", columns={"coach_id"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\ProgramRepository")
 */
class Program
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @Groups({"program_read", "user_read" ,"seance_read","block_read","user_has_seance_read","user_has_program_read"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     * @Groups({"program_read", "program_write" , "user_read", "seance_read","block_read"})
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="text", length=0, nullable=true)
     * @Groups({"program_read", "program_write"})
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     * @Groups({"program_read", "program_write","seance_read","block_read"})
     */
    private $image;

    /**
     * @var string|null
     *
     * @ORM\Column(name="time", type="string", length=255, nullable=true)
     * @Groups({"program_read", "program_write"})
     */
    private $time;

    /**
     * @var string|null
     *
     * @ORM\Column(name="frequency", type="string", length=255, nullable=true)
     * @Groups({"program_read", "program_write", "seance_read"})
     */
    private $frequency;


    /**
     * @var string|null
     *
     * @ORM\Column(name="color", type="string", length=255, nullable=true)
     * @Groups({"program_read", "program_write","seance_read","block_read"})
     */
    private $color;

    /**
     * @var string|null
     *
     * @ORM\Column(name="url_pdf", type="text", length=0, nullable=true)
     * @Groups({"program_read", "program_write"})
     */
    private $urlPdf;

    /**
     * @var string|null
     *
     * @ORM\Column(name="materials", type="text", length=0, nullable=true)
     * @Groups({"program_read", "program_write"})
     */
    private $materials;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     * @Groups({"program_read"})
     */
    private $createdAt;
    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     * @Groups({"program_read"})
     */
    private $updatedAt;

    /**
     * @var Coach
     *
     * @ORM\ManyToOne(targetEntity="Coach" ,  cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="coach_id", referencedColumnName="id", onDelete="CASCADE")
     * })
     * @Groups({"program_read", "program_write"})
     */
    private $coach;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="UserHasProgram", mappedBy="program", cascade={"persist"})
     * @Groups({"program_read"})
     */
    private $user;

    public function __construct()
    {
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getTime(): ?string
    {
        return $this->time;
    }

    public function setTime(?string $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getFrequency(): ?string
    {
        return $this->frequency;
    }

    public function setFrequency(?string $time): self
    {
        $this->frequency = $time;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $time): self
    {
        $this->color = $time;

        return $this;
    }

    public function getUrlPdf(): ?string
    {
        return $this->urlPdf;
    }

    public function setUrlPdf(?string $urlPdf): self
    {
        $this->urlPdf = $urlPdf;

        return $this;
    }

    public function getMaterials(): ?string
    {
        return $this->materials;
    }

    public function setMaterials(?string $materials): self
    {
        $this->materials = $materials;

        return $this;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getCoach(): ?Coach
    {
        return $this->coach;
    }

    public function setCoach(?Coach $coach): self
    {
        $this->coach = $coach;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
            $user->addProgram($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->user->contains($user)) {
            $this->user->removeElement($user);
            $user->removeProgram($this);
        }

        return $this;
    }


}
