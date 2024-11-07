<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table      = 'orders'; // Nom de la table
    protected $primaryKey = 'id';     // Clé primaire

    // Champs autorisés pour les opérations d'insertion ou de mise à jour
    protected $allowedFields = [
        'id_user',
        'total',
        'reduction',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // Active la gestion automatique des timestamps
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Utilise une suppression douce (soft delete)
    protected $useSoftDeletes = true;
}
