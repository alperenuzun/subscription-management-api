<?php

namespace App\Entity;

use App\Repository\ApplicationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ApplicationRepository::class)
 */
class Application
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $googleUser;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $googlePassword;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $iosUser;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $iosPassword;

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

    public function getGoogleUser(): ?string
    {
        return $this->googleUser;
    }

    public function setGoogleUser(string $googleUser): self
    {
        $this->googleUser = $googleUser;

        return $this;
    }

    public function getGooglePassword(): ?string
    {
        return $this->googlePassword;
    }

    public function setGooglePassword(string $googlePassword): self
    {
        $this->googlePassword = $googlePassword;

        return $this;
    }

    public function getIosUser(): ?string
    {
        return $this->iosUser;
    }

    public function setIosUser(string $iosUser): self
    {
        $this->iosUser = $iosUser;

        return $this;
    }

    public function getIosPassword(): ?string
    {
        return $this->iosPassword;
    }

    public function setIosPassword(string $iosPassword): self
    {
        $this->iosPassword = $iosPassword;

        return $this;
    }
}
