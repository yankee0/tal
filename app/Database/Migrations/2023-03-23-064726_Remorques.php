<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Remorques extends Migration
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
                'type' => 'ENUM("SEMI-REMORQUE","REMORQUE")',
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
        $this->forge->createTable('remorques');
    }

    public function down()
    {
        $this->forge->dropTable('remorques');
        
    }
}
