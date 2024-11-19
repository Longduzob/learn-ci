<?php

namespace App\Controllers;

use CodeIgniter\Model;

class category extends BaseController
{

    protected $require_auth = false;


    public function getindex($id = null)
    {
        $cm = model('CategoryModel');
        if ($id) {
            if ($id == "new") {
                return $this->view('edit-category');
            }
            $category = $cm->getcategoryById($id);
            if ($category) {
                return $this->view('edit-category', ['category' => $category]);
            } else {
                $this->error("ID category introuvable");
                return $this->redirect("/category");
            }

        }
        $categorys = $cm->getAllcategorys();
        return $this->view('category-index', ['categorys' => $categorys]);
    }

    public function gettest()
    {
        $this->message('Test');
        $this->error("Erreur");
        $this->success("Succès");
        $this->redirect("/product");
    }

    public function postcreate()
    {
        $data = $this->request->getPost();
        if (isset($data['name'])) {
            $data['slug'] = generateSlug($data['name']);
        }
        $cm = Model('CategoryModel');
        if ($cm->insertcategory($data)) {
            $this->success("Categorie créé avec succès");
            $this->redirect('/category');
        } else {
            $errors = $cm->errors();
            $this->error("Erreur");
            $this->redirect('/category/new', ['errors' => $errors, 'category' => $data]);
        }
    }

    public function postupdate()
    {
        $data = $this->request->getPost();
        $cm = Model('CategoryModel');
        if ($cm->updatecategory($data['id'], $data)) {
            $this->success("Category modifié avec succès");
            $this->redirect('/category');
        } else {
            $errors = $cm->errors();
            $this->error("Erreur");
            $this->redirect('/category/' . $data['id'], ['errors' => $errors, 'category' => $data]);
        }
    }

    public function getdelete($id = null)
    {
        if ($id) {
            if (Model('CategoryModel')->deletecategory($id)) {
                $this->success("Category supprimé");
            } else {
                $this->error("Erreur");
            }
            $this->redirect("/category");
        }

    }
}

