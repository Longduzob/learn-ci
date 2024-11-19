<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableOrder extends Migration
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
            'id_user' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'total' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'date_c' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'date_u' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'date_d' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'reduction' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],

        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_user', 'user', 'id','CASCADE','CASCADE');
        $this->forge->createTable('order');


    }


    public function down()
    {
        //
    }
}
