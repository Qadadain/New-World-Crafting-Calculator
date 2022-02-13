<?php

namespace App\Entity;

use App\Repository\TradeSkillTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TradeSkillTypeRepository::class)]
class TradeSkillType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'type', targetEntity: TradeSkill::class)]
    private $tradeSkills;

    public function __construct()
    {
        $this->tradeSkills = new ArrayCollection();
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

    /**
     * @return Collection|TradeSkill[]
     */
    public function getTradeSkills(): Collection
    {
        return $this->tradeSkills;
    }

    public function addTradeSkill(TradeSkill $tradeSkill): self
    {
        if (!$this->tradeSkills->contains($tradeSkill)) {
            $this->tradeSkills[] = $tradeSkill;
            $tradeSkill->setType($this);
        }

        return $this;
    }

    public function removeTradeSkill(TradeSkill $tradeSkill): self
    {
        if ($this->tradeSkills->removeElement($tradeSkill)) {
            // set the owning side to null (unless already changed)
            if ($tradeSkill->getType() === $this) {
                $tradeSkill->setType(null);
            }
        }

        return $this;
    }
}
