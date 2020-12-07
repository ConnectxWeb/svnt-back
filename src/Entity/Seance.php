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

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Gedmo\Mapping\Annotation as Gedmo;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * Seance
 *
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"seance_read"}},
 *     "denormalization_context"={"groups"={"seance_write"}}
 * })
 * @ApiFilter(SearchFilter::class, properties={"program": "exact"})
 * @ApiFilter(OrderFilter::class, properties={"id"}, arguments={"orderParameterName"="order"})
 *
 * @ORM\Table(name="seance", indexes={@ORM\Index(name="fk_seance_program1_idx", columns={"program_id"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\SeanceRepository")
 */
class Seance
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups({"seance_read" , "user_read" , "block_read","user_has_seance_read"})
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=128, nullable=true)
     * @Groups({"seance_read", "seance_write", "user_read","block_read"})
     */
    private $name;

    /**
     * @var int|null
     *
     * @ORM\Column(name="order_priority", type="integer", nullable=true)
     * @Groups({"seance_read", "user_read","user_has_seance_read","block_read"})
     */
    private $orderPriority;

    /**
     * @var string|null
     *
     * @ORM\Column(name="materials", type="text", length=0, nullable=true)
     * @Groups({"seance_read", "seance_write"})
     */
    private $materials;

    /**
     * @var string|null
     *
     * @ORM\Column(name="delay", type="string", length=255, nullable=true)
     * @Groups({"seance_read", "seance_write"})
     */
    private $delay;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="text", length=0, nullable=true)
     * @Groups({"seance_read", "seance_write"})
     */
    private $description;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     * @Groups({"seance_read"})
     */
    private $createdAt;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     * @Groups({"seance_read"})
     */
    private $updatedAt;

    /**
     * @var Program
     *
     * @ORM\ManyToOne(targetEntity="Program", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="program_id", referencedColumnName="id", onDelete="CASCADE")
     * })
     * @Groups({"seance_read", "seance_write", "user_read","block_read","user_has_seance_read"})
     */
    private $program;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * @Groups({"seance_read", "seance_write"})
     * @ORM\ManyToMany(targetEntity="Block", inversedBy="seance", cascade={"persist"})
     * @ORM\JoinTable(name="seance_has_block",
     *   joinColumns={
     *     @ORM\JoinColumn(name="seance_id", referencedColumnName="id", onDelete="CASCADE")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="block_id", referencedColumnName="id", onDelete="CASCADE")
     *   }
     * )
     */
    private $block;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Theme", mappedBy="seance", cascade={"persist"})
     *
     * @Groups({"seance_read" , "seance_write"})
     */
    private $theme;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="UserHasSeance", mappedBy="seance", cascade={"persist"})
     * @Groups({"seance_read"})
     */
    private $user;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->block = new \Doctrine\Common\Collections\ArrayCollection();
        $this->theme = new \Doctrine\Common\Collections\ArrayCollection();
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getOrderPriority(): ?int
    {
        return $this->orderPriority;
    }

    public function setOrderPriority(?int $orderPriority): self
    {
        $this->orderPriority = $orderPriority;

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

    public function getDelay(): ?string
    {
        return $this->delay;
    }

    public function setDelay(?string $delay): self
    {
        $this->delay = $delay;

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

    public function getProgram(): ?Program
    {
        return $this->program;
    }

    public function setProgram(?Program $program): self
    {
        $this->program = $program;

        return $this;
    }

    /**
     * @return Collection|Block[]
     */
    public function getBlock(): Collection
    {
        return $this->block;
    }

    public function addBlock(Block $block): self
    {
        if (!$this->block->contains($block)) {
            $this->block[] = $block;
        }

        return $this;
    }

    public function removeBlock(Block $block): self
    {
        if ($this->block->contains($block)) {
            $this->block->removeElement($block);
        }

        return $this;
    }

    /**
     * @return Collection|Theme[]
     */
    public function getTheme(): Collection
    {
        return $this->theme;
    }

    public function addTheme(Theme $theme): self
    {
        if (!$this->theme->contains($theme)) {
            $this->theme[] = $theme;
            $theme->addSeance($this);
        }

        return $this;
    }

    public function removeTheme(Theme $theme): self
    {
        if ($this->theme->contains($theme)) {
            $this->theme->removeElement($theme);
            $theme->removeSeance($this);
        }

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
            $user->addSeance($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->user->contains($user)) {
            $this->user->removeElement($user);
            $user->removeSeance($this);
        }

        return $this;
    }

}
