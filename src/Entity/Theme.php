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
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * Theme
 *
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"theme_read"}},
 *     "denormalization_context"={"groups"={"theme_write"}},
 *     "order"={"name": "ASC"}
 * })
 * @ApiFilter(SearchFilter::class, properties={"seance": "exact"})
 *
 * @ORM\Table(name="theme")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\ThemeRepository")
 */
class Theme
{
    /**
     * @var int
     * @Groups({"theme_read"})
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups({"seance_read" ,"user_read"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     * @Groups({"theme_read", "theme_write", "user_read", "seance_read", "seance_write"})
     */
    private $name;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     * @Groups({"theme_read", "seance_read","user_read"})
     */
    private $createdAt;
    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     * @Groups({"theme_read" , "seance_read","user_read"})
     */
    private $updatedAt;

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="Block", inversedBy="theme", cascade={"persist"})
     * @ORM\JoinTable(name="theme_has_block",
     *   joinColumns={
     *     @ORM\JoinColumn(name="theme_id", referencedColumnName="id", onDelete="CASCADE")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="block_id", referencedColumnName="id", onDelete="CASCADE")
     *   }
     * )
     */
    private $block;

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="Seance", inversedBy="theme", cascade={"persist"})
     * @ORM\JoinTable(name="theme_has_seance",
     *   joinColumns={
     *     @ORM\JoinColumn(name="theme_id", referencedColumnName="id", onDelete="CASCADE")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="seance_id", referencedColumnName="id", onDelete="CASCADE")
     *   }
     * )
     */
    private $seance;

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="User", mappedBy="userTheme", cascade={"persist"})
     */
    private $user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->block = new \Doctrine\Common\Collections\ArrayCollection();
        $this->seance = new \Doctrine\Common\Collections\ArrayCollection();
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

    public function setName(string $name): self
    {
        $this->name = $name;

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
     * @return Collection|Seance[]
     */
    public function getSeance(): Collection
    {
        return $this->seance;
    }

    public function addSeance(Seance $seance): self
    {
        if (!$this->seance->contains($seance)) {
            $this->seance[] = $seance;
        }

        return $this;
    }

    public function removeSeance(Seance $seance): self
    {
        if ($this->seance->contains($seance)) {
            $this->seance->removeElement($seance);
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
            $user->addUserTheme($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->user->contains($user)) {
            $this->user->removeElement($user);
            $user->removeUserTheme($this);
        }

        return $this;
    }

}
