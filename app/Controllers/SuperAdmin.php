<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelTracteur;
use App\Models\ModelChauffeur;
use App\Models\ModeleLivraison;
use App\Models\ModelRemorque;
use App\Models\ModelTransfert;
use App\Models\ModelUtilisateur;

class SuperAdmin extends BaseController
{
    public function index()
    {
        session()->position = 'dashboard';
        $donnees = [
            'utilisateurs' => (new ModelUtilisateur())->countAll(),
            'chauffeurs' => (new ModelChauffeur())->countAll(),
            'tracteurs' => (new ModelTracteur())->countAll(),
            'remorques' => (new ModelRemorque())->countAll(),
            'count' => [
                'liv' => (new ModeleLivraison())->countAll(),
                'trans' => (new ModelTransfert())->countAll(),
            ],
            'gliv' => $this->countMonthlyDeliveriesLiv(),
            'gtrans' => $this->countMonthlyDeliveriesTrans(),
            'top4c' => $this->Top4Chauffeurs(),
            'top4t' => $this->top4Tracs()
        ];
        return view('super-admin/dashboard', $donnees);
    }

    public function countMonthlyDeliveriesLiv()
    {
        $this->db = \Config\Database::connect();
        $builder = $this->db->table('livraisons');
        $builder->select('MONTH(date_livraison) as month, COUNT(*) as count');
        $builder->groupBy('month');
        return $builder->get()->getResult();
    }

    public function countMonthlyDeliveriesTrans()
    {
        $this->db = \Config\Database::connect();
        $builder = $this->db->table('transferts');
        $builder->select('MONTH(date_mvt) as month, COUNT(*) as count');
        $builder->groupBy('month');
        return $builder->get()->getResult();
    }

    public function livraisons()
    {
        $data = [
            'liv' => (new ModeleLivraison())->findAll(),
        ];
        return view('utils/livraisons/list', $data);
    }

    public function transferts()
    {
        $data = [
            'trans' => (new ModelTransfert())->findAll(),
        ];
        return view('utils/transferts/list', $data);
    }

    public function top4Chauffeurs()
    {
        $chauffeurs = (new ModelChauffeur())->findAll();
        $liv = (new ModeleLivraison())->findAll();
        $trans = (new ModelTransfert())->findAll();
        for ($i = 0; $i < sizeof($chauffeurs); $i++) {

            array_push($chauffeurs[$i],0);
            foreach ($liv as $l ) {
                if ($chauffeurs[$i]['matricule'] == $l['chauffeur_aller'] or $chauffeurs[$i]['matricule'] == $l['chauffeur_retour']) {
                    $chauffeurs[$i][0]++;
                }
            }
            foreach ($trans as $t ) {
                if ($chauffeurs[$i]['matricule'] == $t['chauffeur']) {
                    $chauffeurs[$i][0]++;
                }
            }
        }
        
        return $this->sortDriversByCount($chauffeurs);
    }

    public function top4Tracs()
    {
        $trac = (new ModelTracteur())->findAll();
        $liv = (new ModeleLivraison())->findAll();
        $trans = (new ModelTransfert())->findAll();
        for ($i = 0; $i < sizeof($trac); $i++) {

            array_push($trac[$i],0);
            foreach ($liv as $l ) {
                if ($trac[$i]['chrono'] == $l['camion']) {
                    $trac[$i][0]++;
                }
            }
            foreach ($trans as $t ) {
                if ($trac[$i]['chrono'] == $t['camion']) {
                    $trac[$i][0]++;
                }
            }
        }
        
        return $this->sortDriversByCount($trac);
    }

    public function sortDriversByCount($drivers) {
        usort($drivers, function($a, $b) {
          return $b[0] - $a[0];
        });
      
        return $drivers;
      }
}
