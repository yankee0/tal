<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelTracteur;
use App\Models\ModelChauffeur;
use App\Models\ModelRemorque;
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
        ];
        return view('super-admin/dashboard', $donnees);
    }


}
