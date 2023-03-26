<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Chauffeurs extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'matricule' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'prenom' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'nom' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('matricule');
        $this->forge->createTable('chauffeurs');
    }

    public function down()
    {
        $this->forge->dropTable('chauffeurs');
        
    }
}
