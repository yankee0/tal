<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tracteurs extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'chrono' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'immatriculation' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'ancienne_immatriculation' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'genre' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'numero_chassis' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'remarque' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('chrono');
        $this->forge->addUniqueKey([
            'immatriculation',
            'ancienne_immatriculation',
            'numero_chassis'
        ]);
        $this->forge->createTable('tracteurs');
    }

    public function down()
    {
        $this->forge->dropTable('tracteurs');
    }
}
