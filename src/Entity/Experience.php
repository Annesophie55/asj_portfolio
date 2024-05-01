<?php

namespace App\Entity;

use App\Repository\ExperienceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExperienceRepository::class)]
class Experience
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column(length: 255)]
    private ?string $place = null;

    #[ORM\Column(length: 255)]
    private ?string $dateOfExp = null;

    #[ORM\Column(length: 255)]
    private ?string $role = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    /**
     * @var Collection<int, Technology>
     */
    #[ORM\ManyToMany(targetEntity: Technology::class, inversedBy: 'experiences')]
    private Collection $Technologies;

    public function __construct()
    {
        $this->Technologies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function setPlace(string $place): static
    {
        $this->place = $place;

        return $this;
    }

    public function getDateOfExp(): ?string
    {
        return $this->dateOfExp;
    }

    public function setDateOfExp(string $dateOfExp): static
    {
        $this->dateOfExp = $dateOfExp;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Technology>
     */
    public function getTechnologies(): Collection
    {
        return $this->Technologies;
    }

    public function addTechnology(Technology $technology): static
    {
        if (!$this->Technologies->contains($technology)) {
            $this->Technologies->add($technology);
        }

        return $this;
    }

    public function removeTechnology(Technology $technology): static
    {
        $this->Technologies->removeElement($technology);

        return $this;
    }
}
