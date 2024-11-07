<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table            = 'category';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['name','slug'];


    // Validation
    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[255]'
    ];

    protected $validationMessages = [
        'username' => [
            'required'   => 'Le nom de la catégorie est requis.',
            'min_length' => 'Le nom de la catégorie doit comporter au moins 3 caractères.',
            'max_length' => 'Le de la catégorie ne doit pas dépasser 255 caractères.',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function getAllCategorys() {
        return $this->findAll();
    }

    public function getCategoryById($id) {
        return $this->find($id);
    }

    public function insertCategory($data) {
        $data['slug'] = $this->generateUniqueSlug($data['name']);
        return $this->insert($data);
    }

    public function deleteCategory($id) {
        return $this->delete($id);
    }

    public function updateCategory($id, $data) {
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
