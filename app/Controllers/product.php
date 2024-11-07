<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Product extends BaseController
{
    // Fonction pour afficher tous les produits (page d'administration)
    public function getindex($id = null)
    {
        $pm = Model('ProductModel');
        if ($id) {
            $categories = Model('CategoryModel')->getAllCategorys();
            if ($id == "new") {
                return $this->view('/product/product', ['categories' => $categories]);
            }
            $product = $pm->getProductById($id);

            if ($product) {
                return $this->view('/product/product', ['product' => $product, 'categories' => $categories]);
            } else {
                $this->error("ID produit non trouvé");
                return $this->redirect("/product");
            }
        }
        $products = $pm->getAllProducts();
        return $this->view('/product/index', ['products' => $products]);
    }


    public function getclient($id = null)
    {
        $pm = Model('ProductModel');

        if ($id) {
            $product = $pm->getProductById($id);

            if ($product) {
                return $this->view('/product/client', ['product' => $product]);
            } else {
                $this->error("Produit non trouvé");
                return $this->redirect("/product/client");
            }
        }

        $products = $pm->getAllProducts();
        return $this->view('/product/indexclient', ['products' => $products]);
    }



    // Fonction pour créer un produit
    public function postcreate()
    {
        $data = $this->request->getPost();
        $pm = Model('ProductModel');
        if ($pm->insertProduct($data)) {
            $this->success("Produit créé avec succès");
            $this->redirect('/product');
        } else {
            $errors = $pm->errors();
            $this->redirect('/product', ['errors' => $errors, 'product' => $data]);
        }
    }

    // Fonction pour mettre à jour un produit
    public function postupdate()
    {
        $data = $this->request->getPost();
        $pm = Model('ProductModel');
        if ($pm->updateProduct($data['id'], $data)) {
            $this->success("Produit modifié avec succès");
            $this->redirect('/product');
        } else {
            $errors = $pm->errors();
            $this->redirect('/product/' . $data['id'], ['errors' => $errors, 'product' => $data]);
        }
    }

    // Fonction pour voir un produit
    public function getvoir($id = null)
    {
        $pm = Model('ProductModel');
        if ($id) {
            // Récupérer le produit par ID
            $product = $pm->getProductById($id);

            // Si le produit existe
            if ($product) {
                // Affichage de la vue "voir" (détails du produit pour le client)
                return $this->view('/product/voir', ['product' => $product]);
            } else {
                // Si le produit n'est pas trouvé
                $this->error("ID produit non trouvé");
                return $this->redirect("/product/client");  // Redirection vers la page client
            }
        }
    }



    // Fonction pour supprimer un produit
    public function getdelete($id = null)
    {
        if ($id) {
            if (Model('ProductModel')->deleteProduct($id)) {
                $this->success("Produit supprimé avec succès");
            } else {
                $this->error("Erreur");
            }
        }
        $this->redirect("/product");
    }

}
