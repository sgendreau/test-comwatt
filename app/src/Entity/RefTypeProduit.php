<?php

namespace App\Entity;

use App\Helper\Orm\IdTrait;
use App\Helper\Orm\LibelleTrait;
use App\Helper\Orm\TimestampableTrait;
use App\Repository\RefTypeProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Entity(repositoryClass=RefTypeProduitRepository::class)
 */
class RefTypeProduit
{
    use IdTrait;
    use LibelleTrait;
    use TimestampableTrait;

    /**
     * @ORM\OneToMany(targetEntity=Produit::class, mappedBy="typeProduit")
     */
    private $produits;

    public function __construct()
    {
        $this->uuid = Uuid::v4();
        $this->produits = new ArrayCollection();
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
            $produit->setTypeProduit($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->removeElement($produit)) {
            $produit->removeTypeProduit($this);
        }

        return $this;
    }
}
