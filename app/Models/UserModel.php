<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'User';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['username','email','password','id_billing','id_shipping','created_at','updated_at','deleted_at'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'username' => 'required|min_length[3]|max_length[100]',
        'email'    => 'required|valid_email|is_unique[User.email,id,{id}]',
        'password' => 'required|min_length[8]',
    ];

    protected $validationMessages = [
        'username' => [
            'required'   => 'Le nom d\'utilisateur est requis.',
            'min_length' => 'Le nom d\'utilisateur doit comporter au moins 3 caractères.',
            'max_length' => 'Le nom d\'utilisateur ne doit pas dépasser 100 caractères.',
        ],
        'email' => [
            'required'   => 'L\'email est requis.',
            'valid_email' => 'L\'email doit être valide.',
            'is_unique'   => 'Cet email est déjà utilisé.',
        ],
        'password' => [
            'required'   => 'Le mot de passe est requis.',
            'min_length' => 'Le mot de passe doit comporter au moins 8 caractères.',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (!isset($data['data']['password'])) {
            return $data;
        }

        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        return $data;
    }

    public function getAllUsers() {
        return $this->findAll();
    }

    public function getUserById($id) {
        return $this->find($id);
    }

    public function insertUser($data) {
        return $this->insert($data);
    }

    public function deleteUser($id) {
        return $this->delete($id);
    }

    public function updateUser($id, $data) {
        $builder = $this->builder();
        if (isset($data['password'])) {
            if($data['password'] == '') {
                unset($data['password']);
            } else {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            }
        }
        $data['updated_at'] = date('Y-m-d H:i:s');
        $builder->where('id', $id);
        return $builder->update($data);
    }

    public function verifyLogin($email, $password)
    {
        // Rechercher l'utilisateur par email
        $user = $this->withDeleted()->where('email', $email)->first();

        // Si l'utilisateur existe, vérifier le mot de passe
        if ($user && password_verify($password, $user['password'])) {
            // Le mot de passe est correct, retourner les informations de l'utilisateur
            return $user;
        }

        // Si l'utilisateur n'existe pas ou si le mot de passe est incorrect, retourner false
        return false;
    }
}
