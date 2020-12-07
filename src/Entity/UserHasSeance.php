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


use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Gedmo\Mapping\Annotation as Gedmo;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\NumericFilter;
use ApiPlatform\Core\Annotation\ApiFilter;

/**
 * UserHasSeance
 *
 * @ApiResource(
 *     attributes={
 *      "normalization_context"={"groups"={"user_has_seance_read"}},
 *      "denormalization_context"={"groups"={"user_has_seance_write"}}
 *     }
 * )
 * @ApiFilter(NumericFilter::class, properties={"seance.id": "exact", "user.id": "exact"})
 *
 * @ORM\Table(name="user_has_seance", indexes={@ORM\Index(name="fk_user_has_program_seance1_idx", columns={"seance_id"}), @ORM\Index(name="fk_user_has_program_user1_idx", columns={"user_id"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\UserHasSeanceRepository")
 */
class UserHasSeance
{
    /**
     * @var \DateTime|null
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var Seance
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     *
     * @Groups({"user_has_seance_read", "user_has_seance_write", "user_read"})
     *
     * @ORM\ManyToOne(targetEntity="Seance", inversedBy="user", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="seance_id", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    private $seance;

    /**
     * @var User
     *
     * @Groups({"user_has_seance_read", "user_has_seance_write", "user_read","seance_read"})
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="User", inversedBy="seance", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    private $user;

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getSeance(): ?Seance
    {
        return $this->seance;
    }

    public function setSeance(?Seance $seance): self
    {
        $this->seance = $seance;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
