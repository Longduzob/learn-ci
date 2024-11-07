<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Libraries\ShoppingCart;
class Cart extends BaseController
{

    public function getindex()
    {
        $cart = new ShoppingCart();
        $products = $cart->getProducts();
        $total = $cart->getTotal();

        return $this->view('cart', ['products' => $products, 'total' => $total]);
    }
    public function postaddtocart()
    {
        $data = $this->request->getPost();
        $cart = new ShoppingCart();

        // Exemple de produit
        $product = [
            'id' => 1,
            'name' => 'Produit A',
            'price' => 10.50,
            'quantity' => 2
        ];

        $cart->addProduct($data);

        return $this->redirect('/cart');
    }


}
