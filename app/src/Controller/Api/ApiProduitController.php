<?php

namespace App\Controller\Api;

use App\Entity\Produit;
use App\Services\ProduitService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiProduitController extends AbstractController
{
    #[Route('/api/produits', name: 'api_produits')]
    public function getProduits(EntityManagerInterface $entityManager, ProduitService $produitService): Response
    {
        $produits = $entityManager->getRepository(Produit::class)->findAll();

        return new JsonResponse($produitService->transformProduits($produits));
    }

    #[Route('/api/produit/{uuidProduit}', name: 'api_produit')]
    public function getProduit(EntityManagerInterface $entityManager, ProduitService $produitService, $uuidProduit): Response
    {
        $produits = $entityManager->getRepository(Produit::class)->findOneBy(['uuid' => $uuidProduit]);

        return new JsonResponse($produitService->transformProduit($produits));
    }
}
