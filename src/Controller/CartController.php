<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]

class CartController extends AbstractController
{
   
    public function __construct (protected ProductRepository $productRepository){
        
    }
    #[Route('/admin/cart', name: 'app_cart', methods:['POST','GET'])]
    public function addToCart(Request $request)
    {
            $id = ($request->request->get('id'));
            $product = $this->productRepository->find($id);

             // If the product does not exist, throw a 404 exception
        if (!$product) {
            throw $this->createNotFoundException('Product not found.');
        }

          // Get the cart from the session, or create a new cart if it doesn't exist
        $cart = $request->getSession()->get('cart', []);
        // Add the product to the cart
        if (isset($cart[$id])) {
            // If the product is already in the cart, increase the quantity
            $cart[$id]['quantity']++;
        } else {
            // If the product is not in the cart, add it with a quantity of 1
            $cart[$id] = [
                'id' => $id,
                'name' => $product->getName(),
                'price' => $product->getPrice(),
                'quantity' => 1,
            ];
        }
        // Save the cart in the session
        $request->getSession()->set('cart', $cart);
        // перенаправляем пользователя на страницу корзины
        return $this->redirectToRoute('app_cart_show');
    }

    #[Route('/admin/cart/show', name: 'app_cart_show')]
    public function showCart(Request $request)
    {
        $cart = $request->getSession()->get('cart', []);

        $products = [];

        foreach ($cart as $productId => $quantity) {
            $product = $this->productRepository->find($productId);

            if ($product) {
                $products[] = [
                    'product' => $product,
                    'quantity' => $quantity
                ];
            }
        }

        return $this->render('admin/cart/index.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route('/admin/cart/remove/{productId}', name: 'app_cart_remove', methods:['POST','GET','DELETE'])]
    public function removeProductFromCart(Request $request, int $productId)
    {
    $session = $request->getSession();
    $cart = $session->get('cart', []);
    unset($cart[$productId]);
    $session->set('cart', $cart);
    return $this->redirectToRoute('app_cart_show');
    }


}
