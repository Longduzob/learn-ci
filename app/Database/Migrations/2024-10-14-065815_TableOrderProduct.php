<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableOrderProduct extends Migration
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
            'id_order'    => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'id_product'  => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'quantity'    => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'unit_price'  => [
                'type'       => 'FLOAT',
            ],
        ]);
        $this->forge->addKey('id', true); // Clé primaire
        $this->forge->addForeignKey('id_order', 'orders', 'id', 'CASCADE', 'CASCADE'); // Clé étrangère vers orders
        $this->forge->addForeignKey('id_product', 'product', 'id', 'CASCADE', 'CASCADE'); // Clé étrangère vers product
        $this->forge->createTable('order_product');
    }

    public function down()
    {
        $this->forge->dropTable('order_product');
    }
}
