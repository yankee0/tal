<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelChauffeur;
use App\Models\ModelTracteur;

class OpsTal extends BaseController
{
    public function index()
    {
        return view('ops-tal/dashboard');
    }

    public function transfert(){
        $donnees = [
            'tracteurs' => (new ModelTracteur())->findAll(),
            'chauffeurs' => (new ModelChauffeur())->findAll()
        ];
        return view('utils/transferts/ajouter',$donnees);
    }

    public function ajouter_transfert(){
        // if (()) {
        //     # code...
        // }
    }
}
