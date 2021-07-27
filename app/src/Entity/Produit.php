<?php

namespace App\Entity;

use App\Helper\Orm\IdTrait;
use App\Helper\Orm\TimestampableTrait;
use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 */
class Produit
{
    use IdTrait;
    use TimestampableTrait;

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
     * @ORM\ManyToOne(targetEntity=RefTypeProduit::class, inversedBy="produits")
     * @ORM\JoinColumn(nullable=false, name="type_produit")
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
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $deletedAt;

    public function __construct()
    {
        $this->uuid = Uuid::v4();
        $this->genres = new ArrayCollection();
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

    public function getGenresLibelle(): string
    {
        return implode( ' ', $this->getGenres()->map(fn ($genre) => $genre->getLibelle())->toArray());
    }

    public function getTypeProduit(): ?RefTypeProduit
    {
        return $this->typeProduit;
    }

    public function setTypeProduit(RefTypeProduit $typeProduit): self
    {
        $this->typeProduit = $typeProduit;

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
