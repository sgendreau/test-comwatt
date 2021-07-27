<?php

namespace App\Entity;

use App\Helper\Orm\IdTrait;
use App\Helper\Orm\TimestampableTrait;
use App\Repository\PaysRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Entity(repositoryClass=PaysRepository::class)
 * @UniqueEntity( 
 *   fields={"alpha3"}
 * ) 
 */
class Pays
{

    const FRANCE_UUID = 'd45a35d0-9e55-4f69-bc75-0c9bc12c67ce';

    use IdTrait;
    use TimestampableTrait;

    /**
     * @ORM\Column(type="string", length=3, unique=true)
     */
    private $alpha3;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nomFr;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nomUk;

    /**
     * @ORM\OneToMany(targetEntity=Produit::class, mappedBy="nationalite")
     */
    private $produits;

    public function __construct()
    {
        $this->uuid = Uuid::v4();
        $this->produits = new ArrayCollection();
    }

    public function getAlpha3(): ?string
    {
        return $this->alpha3;
    }

    public function setAlpha3(string $alpha3): self
    {
        $this->alpha3 = $alpha3;

        return $this;
    }

    public function getNomFr(): ?string
    {
        return $this->nomFr;
    }

    public function setNomFr(string $nomFr): self
    {
        $this->nomFr = $nomFr;

        return $this;
    }

    public function getNomUk(): ?string
    {
        return $this->nomUk;
    }

    public function setNomUk(string $nomUk): self
    {
        $this->nomUk = $nomUk;

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
            $produit->setNationalite($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getNationalite() === $this) {
                $produit->setNationalite(null);
            }
        }

        return $this;
    }
}
