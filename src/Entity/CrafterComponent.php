<?php

namespace App\Entity;

use App\Repository\CrafterComponentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CrafterComponentRepository::class)]
class CrafterComponent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToMany(mappedBy: 'crafterComponent', targetEntity: Component::class)]
    private $component;

    #[ORM\ManyToOne(targetEntity: Multiplicator::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $multiplicator;

    public function __construct()
    {
        $this->component = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Component[]
     */
    public function getComponent(): Collection
    {
        return $this->component;
    }

    public function addComponent(Component $component): self
    {
        if (!$this->component->contains($component)) {
            $this->component[] = $component;
            $component->setCrafterComponent($this);
        }

        return $this;
    }

    public function removeComponent(Component $component): self
    {
        if ($this->component->removeElement($component)) {
            // set the owning side to null (unless already changed)
            if ($component->getCrafterComponent() === $this) {
                $component->setCrafterComponent(null);
            }
        }

        return $this;
    }

    public function getMultiplicator(): ?Multiplicator
    {
        return $this->multiplicator;
    }

    public function setMultiplicator(?Multiplicator $multiplicator): self
    {
        $this->multiplicator = $multiplicator;

        return $this;
    }
}
