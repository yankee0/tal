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
            'marque' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'modele' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'remarque' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'au_rebut' => [
                'type' => 'CHAR',
                'constraint' => 10,
                'null' => true,
                'default' => 'NON'
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
