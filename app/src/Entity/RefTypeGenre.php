<?php

namespace App\Entity;

use App\Helper\Orm\IdTrait;
use App\Helper\Orm\LibelleTrait;
use App\Helper\Orm\TimestampableTrait;
use App\Repository\RefTypeGenreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Entity(repositoryClass=RefTypeGenreRepository::class)
 */
class RefTypeGenre
{
    use IdTrait;
    use LibelleTrait;
    use TimestampableTrait;

    /**
     * @ORM\ManyToOne(targetEntity=RefTypeGenre::class, inversedBy="refTypeGenres")
     */
    private $genreParent;

    /**
     * @ORM\OneToMany(targetEntity=RefTypeGenre::class, mappedBy="genreParent")
     */
    private $refTypeGenres;

    /**
     * @ORM\ManyToMany(targetEntity=Produit::class, mappedBy="genres")
     */
    private $produits;

    public function __construct()
    {
        $this->uuid = Uuid::v4();
        $this->refTypeGenres = new ArrayCollection();
        $this->produits = new ArrayCollection();
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
