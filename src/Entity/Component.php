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

    #[ORM\ManyToOne(targetEntity: TradeSkill::class, inversedBy: 'components')]
    private $tradeSkill;

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

    public function getTradeSkill(): ?TradeSkill
    {
        return $this->tradeSkill;
    }

    public function setTradeSkill(?TradeSkill $tradeSkill): self
    {
        $this->tradeSkill = $tradeSkill;

        return $this;
    }
}
