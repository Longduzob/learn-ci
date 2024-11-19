<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableAdress extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'cp' => [
                'type'       => 'VARCHAR',
                'constraint' => '99999',
                'unsigned'       => true,
                'default' => 0,
            ],
            'ville' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'unsigned'       => true,
                'default' => 0,
            ],
            'rue' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'unsigned'       => true,
                'default' => 0,
            ],
            'complement' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'unsigned'       => true,
                'default' => 0,
            ],

        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('adress');


    }

    public function down()
    {
        //
    }
}
