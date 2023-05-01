<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelUtilisateur;

class Authentification extends BaseController
{
  public function index()
  {
    return view('page_de_connexion');
  }

  public function connexion()
  {

    $matricule = strtoupper('' . $this->request->getPost('login'));
    $mot_de_passe = sha1('' . $this->request->getPost('mdp'));

    $model = new ModelUtilisateur();

    $utilisateur = $model->where([
      'matricule' => $matricule,
      'mot_de_passe' => $mot_de_passe,
    ])->first();

    if ($utilisateur) {
      session()->donnees_utilisateur = $utilisateur;
      return redirect()->to('/redirection');
    } else {
      return redirect()->back()->with('erreur', true);
    }
  }

  public function redirection()
  {
    switch (session()->donnees_utilisateur['profil']) {

      case 'SUPER ADMIN':
        $destination  = '/super-admin';
        break;

      case 'ADMIN':
        $destination  = '/admin';
        break;

      case 'OPS':
        $destination  = '/ops';
        break;

      case 'FACTURATION':
        $destination  = '/facturation';
        break;

      default:
        $this->deconnexion();
        break;
    }
    return redirect()->to($destination);
  }

  public function deconnexion()
  {
    session()->remove('donnees_utilisateur');
    return redirect()->to('/');
  }
}
