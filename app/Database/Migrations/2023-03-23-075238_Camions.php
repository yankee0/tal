<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Camions extends Migration
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
            'chrono_tracteur' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'chrono_remorque' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'chauffeur' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('chrono_tracteur','tracteurs','chrono','CASCADE','NO ACTION');
        $this->forge->addForeignKey('chrono_remorque','remorques','chrono','CASCADE','NO ACTION');
        $this->forge->addForeignKey('chauffeur','chauffeurs','matricule','CASCADE','NO ACTION');
        $this->forge->createTable('camions');

    }

    public function down()
    {
        $this->forge->dropTable('camions');
        
    }
}
