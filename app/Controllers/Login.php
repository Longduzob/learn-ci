<?php

namespace App\Controllers;

use App\Entities\User;

class Login extends BaseController
{
    protected $require_auth = false;


    public function getindex(): string
    {
        return view('\login\login');

    }

    public function postindex()
    {

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

//        print_r([
//            'email' => $email,
//            'password' => $password
//        ]);

        $um = Model('UserModel');
        $user = $um->verifyLogin($email, $password);
        if ($user) {
            $user = new User($user);
            if (!$user->isActive()) {
                return view('/login/login');
            }
            $this->session->set('user', $user);
            return $this->redirect('/product');
        } else {
            return view('/login/login');
        }
    }

    public function __construct()
    {
        // Démarrer la session dans le constructeur
        $this->session = \Config\Services::session();
    }


    public function getlogout()
    {
        $this->logout();
        return $this->redirect("/login");
    }

}