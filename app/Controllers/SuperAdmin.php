<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelTracteur;
use App\Models\ModelChauffeur;
use App\Models\ModeleControle;
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
            'tcm' => $this->tcm(),
            'mcm' => $this->mcm(),

            'vt' => (new ModeleControle())->where('fin <', date('Y-m-d'))->findAll(),
        ];
        return view('super-admin/dashboard', $donnees);
    }

    // mouvement camion mensuel
    public function mcm()
    {
        $cs = (new ModelTracteur())->findAll();
        $ts = (new ModelTransfert())->where('MONTH(date_mvt)', date('m'))->find();
        $ls = (new ModeleLivraison())->where('MONTH(date_livraison)', date('m'))->find();
        $rs = [];

        for ($i = 0; $i < sizeof($cs); $i++) {
            $rs[$i]['chrono'] = $cs[$i]['chrono'];
            $rs[$i]['ops'] = 0;
        }

        foreach ($ts as $t) {
            for ($i = 0; $i < sizeof($rs); $i++) {
                if ($rs[$i]['chrono'] == $t['chrono']) {
                    $rs[$i]['ops']++;
                }
            }
        }

        foreach ($ls as $l) {
            for ($i = 0; $i < sizeof($rs); $i++) {
                if ($rs[$i]['chrono'] == $l['camion']) {
                    $rs[$i]['ops']++;
                }
            }
        }

        return $this->trierParTeus($rs);
    }

    //teus cheuffeur mensuel
    public function tcm()
    {

        $cs = (new ModelChauffeur())->findAll();
        $ts = (new ModelTransfert())->where('MONTH(date_mvt)', date('m'))->find();
        $rs = [];

        for ($i = 0; $i < sizeof($cs); $i++) {
            $rs[$i]['matricule'] = $cs[$i]['matricule'];
            $rs[$i]['nom'] = $cs[$i]['prenom'] . ' ' . $cs[$i]['nom'];
            $rs[$i]['teus'] = 0;
        }

        foreach ($ts as $t) {
            foreach ($cs as $c) {
                if ($t['chauffeur'] == $c['matricule']) {
                    for ($i = 0; $i < sizeof($rs); $i++) {
                        if ($rs[$i]['matricule'] == $c['matricule']) {
                            $rs[$i]['teus'] += $t['teus'];
                        }
                    }
                };
            }
        }

        return $this->trierParTeus($rs);
    }

    function trierParTeus($tableau)
    {
        usort($tableau, function ($a, $b) {
            return $b['teus'] - $a['teus'];
        });
        return $tableau;
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
}
