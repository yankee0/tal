<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Data extends Seeder
{
    public function run()
    {
        $user = [
            [
                'prenom' => 'Tal',
                'nom' => 'Tal',
                'matricule' => 'TAL007',
                'profil' => 'SUPER ADMIN',
                'mot_de_passe' => sha1('yankee')
            ],
            [
                'prenom' => 'Tal',
                'nom' => 'Tal',
                'matricule' => 'TAL008',
                'profil' => 'ADMIN',
                'mot_de_passe' => sha1('yankee')
            ],
            [
                'prenom' => 'Tal',
                'nom' => 'Tal',
                'matricule' => 'TAL007',
                'profil' => 'OPS',
                'mot_de_passe' => sha1('yankee')
            ]
        ];

        
    }
}
