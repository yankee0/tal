<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

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
                'matricule' => 'TAL009',
                'profil' => 'OPS',
                'mot_de_passe' => sha1('yankee')
            ],
            [
                'prenom' => 'Tal',
                'nom' => 'Tal',
                'matricule' => 'TAL010',
                'profil' => 'FACTURATION',
                'mot_de_passe' => sha1('yankee')
            ]
        ];
        $this->db->table('utilisateurs')->insertBatch($user);

        $fake = Factory::create();
        $chauffeurs = [];
        for ($i=0; $i < 20; $i++) { 
            $chauffeurs[$i] = [
                'prenom' => $fake->firstName(),
                'nom' => $fake->lastName(),
                'matricule' => 'TAL'.$fake->numberBetween('111111','999999'),
            ];
        }
        $this->db->table('chauffeurs')->insertBatch($chauffeurs);



    }
}
