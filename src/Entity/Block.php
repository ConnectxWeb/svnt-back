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

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiFilter;

/**
 * Block
 ** @ApiResource(attributes={
 *     "normalization_context"={"groups"={"block_read"}},
 *     "denormalization_context"={"groups"={"block_write"}}
 * })
 * @ApiFilter(SearchFilter::class, properties={"type": "exact" , "seance.id" :"exact","theme" :"exact"})
 * @ORM\Table(name="block")
 * @ORM\Entity
 */
class Block
{

    const TYPE_FICHE = 'FICHE';
    const TYPE_VIDEO = 'VIDEO';
    const TYPE_AUDIO = 'AUDIO';
    const TYPE_ARTICLE = 'ARTICLE';
    const TYPE_PRODUCT = 'PRODUCT';
    const TYPE_THERAPY = 'THERAPY';
    const TYPE_FOLLOW = 'FOLLOW';
    const TYPE_FOCUS = 'FOCUS';
    const TYPE_CHALLENGE = 'CHALLENGE';

    const ATTRIBUTE_NAME = 'NAME';
    const ATTRIBUTE_LINK = 'LINK';
    const ATTRIBUTE_DESCRIPTION = 'DESCRIPTION';
    const ATTRIBUTE_IMAGE = 'IMAGE';
    const ATTRIBUTE_EDITOR = 'EDITOR';

    /**
     * @var int
     * @Groups({"block_read", "seance_read"})
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     * @Groups({"block_read", "block_write","seance_read","seance_write"})
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     */
    private $type;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * @Groups({"block_read"})
     * @ORM\ManyToMany(targetEntity="Seance", mappedBy="block", cascade={"persist"})
     */
    private $seance;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * @Groups({"block_read", "block_write" ,"seance_read","seance_write"})
     * @ORM\ManyToMany(targetEntity="Theme", mappedBy="block", cascade={"persist"})
     */
    private $theme;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * @Groups({"block_read" , "block_write","seance_read","seance_write"})
     * @ORM\ManyToMany(targetEntity="BlockAttribute", inversedBy="block", cascade={"persist"})
     * @ORM\JoinTable(name="block_has_attribute",
     *   joinColumns={
     *     @ORM\JoinColumn(name="block_id", referencedColumnName="id", onDelete="CASCADE")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="block_attribute_id", referencedColumnName="id", onDelete="CASCADE")
     *   }
     * )
     */
    private $blockAttribute;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->seance = new \Doctrine\Common\Collections\ArrayCollection();
        $this->theme = new \Doctrine\Common\Collections\ArrayCollection();
        $this->blockAttribute = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        if (!in_array($type, array(
            self::TYPE_FICHE,
            self::TYPE_VIDEO,
            self::TYPE_AUDIO,
            self::TYPE_ARTICLE,
            self::TYPE_PRODUCT,
            self::TYPE_THERAPY,
            self::TYPE_FOLLOW,
            self::TYPE_FOCUS,
            self::TYPE_CHALLENGE
        ))) {
            throw new \InvalidArgumentException("Invalid type of block");
        }
        $this->type = $type;

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
            $seance->addBlock($this);
        }

        return $this;
    }

    public function removeSeance(Seance $seance): self
    {
        if ($this->seance->contains($seance)) {
            $this->seance->removeElement($seance);
            $seance->removeBlock($this);
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
            $theme->addBlock($this);
        }

        return $this;
    }

    public function removeTheme(Theme $theme): self
    {
        if ($this->theme->contains($theme)) {
            $this->theme->removeElement($theme);
            $theme->removeBlock($this);
        }

        return $this;
    }

    /**
     * @return Collection|BlockAttribute[]
     */
    public function getBlockAttribute(): Collection
    {
        return $this->blockAttribute;
    }

    public function addBlockAttribute(BlockAttribute $blockAttribute): self
    {
        if (!$this->blockAttribute->contains($blockAttribute)) {
            $this->blockAttribute[] = $blockAttribute;
        }

        return $this;
    }

    public function removeBlockAttribute(BlockAttribute $blockAttribute): self
    {
        if ($this->blockAttribute->contains($blockAttribute)) {
            $this->blockAttribute->removeElement($blockAttribute);
        }

        return $this;
    }

}
