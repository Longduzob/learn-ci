<?php

namespace App\Controllers;

class User extends BaseController
{
    protected $require_auth = false;
    public function getindex($id = null)
    {
        $um = Model('UserModel');
        if ($id) {
            if ($id == "new") {
                return $this->view('edit-user');
            }
            $user = $um->getUserById($id);
            if ($user) {
                return $this->view('edit-user', ['editeduser' => $user]);
            } else {
                $this->error("ID d'utilisateur non trouvable");
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
        $this->success("Succés");
        return $this->redirect("/user");
    }

    public function postcreate() {
        $data = $this->request->getPost();
        $um = Model('UserModel');
        if ($um->insertUser($data)) {
            $this->success("Utilisateur créer avec succes");
            $this->redirect('/user');
        } else {
            $errors = $um->errors();
            $this->redirect('/user/new', ['errors' => $errors, 'user' => $data]);
        }
    }

    public function postupdate() {
        $data = $this->request->getPost();
        $um = Model('UserModel');
        if ($um->updateUser($data['id'], $data)) {
            $this->success("Utilisateur modifié avec succes");
            $this->redirect('/user');
        } else {
            $errors = $um->errors();
            $this->redirect('/user/' . $data['id'], ['errors' => $errors, 'user' => $data]);
        }
    }

    public function getdelete($id = null) {
        if ($id) {
            if (Model('UserModel')->deleteUser($id)) {
                $this->success("Utilisateur supprimer avec succes");
            } else {
                $this->error("Erreur");
            }
        }
        $this->redirect("/user");
    }

}
