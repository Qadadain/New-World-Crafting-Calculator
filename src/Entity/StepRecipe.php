<?php

namespace App\Entity;

use App\Repository\StepRecipeRepository;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

#[ORM\Entity(repositoryClass: StepRecipeRepository::class)]
class StepRecipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Recipe::class, inversedBy: 'stepsRecipe')]
    private $recipe;

    #[ORM\ManyToOne(targetEntity: Component::class, inversedBy: 'stepRecipes')]
    private $ingredient;

    #[ORM\Column(type: 'integer')]
    private $quantity;

    public function __toString(): string
    {
       return $this->getIngredient()->getName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecipe(): ?Recipe
    {
        return $this->recipe;
    }

    public function setRecipe(?Recipe $recipe): self
    {
        $this->recipe = $recipe;

        return $this;
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

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }
}
