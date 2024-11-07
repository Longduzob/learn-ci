<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateTableUser extends Migration
{
    public function up()
    {
        $fields = [
            'id_billing'  => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true, // Peut être NULL
            ],
            'id_shipping' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true, // Peut être NULL
            ],
        ];

        $this->forge->addColumn('User', $fields);

        // Ajout des clés étrangères vers la table `address`
        $this->forge->addForeignKey('id_billing', 'address', 'id', 'SET NULL', 'SET NULL');
        $this->forge->addForeignKey('id_shipping', 'address', 'id', 'SET NULL', 'SET NULL');
    }

    public function down()
    {
        $this->forge->dropForeignKey('User', 'User_id_billing_foreign');
        $this->forge->dropForeignKey('User', 'User_id_shipping_foreign');
        $this->forge->dropColumn('User', ['id_billing', 'id_shipping']);
    }
}
