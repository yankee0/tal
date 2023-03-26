<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Assurances extends Migration
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
                'null' => true,
            ],
            'debut' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'fin' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('chrono_tracteur','tracteurs','chrono','CASCADE','CASCADE');
        $this->forge->createTable('assurances');
    }

    public function down()
    {
        $this->forge->dropTable('assurances');
        
    }
}
