<?php

namespace App\Controller\Api;

use App\Services\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiCartController extends AbstractController
{
    #[Route('/api/cart', name: 'api_cart', methods: ['GET'])]
    public function cart(Request $request, RequestStack $requestStack): Response
    {
        return new JsonResponse($requestStack->getSession()->all());
    }

    #[Route('/api/cart/add', name: 'api_cart_add', methods: ['POST'])]
    public function add(Request $request, RequestStack $requestStack, CartService $cartService): Response
    {
        $json = $request->get('json');
        if($newArticle = json_decode($json)) {
            $cartService->addToCart($newArticle->product, $newArticle->quantity);
        }

        return new JsonResponse($requestStack->getSession()->all());
    }
}
