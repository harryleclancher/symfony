<?php

namespace App\Entity;

use App\Repository\LivresRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'i23_Livres')]
#[ORM\Entity(repositoryClass: LivresRepository::class)]
class Livres
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200)]
    #[Assert\NoBlank]
    private ?string $Libelle = null;

    #[ORM\Column]
    #[Assert\Range(
        minMessage : "Impossible d'avoir un prix aussi bas, pense bénéfice",
        min: 0.99,
    )]
    private ?float $prix_unitaire = null;

    #[ORM\Column]
    #[Assert\Range(
        minMessage : "Impossible d'avoir une quantité nulle ou négative",
        min: 1,
    )]
    private ?int $quantite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->Libelle;
    }

    public function setLibelle(string $Libelle): self
    {
        $this->Libelle = $Libelle;

        return $this;
    }

    public function getPrixUnitaire(): ?float
    {
        return $this->prix_unitaire;
    }

    public function setPrixUnitaire(float $prix_unitaire): self
    {
        $this->prix_unitaire = $prix_unitaire;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }
}
