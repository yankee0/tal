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

    public function liste_utilisateurs()
    {
        session()->position = 'utilisateurs';
        $donnees = [
            'utilisateurs' => (new ModelUtilisateur())->findAll(),
        ];
        return view('utils/utilisateurs/liste', $donnees);
    }

    public function nouvel_utilisateur()
    {
        $donnees = [
            'prenom' => ucwords(''.$this->request->getPost('prenom')),
            'nom' => ucwords(''.$this->request->getPost('nom')),
            'matricule' => strtoupper(''.$this->request->getPost('matricule')),
            'profil' => $this->request->getPost('profil'),
            'mot_de_passe' => sha1('TALSA1234')
        ];

        $success = (new ModelUtilisateur())->insert($donnees);
        if ($success == 0) {
            return redirect()->back()->with('success',true);
        } else {
            return redirect()->back()->withInput()->with('error',true);
        }

    }
}
