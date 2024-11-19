<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableOrderProduct extends Migration
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
            'id_product' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'id_order' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'quantity' => [
                'type'       => 'INT',
                'constraint' => '11',
            'default' => 0,
            ],
            'price_unitaire' => [
                'type'       => 'INT',
                'constraint' => '11',
                'default' => 0,
            ],

        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_order', 'order', 'id','CASCADE','CASCADE');
        $this->forge->createTable('order_product');

    }

    public function down()
    {
        //
    }
}
