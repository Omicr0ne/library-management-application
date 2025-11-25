<?php

namespace App\Entity;

use App\Repository\OuvrageRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private ?string $editeur = null;

    #[ORM\Column(length: 20)]
    #[Assert\Range(min: 8, max: 13,)]    // Verifie que la valeur entière se trouve entre 8 et 13
    private ?string $IsbnIssn = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $categories = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tags = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $langues = null;

    #[ORM\Column(length: 10)]
    #[Assert\NotBlank]
    private ?string $annee = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $resume = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?\DateTimeImmutable $createdAt = null;

    /**
     * @var Collection<int, Exemplaire>
     */
    #[ORM\OneToMany(targetEntity: Exemplaire::class, mappedBy: 'ouvrage')]
    private Collection $exemplaires;

    /**
     * @var Collection<int, Reservation>
     */
    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'ouvrage')]
    private Collection $reservations;

    // Constructeur
    public function __construct()
    {
        $this->createdAt = new DateTimeImmutable();
        $this->exemplaires = new ArrayCollection();
        $this->reservations = new ArrayCollection();
    }

    // Getters/setters
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

    public function getediteur(): ?string
    {
        return $this->editeur;
    }

    public function setediteur(string $editeur): static
    {
        $this->editeur = $editeur;

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

    public function getCategories(): ?string
    {
        return $this->categories;
    }

    public function setCategories(string $categories): static
    {
        $this->categories = $categories;

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

    public function getAnnee(): ?string
    {
        return $this->annee;
    }

    public function setAnnee(string $annee): static
    {
        $this->annee = $annee;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(?string $resume): static
    {
        $this->resume = $resume;

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

    /**
     * @return Collection<int, Exemplaire>
     */
    public function getExemplaires(): Collection
    {
        return $this->exemplaires;
    }

    public function addExemplaire(Exemplaire $exemplaire): static
    {
        if (!$this->exemplaires->contains($exemplaire)) {
            $this->exemplaires->add($exemplaire);
            $exemplaire->setOuvrage($this);
        }

        return $this;
    }

    public function removeExemplaire(Exemplaire $exemplaire): static
    {
        if ($this->exemplaires->removeElement($exemplaire)) {
            // set the owning side to null (unless already changed)
            if ($exemplaire->getOuvrage() === $this) {
                $exemplaire->setOuvrage(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setOuvrage($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getOuvrage() === $this) {
                $reservation->setOuvrage(null);
            }
        }

        return $this;
    }
}
