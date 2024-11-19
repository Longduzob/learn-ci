<?php

namespace App\Controllers;

use CodeIgniter\Model;
use App\Models\ProductModel; // Assurez-vous d'importer correctement le modèle


class product extends BaseController
{

    protected $require_auth = false;


    public function getindex($id = null)
    {
        $pm = model('ProductModel');
        if ($id) {
            $categorys = Model('CategoryModel')->getAllcategorys();
            if ($id == "new") {
                return $this->view('edit-product', ['categorys' => $categorys]);
            }
            $product = $pm->getproductById($id);

            if ($product) {
                return $this->view('edit-product', ['product' => $product, 'categorys' => $categorys]);
            } else {
                $this->error("ID produit introuvable");
                return $this->redirect("/product");
            }


        }
        $products = $pm->getAllproducts();
        return $this->view('product-index', ['products' => $products]);

    }

    public function gettest()
    {
        $this->message('Test');
        $this->error("Erreur");
        $this->success("Succès");
        $this->redirect("/product");
    }

    public function postcreate() {
        $data = $this->request->getPost();
        $pm = Model('ProductModel');
        if($pm->insertproduct($data)) {
            $this->success("Produit créé avec succès");
            $this->redirect('/product');


        } else {
            $errors = $pm->errors();
            $this->error("Erreur");
            $this->redirect('/product/new', ['errors'=>$errors, 'product'=>$data]);
        }
    }

    public function postupdate() {
        $data = $this->request->getPost();
        $pm = Model('ProductModel');
        if($pm->updateproduct($data['id'], $data)) {
            $this->success("Produit modifié avec succès");
            $this->redirect('/product');
        } else {
            $errors = $pm->errors();
            $this->error("Erreur");
            $this->redirect('/product/' . $data['id'], ['errors'=>$errors, 'product'=>$data]);
        }
    }

    public function getdelete($id = null) {
        if ($id) {
            if (Model('ProductModel')->deleteproduct($id)) {
                $this->success("Produit supprimé");
            } else {
                $this->error("Erreur");
            }
            $this->redirect("/product");
        }
    }


    public function getvoir($id = null) {
        $pm = Model('ProductModel');
        if ($id) {
            $product = $pm->getProductById($id);
            if ($product) {
                return $this->view('/product/voir', ['product' => $product]);
            } else {
                $this->error("ID produit non trouvé");
                return $this->redirect("/product");
            }
        }
    }

    public function getcart()
    {
        // Récupérer le panier stocké dans la session
        $cart = session()->get('cart') ?? [];

        // Charger la vue du panier et passer les données
        return $this->view('product/cart', ['cart' => $cart]);
    }


    public function postaddtocart()
    {
        $productId = $this->request->getPost('product_id');
        $requestedQuantity = $this->request->getPost('quantity');

        // Appeler le modèle ProductModel
        $productModel = new ProductModel();
        $product = $productModel->getProductWithQuantityCheck($productId, $requestedQuantity);

        if (!$product) {
            // Gérer le cas où le produit n'est pas trouvé ou la quantité demandée dépasse le stock
            $this->error("Le produit est soit introuvable, soit la quantité demandée n'est pas disponible.");
            return $this->redirect("/product/voir/{$productId}");
        }

        // Logique pour ajouter au panier (à stocker dans la session)
        $cart = session()->get('cart') ?? [];

        // Ajouter au panier ou mettre à jour la quantité si le produit est déjà dans le panier
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $requestedQuantity;
        } else {
            $cart[$productId] = [
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => $requestedQuantity,
            ];
        }

        // Sauvegarder le panier dans la session
        session()->set('cart', $cart);

        $this->success("Produit ajouté au panier !");
        return $this->redirect("/product/cart");
    }

}
