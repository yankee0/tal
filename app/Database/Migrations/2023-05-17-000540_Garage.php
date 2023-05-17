<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Garage extends Migration
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
            'date' => [
                'type' => 'DATE',
                'null' => true,
            ],  
            'chrono' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'commentaire' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'total' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('garage');
    }

    public function down()
    {
        $this->forge->dropTable('garage');
    }
}
