<?php

namespace App\Entity;

use App\Repository\MultiplicatorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MultiplicatorRepository::class)]
class Multiplicator
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $multiplicator;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMultiplicator(): ?int
    {
        return $this->multiplicator;
    }

    public function setMultiplicator(int $multiplicator): self
    {
        $this->multiplicator = $multiplicator;

        return $this;
    }
}
