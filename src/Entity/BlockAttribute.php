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

/**
 * Attribute
 *
 * * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"block_attribute_read"}},
 *     "denormalization_context"={"groups"={"block_attribute_write"}}
 * })
 * @ORM\Table(name="block_attribute")
 * @ORM\Entity
 */
class BlockAttribute
{
    /**
     * @var int
     * @Groups({"block_attribute_read" , "block_read"})
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     * @Groups({"block_attribute_read", "block_attribute_write","block_read", "block_write","seance_read","seance_write"})
     * @ORM\Column(name="name", type="string", length=45, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     * @Groups({"block_attribute_read" , "block_attribute_write" ,"block_read", "block_write","seance_read","seance_write"})
     * @ORM\Column(name="value", type="text", length=65535, nullable=true)
     */
    private $value;

    /**
     * @var Collection
     * @Groups({"block_attribute_read"})
     * @ORM\ManyToMany(targetEntity="Block", mappedBy="blockAttribute", cascade={"persist"})
     */
    private $block;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->block = new \Doctrine\Common\Collections\ArrayCollection();
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

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value): self
    {
        $this->value = $value;

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
            $block->addBlockAttribute($this);
        }

        return $this;
    }

    public function removeBlock(Block $block): self
    {
        if ($this->block->contains($block)) {
            $this->block->removeElement($block);
            $block->removeBlockAttribute($this);
        }

        return $this;
    }

}
