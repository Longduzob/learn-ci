<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAdminUser extends Migration
{
    public function up()
    {
        $data = [
            'username'     => 'admin',
            'email'        => 'admin@admin.fr',
            'password'     => password_hash('admin', PASSWORD_DEFAULT),
            'created_at'   => date('Y-m-d H:i:s'),
            'updated_at'   => date('Y-m-d H:i:s'),
        ];

        $this->db->table('User')->insert($data);
    }

    public function down()
    {
        $this->db->table('User')
            ->where('username', 'admin')
            ->delete();
    }
}
