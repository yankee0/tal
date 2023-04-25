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
            'type_transfert' => [
                'type' => 'ENUM("FULL IMPORT","FULL EXPORT","VIDE")',
            ],
            'date_mvt' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'conteneur' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'type_conteneur' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'teus' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'ligne' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'rame' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'mouvement' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'p_v' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'chauffeur' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'imm_tracteur' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'chrono' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'eirs' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'remarque_sous_traitant' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'auteur' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

        ]);

        $this->forge->addPrimaryKey('id');    
        $this->forge->addForeignKey('auteur','utilisateurs','matricule','CASCADE','NO ACTION');    
        $this->forge->createTable('transferts',true);
    }

    public function down()
    {
        $this->forge->dropTable('transferts',true);
    }
}
