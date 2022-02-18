<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecipeRepository::class)]
class Recipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToOne(inversedBy: 'recipe', targetEntity: Component::class, cascade: ['persist', 'remove'])]
    private $ingredient;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'recipe', targetEntity: StepRecipe::class,  cascade: ['persist', 'remove'])]
    private $stepsRecipe;

    #[ORM\Column(type: 'string', length: 255)]
    private $slug;

    public function __construct()
    {
        $this->stepsRecipe = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIngredient(): ?Component
    {
        return $this->ingredient;
    }

    public function setIngredient(?Component $ingredient): self
    {
        $this->ingredient = $ingredient;

        return $this;
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

    /**
     * @return Collection|StepRecipe[]
     */
    public function getStepsRecipe(): Collection
    {
        return $this->stepsRecipe;
    }

    public function addStepsRecipe(StepRecipe $stepsRecipe): self
    {
        if (!$this->stepsRecipe->contains($stepsRecipe)) {
            $this->stepsRecipe[] = $stepsRecipe;
            $stepsRecipe->setRecipe($this);
        }

        return $this;
    }

    public function removeStepsRecipe(StepRecipe $stepsRecipe): self
    {
        if ($this->stepsRecipe->removeElement($stepsRecipe)) {
            // set the owning side to null (unless already changed)
            if ($stepsRecipe->getRecipe() === $this) {
                $stepsRecipe->setRecipe(null);
            }
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
