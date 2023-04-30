<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Utilisateur extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'matricule' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'profil' => [
                'type' => 'ENUM("SUPER ADMIN","ADMIN","OPS")',
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
            'mot_de_passe' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('matricule');
        $this->forge->createTable('utilisateurs');
    }

    public function down()
    {
        $this->forge->dropTable('utilisateurs');
        
    }
}
