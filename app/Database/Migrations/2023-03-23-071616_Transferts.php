<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transferts extends Migration
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
            'type' => [
                'type' => 'ENUM("TOM","WALL")',
            ],
            'numero_conteneur' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'type_conteneur' => [
                'type' => 'ENUM("20TEUs","40TEUs")',
            ],
            'date' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('transferts');
    }

    public function down()
    {
        $this->forge->dropTable('transferts');
    }
}
