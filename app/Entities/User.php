<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class User extends Entity
{
    Protected $attributes = [
        'id'        => null,
        'username'  => null,
        'email'     => null,
        'password'  => null,
        'created_at'=> null,
        'updated_at'=> null,
        'deleted_at'=> null,
    ];

    protected $casts   = [
        'id'        => 'integer',
        'created_at'=> 'datetime',
        'updated_at'=> 'datetime',
        'deleted_at'=> 'datetime',
    ];

    protected $hidden = ['password'];


    public function isActive(): bool
    {
        return $this->attributes['deleted_at'] === null;
    }
}
