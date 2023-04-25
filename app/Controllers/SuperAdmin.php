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
            'top4' => $this->Top4Chauffeurs()
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
        // Récupération des 4 chauffeurs ayant effectué le plus de transferts au cours du mois en cours
        $top4Transferts = $this->db->table('transferts')
            ->select('COUNT(*) AS totalTransferts, chauffeurs.matricule, chauffeurs.nom, chauffeurs.prenom')
            ->join('chauffeurs', 'chauffeurs.matricule = transferts.chauffeur')
            ->where('MONTH(date_mvt)', date('m'))
            ->groupBy('chauffeurs.matricule')
            ->orderBy('totalTransferts', 'DESC')
            ->limit(4)
            ->get()
            ->getResultArray();

        // Récupération des 4 chauffeurs ayant effectué le plus de livraisons au cours du mois en cours
        $top4Livraisons = $this->db->table('livraisons')
            ->select('COUNT(*) AS totalLivraisons, chauffeurs.matricule, chauffeurs.nom, chauffeurs.prenom')
            ->join('chauffeurs', 'chauffeurs.matricule = livraisons.chauffeur_retour')
            ->where('MONTH(date_livraison)', date('m'))
            ->groupBy('chauffeurs.matricule')
            ->orderBy('totalLivraisons', 'DESC')
            ->limit(4)
            ->get()
            ->getResultArray();

        // Fusion des résultats
        $result = array_merge($top4Transferts, $top4Livraisons);

        // Tri des résultats par nombre total d'opérations (transferts + livraisons)
        usort($result, function ($a, $b) {
            return ($b['totalTransferts'] + $b['totalLivraisons']) - ($a['totalTransferts'] + $a['totalLivraisons']);
        });

        // Récupération des 4 premiers résultats
        $top4 = array_slice($result, 0, 4);

        return $top4;
    }
}
