<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Carburant extends Migration
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
            'chrono' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'litres' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'date' => [
                'type' => 'DATE',
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('carburant');
    }

    public function down()
    {
        $this->forge->dropTable('carburant');
    }
}
