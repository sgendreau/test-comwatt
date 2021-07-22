<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProduitController extends AbstractController
{
    #[Route('/', name: 'produit')]
    public function index(): Response
    {

        return $this->render('base.html.twig', [
            'controller_name' => 'ProduitController',
        ]);
    }
}
