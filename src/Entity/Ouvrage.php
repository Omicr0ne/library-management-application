<?php

namespace App\Entity;

use App\Repository\OuvrageRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: OuvrageRepository::class)]
class Ouvrage
{
    #[ORM\Id]               // Pas d'assert sur l'id
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    #[Assert\NotBlank()]            // Verification que le champ est non Null et non vide
    private ?string $titre = null;

    #[ORM\Column(length: 60)]
    #[Assert\NotBlank]
    private ?string $auteurs = null;

    #[ORM\Column(length: 60)]
    #[Assert\NotBlank]
    private ?string $éditeur = null;    // Ne pas mettre d'accents la prochaine fois

    #[ORM\Column(length: 20)]
    #[Assert\Range(min: 8, max: 13,)]    // Verifie que la valeur entière se trouve entre 8 et 13
    private ?string $IsbnIssn = null;

    #[ORM\Column(length: 255)]
    private ?string $catégories = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tags = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $langues = null;

    #[ORM\Column(length: 10)]
    #[Assert\NotBlank]
    private ?string $année = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $résumé = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?\DateTimeImmutable $createdAt = null;

    // Constructeur
    public function __construct()
    {
        $this->createdAt = new DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getAuteurs(): ?string
    {
        return $this->auteurs;
    }

    public function setAuteurs(string $auteurs): static
    {
        $this->auteurs = $auteurs;

        return $this;
    }

    public function getéditeur(): ?string
    {
        return $this->éditeur;
    }

    public function setéditeur(string $éditeur): static
    {
        $this->éditeur = $éditeur;

        return $this;
    }

    public function getIsbnIssn(): ?string
    {
        return $this->IsbnIssn;
    }

    public function setIsbnIssn(string $IsbnIssn): static
    {
        $this->IsbnIssn = $IsbnIssn;

        return $this;
    }

    public function getCatégories(): ?string
    {
        return $this->catégories;
    }

    public function setCatégories(string $catégories): static
    {
        $this->catégories = $catégories;

        return $this;
    }

    public function getTags(): ?string
    {
        return $this->tags;
    }

    public function setTags(?string $tags): static
    {
        $this->tags = $tags;

        return $this;
    }

    public function getLangues(): ?string
    {
        return $this->langues;
    }

    public function setLangues(string $langues): static
    {
        $this->langues = $langues;

        return $this;
    }

    public function getAnnée(): ?string
    {
        return $this->année;
    }

    public function setAnnée(string $année): static
    {
        $this->année = $année;

        return $this;
    }

    public function getRésumé(): ?string
    {
        return $this->résumé;
    }

    public function setRésumé(?string $résumé): static
    {
        $this->résumé = $résumé;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
