<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Users extends Seeder
{
    public function run()
    {
        $data = [
            [
                'matricule' => 'TAL007',
                'prenom' => 'Yankee',
                'nom' => 'Suprem',
                'profil' => 'SUPER ADMIN',
                'mot_de_passe' => sha1('yankee')
            ],
            [
                'matricule' => 'TAL008',
                'prenom' => 'Booba',
                'nom' => 'CFA',
                'profil' => 'ADMIN',
                'mot_de_passe' => sha1('booba')
            ],
            [
                'matricule' => 'TAL009',
                'prenom' => 'Yankee',
                'nom' => 'Major',
                'profil' => 'OPS TAL',
                'mot_de_passe' => sha1('yankee')
            ],
            [
                'matricule' => 'TAL010',
                'prenom' => 'Yankee',
                'nom' => 'Major',
                'profil' => 'OPS TOM',
                'mot_de_passe' => sha1('yankee')
            ],

        ];

        // Using Query Builder
        $this->db->table('utilisateurs')->insertBatch($data);
    }
}
