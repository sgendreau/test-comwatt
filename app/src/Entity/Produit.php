<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 */
class Produit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, name="title")
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, name="original_title")
     */
    private $titreOriginal;

    /**
     * @ORM\Column(type="integer", name="year")
     */
    private $anneeEdition;

    /**
     * @ORM\ManyToOne(targetEntity=Pays::class, inversedBy="produits")
     * @ORM\JoinColumn(nullable=false, name="country")
     */
    private $nationalite;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=RefTypeGenre::class, inversedBy="produits")
     */
    private $genres;

    /**
     * @ORM\ManyToMany(targetEntity=RefTypeProduit::class, inversedBy="produits")
     */
    private $typeProduit;

    /**
     * @ORM\Column(type="float", name="price")
     */
    private $prix;

    /**
     * @ORM\Column(type="integer", name="ranking")
     */
    private $note;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $deletedAt;

    public function __construct()
    {
        $this->genres = new ArrayCollection();
        $this->typeProduit = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getTitreOriginal(): ?string
    {
        return $this->titreOriginal;
    }

    public function setTitreOriginal(?string $titreOriginal): self
    {
        $this->titreOriginal = $titreOriginal;

        return $this;
    }

    public function getAnneeEdition(): ?int
    {
        return $this->anneeEdition;
    }

    public function setAnneeEdition(int $anneeEdition): self
    {
        $this->anneeEdition = $anneeEdition;

        return $this;
    }

    public function getNationalite(): ?Pays
    {
        return $this->nationalite;
    }

    public function setNationalite(?Pays $nationalite): self
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|RefTypeGenre[]
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(RefTypeGenre $genre): self
    {
        if (!$this->genres->contains($genre)) {
            $this->genres[] = $genre;
        }

        return $this;
    }

    public function removeGenre(RefTypeGenre $genre): self
    {
        $this->genres->removeElement($genre);

        return $this;
    }

    /**
     * @return Collection|RefTypeProduit[]
     */
    public function getTypeProduit(): Collection
    {
        return $this->typeProduit;
    }

    public function addTypeProduit(RefTypeProduit $typeProduit): self
    {
        if (!$this->typeProduit->contains($typeProduit)) {
            $this->typeProduit[] = $typeProduit;
        }

        return $this;
    }

    public function removeTypeProduit(RefTypeProduit $typeProduit): self
    {
        $this->typeProduit->removeElement($typeProduit);

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getNote(): int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getDeletedAt(): ?\DateTimeImmutable
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?\DateTimeImmutable $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }
}
