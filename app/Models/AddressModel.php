<?php

namespace App\Models;

use CodeIgniter\Model;

class AddressModel extends Model
{
    protected $table      = 'address'; // Nom de la table
    protected $primaryKey = 'id';      // Clé primaire

    // Champs autorisés pour les opérations d'insertion ou de mise à jour
    protected $allowedFields = [
        'postal_code',
        'city',
        'street',
        'complement'
    ];
}
