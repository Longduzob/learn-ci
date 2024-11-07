<?php

namespace App\Controllers;

class Category extends BaseController
{
    public function getindex($id = null)
    {
        $cm = Model('CategoryModel');
        if ($id) {
            if ($id == "new") {
                return $this->view('edit-category');
            }
            $category = $cm->getCategoryById($id);
            if ($category) {
                return $this->view('edit-category', ['category' => $category]);
            } else {
                $this->error("ID categorie non trouvable");
                return $this->redirect("/category");
            }
        }
        $categories = $cm->getAllCategorys();
        return $this->view('category-index', ['categories' => $categories]);
    }

    public function gettest()
    {
        $this->message('Test');
        $this->error("Erreur");
        $this->success("Succés");
        return $this->redirect("/category");
    }

    public function postcreate() {
        $data = $this->request->getPost();
        $cm = Model('CategoryModel');
        if ($cm->insertCategory($data)) {
            $this->success("Utilisateur créer avec succes");
            $this->redirect('/category');
        } else {
            $errors = $cm->errors();
            $this->redirect('/category', ['errors' => $errors, 'category' => $data]);
        }
    }

    public function postupdate() {
        $data = $this->request->getPost();
        $cm = Model('CategoryModel');
        if ($cm->updateCategory($data['id'], $data)) {
            $this->success("Utilisateur modifié avec succes");
            $this->redirect('/category');
        } else {
            $errors = $cm->errors();
            $this->redirect('/category/' . $data['id'], ['errors' => $errors, 'category' => $data]);
        }
    }

    public function getdelete($id = null) {
        if ($id) {
            if (Model('CategoryModel')->deleteCategory($id)) {
                $this->success("Utilisateur supprimer avec succes");
            } else {
                $this->error("Erreur");
            }
        }
        $this->redirect("/category");
    }

}
