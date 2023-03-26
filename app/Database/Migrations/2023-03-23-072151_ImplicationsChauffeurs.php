<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ImplicationsChauffeurs extends Migration
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
            'matricule_chauffeur' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'code_operation' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('matricule_chauffeur','chauffeurs','matricule','CASCADE','CASCADE');
        $this->forge->addForeignKey('code_operation','livraisons','id','CASCADE','CASCADE');
        $this->forge->createTable('implication_chauffeur_livraison');
    }

    public function down()
    {
        $this->forge->dropTable('implication_chauffeur_livraison');
        
    }
}
