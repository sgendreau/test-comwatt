<?php

namespace App\Services;

use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;

class ProductService {

    public function __construct(protected EntityManagerInterface $entityManager) {

    }

    public function create(Produit $product): void
    {
        $this->entityManager->persist($product);
        $this->update();
    }

    public function update(): void
    {
        $this->entityManager->flush();
    }

    public function delete(Produit $product): void
    {
        $this->entityManager->remove($product);
        $this->update();
    }

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
            'product_type' => $produit->getTypeProduit()->getLibelle()
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