<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $protectFields = true;
    protected $allowedFields = ['name', 'price', 'quantity', 'id_category', 'slug', 'created_at', 'updated_at', 'delete_at'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = false;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [
        'name' => 'required|min_length[1]|max_length[100]',
        'price' => 'required|min_length[0]',
        'quantity' => 'required|min_length[1]|required|max_length[15]',
    ];
    protected $validationMessages = [
        'name' => [
            'required' => 'Le nom du produit est requis.',
            'min_length' => 'Le nom du produit doit comporter au moins 1 caractères.',
            'max_length' => 'Le nom du produit ne doit pas dépasser 100 caractères.',
        ],
        'price' => [
            'required' => 'Le prix est requis.',
        ],
        'quantity' => [
            'required' => 'Une quantité est requise.',
            'min_length' => 'La quantité doit comporter au moins 1 caractères.',
        ],
    ];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;


    public function getAllproducts()
    {
        $builder = $this->db->table('product p');
        $builder->select("p.id, p.name, p.price, p.quantity, p.id_category, p.slug, p.created_at, p.updated_at");
        $builder->join('category c', 'c.id = p.id_category', 'left');
        $builder->where('p.deleted_at IS NULL');
        return $builder->get()->getResultArray();
    }

    public function getproductById($id)
    {
        return $this->find($id);

    }

    public function insertproduct($data)
    {
        return $this->insert($data);

    }

    public function updateproduct($id, $data)
    {
        $builder = $this->builder();
        $data['updated_at'] = date('Y-m-d H:i:s');
        $builder->where('id', $id);
        return $builder->update($data);
    }


    public function deleteproduct($id)
    {
        return $this->delete($id);
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


    public function getProductWithQuantityCheck($id, $requestedQuantity)
    {
        $product = $this->find($id);

        if (!$product) {
            return false; // Le produit n'existe pas
        }

        // Vérification que la quantité demandée est disponible
        if ($requestedQuantity > $product['quantity']) {
            return false; // Pas assez de stock disponible
        }

        return $product;
    }

}
