<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Prestataires extends Migration
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
            'nom' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('nom');
        $this->forge->createTable('prestataires',true);
    }

    public function down()
    {
        $this->forge->dropTable('prestataires',true);
    }
}
