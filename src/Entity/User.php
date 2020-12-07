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
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Serializer\Annotation\Groups;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * User
 *
 * @ApiResource(
 *     attributes={
 *      "force_eager"=false,
 *      "normalization_context"={"groups"={"user_read"},  "enable_max_depth"=true},
 *      "denormalization_context"={"groups"={"user_write"}}
 *     }
 * )
 * @ApiFilter(SearchFilter::class, properties={"email": "exact"})
 * @ApiFilter(BooleanFilter::class, properties={"enabled"})
 * @ApiFilter(OrderFilter::class, properties={"id"}, arguments={"orderParameterName"="order"})
 *
 * @UniqueEntity(
 *     fields= {"username" , "email" },
 *     errorPath = "" ,
 *     message="L'adresse email est déja utilisé"
 * )
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @ApiProperty(identifier=true)
     * @Groups({"user_read", "seance_read"})
     */
    protected $id;

    /**
     * @Groups({"user_read", "user_write"})
     */
    protected $username;

    /**
     * @Groups({"user_read", "user_write"})
     */
    protected $email;

    /**
     * @Groups({"user_write"})
     */
    protected $plainPassword;

    /**
     * @Groups({"user_read", "user_write"})
     * @todo: to remove in prod
     */
    protected $enabled;

    /**
     * @var array
     * override of fosuser
     * @Groups({"user_read", "user_write"})
     */
    protected $roles;

    /**
     * @var string|null
     *
     * @ORM\Column(name="lastname", type="string", length=45, nullable=true, options={"default"="NULL"})
     * @Groups({"user_read", "user_write"})
     */
    private $lastname;

    /**
     * @var string|null
     *
     * @ORM\Column(name="firstname", type="string", length=45, nullable=true, options={"default"="NULL"})
     * @Groups({"user_read", "user_write"})
     */
    private $firstname;

    /**
     * @var int|null
     *
     * @ORM\Column(name="age", type="integer", nullable=true, options={"default"="NULL","unsigned"=true})
     * @Groups({"user_read", "user_write"})
     */
    private $age;

    /**
     * @var string|null
     *
     * @ORM\Column(name="gender", type="string", length=45, nullable=true, options={"default"="NULL"})
     * @Groups({"user_read", "user_write"})
     */
    private $gender;

    /**
     * @var int|null
     *
     * @ORM\Column(name="region", type="integer", nullable=true, options={"default"="NULL"})
     * @Groups({"user_read", "user_write"})
     */
    private $region;

    /**
     * @var boolean
     *
     * @ORM\Column(name="newsletter", type="boolean", nullable=true, options={"default"=false})
     * @Groups({"user_read", "user_write"})
     */
    private $newsletter;

    /**
     * @var string|null
     *
     * @ORM\Column(name="note", type="text", length=255, nullable=true, options={"default"="NULL"})
     * @Groups({"user_read", "user_write"})
     */
    private $note;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     * @Groups({"user_read"})
     */
    private $createdAt;
    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     * @Groups({"user_read"})
     */
    private $updatedAt;


    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="UserHasSeance", mappedBy="user", cascade={"persist"})
     * @Groups({"user_read" })
     */
    private $seance;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="UserHasProgram", mappedBy="user", cascade={"persist"})
     * @Groups({"user_read" })
     */
    private $program;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Theme", inversedBy="user", cascade={"persist"})
     * @ORM\JoinTable(name="user_has_theme",
     *   joinColumns={
     *     @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="user_theme_id", referencedColumnName="id", onDelete="CASCADE")
     *   }
     * )
     * @Groups({"user_read","user_write"})
     */
    private $userTheme;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->seance = new \Doctrine\Common\Collections\ArrayCollection();
        $this->program = new \Doctrine\Common\Collections\ArrayCollection();
        $this->userTheme = new \Doctrine\Common\Collections\ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getRegion(): ?int
    {
        return $this->region;
    }

    public function setRegion(?int $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getNewsletter(): ?bool
    {
        return $this->newsletter;
    }

    public function setNewsletter(?bool $newsletter): self
    {
        $this->newsletter = $newsletter;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): self
    {
        $this->note = $note;

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
     * @return Collection|Program[]
     */
    public function getProgram(): Collection
    {
        return $this->program;
    }

    public function addProgram(Program $program): self
    {
        if (!$this->program->contains($program)) {
            $this->program[] = $program;
        }

        return $this;
    }

    public function removeProgram(Program $program): self
    {
        if ($this->program->contains($program)) {
            $this->program->removeElement($program);
        }

        return $this;
    }

    /**
     * @return Collection|Theme[]
     */
    public function getUserTheme(): Collection
    {
        return $this->userTheme;
    }

    public function addUserTheme(Theme $userTheme): self
    {
        if (!$this->userTheme->contains($userTheme)) {
            $this->userTheme[] = $userTheme;
        }

        return $this;
    }

    public function removeUserTheme(Theme $userTheme): self
    {
        if ($this->userTheme->contains($userTheme)) {
            $this->userTheme->removeElement($userTheme);
        }

        return $this;
    }

}