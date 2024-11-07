<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableAddress extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'           => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'postal_code'  => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
            ],
            'city'         => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'street'       => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'complement'   => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('id', true); // Clé primaire
        $this->forge->createTable('address');
    }

    public function down()
    {
        $this->forge->dropTable('address');
    }
}
