<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableOrder extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_user'     => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'total'       => [
                'type'       => 'FLOAT',
                'null'       => true,
            ],
            'reduction'   => [
                'type'       => 'FLOAT',
                'null'       => true,
            ],
            'created_at'  => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at'  => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at'  => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true); // Clé primaire
        $this->forge->addForeignKey('id_user', 'User', 'id', 'CASCADE', 'CASCADE'); // Clé étrangère vers users
        $this->forge->createTable('orders');
    }

    public function down()
    {
        $this->forge->dropTable('orders');
    }
}
