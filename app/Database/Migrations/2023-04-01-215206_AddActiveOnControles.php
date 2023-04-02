<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddActiveOnControles extends Migration
{
    public function up()
    {
        $this->forge->addColumn('controles',[
            'actif' => [
                'type' => 'CHAR',
                'constraint' => 10,
                'null' => true,
                'default' => 'y'
            ],
        ]);
        
    }

    public function down()
    {
        $this->forge->dropColumn('controles','actif');
    }
}
