<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table            = 'product';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name','price','quantity','slug','id_category'];

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
    protected $validationRules      = [
        'name' => 'required|min_length[3]|max_length[255]',
        'price' => 'numeric',
        'quantity' => 'integer',
    ];
    protected $validationMessages   = [
        'name' => [
            'required'   => 'Le nom du produit est requis.',
            'min_length' => 'Le nom du produit doit comporter au moins 3 caractères.',
            'max_length' => 'Le nom du produit ne doit pas dépasser 100 caractères.',
        ],
        'price' => [
            'numeric'   => 'Le prix doit être un chiffre.',
        ],
        'quantity' => [
            'integer'   => 'La quantité doit être un chiffre entier.',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = false;

    public function getAllProducts() {
        $builder = $this->db->table('product p');

        $builder->select("p.id, p.name, p.price, p.quantity, p.slug, p.id_category, c.name as category_name, p.created_at, p.updated_at");

        $builder->join('category c', 'c.id = p.id_category', 'left');

        // Trier par ID décroissant pour afficher le dernier produit ajouté en premier
        $builder->orderBy('p.id', 'DESC');

        return $builder->get()->getResultArray();
    }


    public function getProductById($id) {
        return $this->find($id);
    }

    public function insertProduct($data) {
        $data['slug'] = $this->generateUniqueSlug($data['name']);
        return $this->insert($data);
    }

    public function deleteProduct($id) {
        return $this->delete($id);
    }

    public function updateProduct($id, $data) {
        $data['slug'] = $this->generateUniqueSlug($data['name']);
        return $this->update($id,$data);
    }

    private function generateUniqueSlug($name)
    {
        $slug = generateSlug($name);
        $builder = $this->builder();
        $count = $builder->where('slug', $slug)->countAllResults();
        if ($count === 0) {
            return $slug;
        }
        $i = 1;
        while ($count > 0) {
            $newSlug = $slug . '-' . $i;
            $count = $builder->where('slug', $newSlug)->countAllResults();
            $i++;
        }
        return $newSlug;
    }
}
