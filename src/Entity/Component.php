<?php

namespace App\Entity;

use App\Repository\ComponentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

#[ORM\Entity(repositoryClass: ComponentRepository::class)]
class Component
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\ManyToOne(targetEntity: TradeSkill::class, inversedBy: 'components')]
    private $tradeSkill;

    #[ORM\OneToOne(mappedBy: 'ingredient', targetEntity: Recipe::class, cascade: ['persist', 'remove'])]
    private $recipe;

    #[ORM\OneToMany(mappedBy: 'ingredient', targetEntity: StepRecipe::class)]
    private $stepRecipes;

    #[ORM\Column(type: 'string', length: 255)]
    private $slug;

    public function __construct()
    {
        $this->stepRecipes = new ArrayCollection();
    }

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

    #[Pure] public function __toString()
    {
        return $this->getName();
    }


    public function getTradeSkill(): ?TradeSkill
    {
        return $this->tradeSkill;
    }

    public function setTradeSkill(?TradeSkill $tradeSkill): self
    {
        $this->tradeSkill = $tradeSkill;

        return $this;
    }

    public function getRecipe(): ?Recipe
    {
        return $this->recipe;
    }

    public function setRecipe(?Recipe $recipe): self
    {
        // unset the owning side of the relation if necessary
        if ($recipe === null && $this->recipe !== null) {
            $this->recipe->setIngredient(null);
        }

        // set the owning side of the relation if necessary
        if ($recipe !== null && $recipe->getIngredient() !== $this) {
            $recipe->setIngredient($this);
        }

        $this->recipe = $recipe;

        return $this;
    }

    /**
     * @return Collection|StepRecipe[]
     */
    public function getStepRecipes(): Collection
    {
        return $this->stepRecipes;
    }

    public function addStepRecipe(StepRecipe $stepRecipe): self
    {
        if (!$this->stepRecipes->contains($stepRecipe)) {
            $this->stepRecipes[] = $stepRecipe;
            $stepRecipe->setIngredient($this);
        }

        return $this;
    }

    public function removeStepRecipe(StepRecipe $stepRecipe): self
    {
        if ($this->stepRecipes->removeElement($stepRecipe)) {
            // set the owning side to null (unless already changed)
            if ($stepRecipe->getIngredient() === $this) {
                $stepRecipe->setIngredient(null);
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
