<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderProduct extends Model
{
    protected $table      = 'order_product'; // Nom de la table
    protected $primaryKey = 'id';            // Clé primaire

    // Champs autorisés pour les opérations d'insertion ou de mise à jour
    protected $allowedFields = [
        'id_order',
        'id_product',
        'quantity',
        'unit_price'
    ];
}
