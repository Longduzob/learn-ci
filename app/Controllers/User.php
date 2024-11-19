<?php

namespace App\Controllers;

use CodeIgniter\Model;

class User extends BaseController
{

    protected $require_auth = false;


    public function getindex($id = null)
    {
        $um = model('UserModel');
        if ($id) {
            if ($id == "new") {
                return $this->view('edit-user');
            }
            $user = $um->getUserById($id);
            if ($user) {
                return $this->view('edit-user', ['user' => $user]);
            } else {
                $this->error("ID d'utilisateur introuvable");
                return $this->redirect("/user");
            }

        }
        $users = $um->getAllUsers();
        return $this->view('user-index', ['users' => $users]);
    }

    public function gettest()
    {
        $this->message('Test');
        $this->error("Erreur");
        $this->success("Succès");
        $this->redirect("/user");
    }

    public function postcreate() {
        $data = $this->request->getPost();
        $um = Model('UserModel');
        if($um->insertUser($data)) {
            $this->success("Utilisateur créé avec succès");
            $this->redirect('/user');
        } else {
            $errors = $um->errors();
            $this->error("Erreur");
            $this->redirect('/user/new', ['errors'=>$errors, 'user'=>$data]);
        }
    }

    public function postupdate() {
        $data = $this->request->getPost();
        $um = Model('UserModel');
        if($um->updateUser($data['id'], $data)) {
            $this->success("Utilisateur modifié avec succès");
            $this->redirect('/user');
        } else {
            $errors = $um->errors();
            $this->error("Erreur");
            $this->redirect('/user/' . $data['id'], ['errors'=>$errors, 'user'=>$data]);
        }
    }

    public function getdelete($id = null) {
        if ($id) {
            if (Model('UserModel')->deleteUser($id)) {
                $this->success("Utilisateur supprimé");
            } else {
                $this->error("Erreur");
            }
            $this->redirect("/user");
        }
    }

}
