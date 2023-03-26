<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ImplicationsCamionsTransferts extends Migration
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
            'id_camion' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'code_operation' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_camion','camions','id','CASCADE','CASCADE');
        $this->forge->addForeignKey('code_operation','transferts','id','CASCADE','CASCADE');
        $this->forge->createTable('implication_camion_transfert');
    }

    public function down()
    {
        $this->forge->dropTable('implication_camion_transfert');
        
    }
}
