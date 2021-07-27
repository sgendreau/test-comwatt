<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use App\Form\ProductFormType;
use App\Services\ProductService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    public function __construct(protected EntityManagerInterface $entityManager, private ProductService $productService) {

    }

    #[Route('/admin', name: 'admin_index')]
    public function index(): Response
    {
        $products = $this->entityManager->getRepository(Produit::class)->findBy([], ['titre'=> 'ASC']);

        return $this->render('admin/index.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route('/admin/add', name: 'admin_add')]
    public function add(Request $request): Response
    {
        $product = new Produit();
        $form = $this->createForm(ProductFormType::class, $product);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $this->productService->create($product);
            return $this->redirectToRoute('admin_index');
        }

        return $this->render('admin/edit.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/update/{uuidProduct}', name: 'admin_update')]
    public function update(Request $request, $uuidProduct): Response
    {
        $product = $this->entityManager->getRepository(Produit::class)->findOneBy(['uuid' => $uuidProduct]);
        $form = $this->createForm(ProductFormType::class, $product);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $this->productService->update();
            return $this->redirectToRoute('admin_index');
        }

        return $this->render('admin/edit.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/delete/{uuidProduct}', name: 'admin_delete')]
    public function delete( $uuidProduct): Response
    {
        /** @var Produit $product */
        $product = $this->entityManager->getRepository(Produit::class)->findOneBy(['uuid' => $uuidProduct]);

        $this->productService->delete($product);

        return $this->redirectToRoute('admin_index');
    }
}
