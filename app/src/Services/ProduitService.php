<?php

namespace App\Services;

use App\Entity\Produit;

class ProduitService {

    public function transformProduit(Produit $produit): array
    {
        return [
            'uuid' => (string) $produit->getUuid(),
            'title' => $produit->getTitre(),
            'country' => $produit->getNationalite()->getAlpha3(),
            'year' => $produit->getAnneeEdition(),
            'original_title' => $produit->getTitreOriginal(),
            'description' => $produit->getDescription(),
            'genres' => $produit->getGenresLibelle(),
            'ranking' => $produit->getNote(),
            'price' => $produit->getPrix(),
            'product_type' => $produit->getTypeProduitLibelle()
        ];
    }

    public function transformProduits(array $produits): array
    {
        $result = [];
        foreach($produits as $produit) {
            $result[] = $this->transformProduit($produit);
        }
        return $result;
    }
}