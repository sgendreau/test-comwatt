<?php

namespace App\Entity;

use App\Repository\RefTypeGenreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=RefTypeGenreRepository::class)
 */
class RefTypeGenre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity=RefTypeGenre::class, inversedBy="refTypeGenres")
     */
    private $genreParent;

    /**
     * @ORM\OneToMany(targetEntity=RefTypeGenre::class, mappedBy="genreParent")
     */
    private $refTypeGenres;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     * @Gedmo\Timestampable(on="update")
     */
    private $updateAt;

    /**
     * @ORM\ManyToMany(targetEntity=Produit::class, mappedBy="genres")
     */
    private $produits;

    public function __construct()
    {
        $this->refTypeGenres = new ArrayCollection();
        $this->produits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

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

    public function getGenreParent(): ?self
    {
        return $this->genreParent;
    }

    public function setGenreParent(?self $genreParent): self
    {
        $this->genreParent = $genreParent;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getRefTypeGenres(): Collection
    {
        return $this->refTypeGenres;
    }

    public function addRefTypeGenre(self $refTypeGenre): self
    {
        if (!$this->refTypeGenres->contains($refTypeGenre)) {
            $this->refTypeGenres[] = $refTypeGenre;
            $refTypeGenre->setGenreParent($this);
        }

        return $this;
    }

    public function removeRefTypeGenre(self $refTypeGenre): self
    {
        if ($this->refTypeGenres->removeElement($refTypeGenre)) {
            // set the owning side to null (unless already changed)
            if ($refTypeGenre->getGenreParent() === $this) {
                $refTypeGenre->setGenreParent(null);
            }
        }

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

    public function getUpdateAt(): ?\DateTimeImmutable
    {
        return $this->updateAt;
    }

    public function setUpdateAt(?\DateTimeImmutable $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
            $produit->addGenre($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->removeElement($produit)) {
            $produit->removeGenre($this);
        }

        return $this;
    }
}
