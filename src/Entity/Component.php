<?php

namespace App\Entity;

use App\Repository\ComponentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ComponentRepository::class)]
class Component
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\ManyToOne(targetEntity: CrafterComponent::class, inversedBy: 'component')]
    private $crafterComponent;

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

    public function getCrafterComponent(): ?CrafterComponent
    {
        return $this->crafterComponent;
    }

    public function setCrafterComponent(?CrafterComponent $crafterComponent): self
    {
        $this->crafterComponent = $crafterComponent;

        return $this;
    }
}
