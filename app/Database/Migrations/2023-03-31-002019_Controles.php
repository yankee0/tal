<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Controles extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'type' => [
                'type' => 'ENUM("VT","AS","CATS")',
            ],
            'chrono_tracteur' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'default' => null
            ],
            'chrono_remorque' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'default' => null

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
        $this->forge->addForeignKey('chrono_tracteur', 'tracteurs', 'chrono', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('chrono_remorque', 'remorques', 'chrono', 'CASCADE', 'CASCADE');
        $this->forge->createTable('controles');
    }

    public function down()
    {
        $this->forge->dropTable('controles');
    }
}
