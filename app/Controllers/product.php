<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Product extends BaseController
{
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
                return $this->view('/product/product', ['product' => $product,'categories' => $categories]);
            } else {
                $this->error("ID categorie non trouvable");
                return $this->redirect("/product");
            }
        }
        $products = $pm->getAllProducts();
        return $this->view('/product/index', ['products' => $products]);
    }
    public function postcreate() {
        $data = $this->request->getPost();
        $pm = Model('ProductModel');
        if ($pm->insertProduct($data)) {
            $this->success("Produit créer avec succes");
            $this->redirect('/product');
        } else {
            $errors = $pm->errors();
            $this->redirect('/product', ['errors' => $errors, 'product' => $data]);
        }
    }
    public function postupdate() {
        $data = $this->request->getPost();
        $pm = Model('ProductModel');
        if ($pm->updateProduct($data['id'], $data)) {
            $this->success("Produit modifié avec succes");
            $this->redirect('/product');
        } else {
            $errors = $pm->errors();
            $this->redirect('/product/' . $data['id'], ['errors' => $errors, 'product' => $data]);
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
    public function getdelete($id = null) {
        if ($id) {
            if (Model('ProductModel')->deleteProduct($id)) {
                $this->success("Produit supprimer avec succes");
            } else {
                $this->error("Erreur");
            }
        }
        $this->redirect("/product");
    }
}
