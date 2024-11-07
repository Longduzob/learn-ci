<?php

namespace App\Controllers;

class Checkout extends BaseController
{
    public function getindex()
    {
        return $this->view('/product/checkout.php');
    }
}