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
use App\Service\Generic\Entity\EntityBaseTrait;
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
 *      "normalization_context"={"groups"={"user:read"}, "enable_max_depth"=true},
 *      "denormalization_context"={"groups"={"user:write"}}
 *     }
 * )
 * @ApiFilter(SearchFilter::class, properties={"email": "exact"})
 * @ApiFilter(BooleanFilter::class, properties={"enabled"})
 *
 * @UniqueEntity(
 *     fields= {"username", "email"},
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
    use EntityBaseTrait;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @ApiProperty(identifier=true)
     * @Groups({"user:read"})
     */
    protected $id;

    /**
     * @Groups({"user:read", "user:write"})
     */
    protected $username;

    /**
     * @Groups({"user:read", "user:write"})
     */
    protected $email;

    /**
     * @Groups({"user:write"})
     */
    protected $plainPassword;

    /**
     * @Groups({"user:read"})
     */
    protected $enabled;

    /**
     * @var array
     * override of fosuser
     * @Groups({"user:read", "user:write"})
     */
    protected $roles;

    /**
     * @var string|null
     *
     * @ORM\Column(name="lastname", type="string", length=45, nullable=true, options={"default"="NULL"})
     * @Groups({"user:read", "user:write"})
     */
    private $lastname;

    /**
     * @var string|null
     *
     * @ORM\Column(name="firstname", type="string", length=45, nullable=true, options={"default"="NULL"})
     * @Groups({"user:read", "user:write"})
     */
    private $firstname;

    /**
     * @var int|null
     *
     * @ORM\Column(name="age", type="integer", nullable=true, options={"default"="NULL","unsigned"=true})
     * @Groups({"user:read", "user:write"})
     */
    private $age;

    /**
     * @var string|null
     *
     * @ORM\Column(name="gender", type="string", length=45, nullable=true, options={"default"="NULL"})
     * @Groups({"user:read", "user:write"})
     */
    private $gender;

    /**
     * @var int|null
     *
     * @ORM\Column(name="region", type="integer", nullable=true, options={"default"="NULL"})
     * @Groups({"user:read", "user:write"})
     */
    private $region;

    /**
     * @var boolean
     *
     * @ORM\Column(name="newsletter", type="boolean", nullable=true, options={"default"=false})
     * @Groups({"user:read", "user:write"})
     */
    private $newsletter;


    public function __construct()
    {
        parent::__construct();
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
}