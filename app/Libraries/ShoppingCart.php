<?php

namespace App\Libraries;

class ShoppingCart
{
    protected $session;

    public function __construct()
    {
        // Accès à la session
        $this->session = session();

        // Initialisation du panier si vide
        if (!$this->session->has('cart')) {
            $this->session->set('cart', [
                'items' => [],
                'count' => 0,
                'total' => 0
            ]);
        }
    }

    // Ajouter un produit au panier
    public function addProduct(array $product)
    {
        // Récupérer le panier actuel depuis la session
        $cart = $this->session->get('cart') ?? ['items' => [], 'count' => 0, 'total' => 0];

        // Vérifier si le produit existe déjà dans le panier
        $found = false;
        foreach ($cart['items'] as &$item) {
            if ($item['id'] == $product['id']) {
                // Si le produit existe déjà, augmenter la quantité
                $item['quantity'] += $product['quantity'];
                $found = true;
                break;
            }
        }

        // Si le produit n'a pas été trouvé, l'ajouter comme nouvel élément
        if (!$found) {
            $cart['items'][] = $product;
        }

        // Recalculer le total et le nombre d'articles du panier
        $cart['total'] = $this->calculateTotal($cart['items']);
        $cart['count'] = $this->calculateCountItem($cart['items']);

        // Mettre à jour la session avec le nouveau panier
        $this->session->set('cart', $cart);
    }

    // Supprimer un produit du panier (par index)
    public function removeProduct($index)
    {
        $cart = $this->session->get('cart');
        if (isset($cart['items'][$index])) {
            unset($cart['items'][$index]);
            $cart['items'] = array_values($cart['items']);
            $cart['total'] = $this->calculateTotal($cart['items']);
            $cart['count'] = $this->calculateCountItem($cart['items']);
            $this->session->set('cart', $cart);
        }
    }

    // Obtenir tous les produits du panier
    public function getProducts()
    {
        return $this->session->get('cart')['items'];
    }

    // Obtenir le total du panier
    public function getTotal()
    {
        return $this->session->get('cart')['total'];
    }

    // Obtenir le nombre total d'articles dans le panier
    public function getCount()
    {
        return $this->session->get('cart')['count'];
    }

    // Vider le panier
    public function clear()
    {
        $this->session->set('cart', [
            'items' => [],
            'count' => 0,
            'total' => 0
        ]);
    }

    // Calculer le total du panier
    protected function calculateTotal(array $items)
    {
        $total = 0;
        foreach ($items as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    // Calculer le nombre total d'articles
    protected function calculateCountItem(array $items)
    {
        $count = 0;
        foreach ($items as $item) {
            $count += $item['quantity'];
        }
        return $count;
    }
}
