<?php


namespace App\Services;


use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService
{
    /**
     * @var RequestStack
     */
    private RequestStack $requestStack;

    /**
     * @var SessionInterface
     */
    private $session;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
        $this->session = $this->requestStack->getSession();
    }

    public function addToCart(string $product, int $quantity):void
    {
        $sessionProduct = $this->session->get($product, 0);
        $this->session->set($product, $sessionProduct+$quantity);

    }

    public function soustractToCart(string $product, int $quantity): void
    {
        $sessionProduct = $this->session->get($product, 0);
        $this->session->set($product, max($sessionProduct-$quantity, 0));

    }

    public function emptyCart(): void
    {
        $this->session->clear();
    }


}