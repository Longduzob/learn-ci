<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tablecategory extends Migration
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
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('category');

        $this->db->table('category')->insert(['name' => 'Non classé', 'slug' => 'non-classe']);

        $trigger_sql = "
        CREATE TRIGGER prevent_delete_initial_category
        BEFORE DELETE ON category
        FOR EACH ROW
        BEGIN
            IF OLD.id = 1 THEN
                SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'La suppression de la category \"Non classé\" est interdite.';
                END IF;
                END;
        ";
        $this->db->query($trigger_sql);
    }

    public function down()
    {
        $this->forge->dropTable('category');
    }
}

