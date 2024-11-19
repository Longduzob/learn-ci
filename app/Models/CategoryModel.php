<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $protectFields = true;
    protected $allowedFields = ['name', 'slug'];

    // Validation
    protected $validationRules = [
        'name' => 'required|min_length[2]|max_length[100]',
    ];
    protected $validationMessages = [
        'name' => [
            'required' => 'La catégorie est requise.',
            'min_length' => 'Le nom de la catégorie doit comporter au moins 2 caractères.',
            'max_length' => 'Le nom de la catégorie ne doit pas dépasser 100 caractères.',
        ],
    ];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;


    public function getAllcategorys()
    {
        return $this->findAll();
    }

    public function getcategoryById($id)
    {
        return $this->find($id);

    }

    public function insertCategory($data)
    {
        $data['slug'] = $this->generateUniqueSlug($data['name']);
        return $this->insert($data);
    }

    public function updatecategory($id, $data)
    {
        $data['slug'] = $this->generateUniqueSlug($data['name']);
        return $this->update($id, $data);
    }

    public function deletecategory($id)
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
}


