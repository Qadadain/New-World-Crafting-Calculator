<?php

namespace App\Entity;

use App\Repository\ComponentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use JetBrains\PhpStorm\Pure;

#[ORM\Entity(repositoryClass: ComponentRepository::class)]
#[Vich\Uploadable]
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

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     */
    #[Vich\UploadableField(mapping: 'image_composants', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;


    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

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
        return $this->name;
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
