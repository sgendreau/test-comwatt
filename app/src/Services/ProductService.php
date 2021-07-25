<?php

namespace App\Services;

use App\Entity\Produit;

class ProductService {

    public function transformProduct(Produit $produit): array
    {
        return [
            'uuid' => (string) $produit->getUuid(),
            'title' => $produit->getTitre(),
            'country' => $produit->getNationalite()->getAlpha3(),
            'country_libelle' => $produit->getNationalite()->getNomFr(),
            'year' => $produit->getAnneeEdition(),
            'original_title' => $produit->getTitreOriginal(),
            'description' => $produit->getDescription(),
            'genres' => $produit->getGenresLibelle(),
            'ranking' => $produit->getNote(),
            'price' => $produit->getPrix(),
            'product_type' => $produit->getTypeProduitLibelle()
        ];
    }

    public function transformProducts(array $produits): array
    {
        $result = [];
        foreach($produits as $produit) {
            $result[] = $this->transformProduct($produit);
        }
        return $result;
    }
}