<?php

namespace App\Controller\Api;

use App\Entity\Produit;
use App\Services\ProductService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiProductController extends AbstractController
{
    #[Route('/api/products', name: 'api_products')]
    public function getProduicts(EntityManagerInterface $entityManager, ProductService $productService): Response
    {
        $produits = $entityManager->getRepository(Produit::class)->findBy([], ['titre'=> 'ASC']);

        return new JsonResponse($productService->transformProducts($produits));
    }

    #[Route('/api/product/{uuidProduct}', name: 'api_produit')]
    public function getProduct(EntityManagerInterface $entityManager, ProductService $productService, $uuidProduct): Response
    {
        $products = $entityManager->getRepository(Produit::class)->findOneBy(['uuid' => $uuidProduct]);

        return new JsonResponse($productService->transformProduct($products));
    }
}
