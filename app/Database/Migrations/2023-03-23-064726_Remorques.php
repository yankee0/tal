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
        ]);
        $this->forge->addPrimaryKey('chrono');
        $this->forge->createTable('remorques');
    }

    public function down()
    {
        $this->forge->dropTable('remorques');
        
    }
}
