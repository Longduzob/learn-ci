<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tableproduct extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'price' => [
                'type' => 'FLOAT',
                'constraint' => '11',
                'default' => 0
            ],
            'quantity' => [
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => true,
                'default' => 0
            ],
            'id_category' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'default' => 1,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_category', 'category', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('product');

    }

    public function down()
    {
        $this->forge->dropTable('product');
    }
}

