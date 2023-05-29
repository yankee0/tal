<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\ModelTracteur;
use App\Models\ModelChauffeur;
use App\Models\ModeleControle;
use App\Models\ModelRemorque;
use App\Models\ModelUtilisateur;

class Admin extends BaseController
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
        return view('admin/dashboard', $donnees);
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
            'prenom' => ucwords('' . $this->request->getPost('prenom')),
            'nom' => ucwords('' . $this->request->getPost('nom')),
            'matricule' => strtoupper('' . $this->request->getPost('matricule')),
            'profil' => $this->request->getPost('profil'),
            'mot_de_passe' => sha1('TALSA1234')
        ];

        $model = new ModelUtilisateur();
        $model->insert($donnees);

        if ($model->first($donnees['matricule'])) {
            return redirect()->back()->with('success', true);
        } else {
            return redirect()->back()->withInput()->with('error', true);
        }
    }

    public function supprimer_utilisateur($matricule = null)
    {
        $model = new ModelUtilisateur();
        if ($model->delete($matricule)) {
            return redirect()->to(session()->root . '/utilisateurs#tableau')->with('deleted', true);
        } else {
            return redirect()->to(session()->root . '/utilisateurs#tableau')->with('deleted', false);
        }
    }

    public function reset_utilisateur(string $matricule = null)
    {
        $data = [
            'matricule' => $matricule,
            'mot_de_passe' => sha1('TALSA1234')
        ];
        $op = (new ModelUtilisateur())->update($matricule,$data);
        return redirect()->to(session()->root . '/utilisateurs#tableau')->with('updated', $op);
    }

    public function liste_chauffeurs()
    {
        session()->position = 'chauffeurs';
        $donnees = [
            'chauffeurs' => (new ModelChauffeur())->findAll(),
        ];
        return view('utils/chauffeurs/liste', $donnees);
    }

    public function nouveau_chauffeur()
    {

        $donnees = [
            'prenom' => ucwords('' . $this->request->getPost('prenom')),
            'nom' => ucwords('' . $this->request->getPost('nom')),
            'matricule' => strtoupper('' . $this->request->getPost('matricule')),
        ];

        $model = new ModelChauffeur();
        $model->insert($donnees);

        if ($model->first($donnees['matricule'])) {
            return redirect()->back()->with('success', true);
        } else {
            return redirect()->back()->withInput()->with('error', true);
        }
    }

    public function supprimer_chauffeur($matricule = null)
    {
        $model = new ModelChauffeur();
        if ($model->delete($matricule)) {
            return redirect()->to(session()->root . '/chauffeurs#tableau')->with('deleted', true);
        } else {
            return redirect()->to(session()->root . '/chauffeurs#tableau')->with('deleted', false);
        }
    }

    public function liste_tracteurs()
    {
        session()->position = 'tracteurs';
        $donnees = [
            'tracteurs' => (new ModelTracteur())->findAll(),
            'remorques' => (new ModelRemorque())->findAll(),
        ];
        return view('utils/tracteurs/liste', $donnees);
    }

    public function nouveau_tracteur()
    {

        $donnees = [
            'chrono' => strtoupper('' . $this->request->getPost('chrono')),
            'immatriculation' => strtoupper('' . $this->request->getPost('immatriculation')),
            'ancienne_immatriculation' => strtoupper('' . $this->request->getPost('ancienne_immatriculation')),
            'marque' => strtoupper('' . $this->request->getPost('marque')),
            'modele' => strtoupper('' . $this->request->getPost('modele')),
            'au_rebut' => strtoupper('' . $this->request->getPost('au_rebut')),
            'remarque' => strtoupper('' . $this->request->getPost('remarque')),
        ];

        $model = new ModelTracteur();
        $model->insert($donnees);

        if ($model->first($donnees['chrono'])) {
            return redirect()->back()->with('success', true);
        } else {
            return redirect()->back()->withInput()->with('error', true);
        }
    }

    public function supprimer_tracteur($matricule = null)
    {
        $model = new ModelTracteur();
        if ($model->delete($matricule)) {
            return redirect()->to(session()->root . '/tracteurs#tableau')->with('deleted', true);
        } else {
            return redirect()->to(session()->root . '/tracteurs#tableau')->with('deleted', false);
        }
    }

    public function modifier_tracteur(string $matricule = null ){
        $data = [
            'tracteur' => (new ModelTracteur())->find($matricule)
        ];
        return view('utils/tracteurs/modifier',$data);
    }

    public function save_tracteur(string $chrono){
        $data = [
            'chrono' => strtoupper('' . $this->request->getPost('chrono')),
            'immatriculation' => strtoupper('' . $this->request->getPost('immatriculation')),
            'ancienne_immatriculation' => strtoupper('' . $this->request->getPost('ancienne_immatriculation')),
            'marque' => strtoupper('' . $this->request->getPost('marque')),
            'modele' => strtoupper('' . $this->request->getPost('modele')),
            'au_rebut' => strtoupper('' . $this->request->getPost('au_rebut')),
            'remarque' => strtoupper('' . $this->request->getPost('remarque')),
        ];
        $op = (new ModelTracteur())->update($chrono,$data);
        return redirect()->to(session()->root . '/tracteurs#tableau')->with('updated', $op);
    }

    public function liste_remorques()
    {
        session()->position = 'remorques';
        $donnees = [
            'remorques' => (new ModelRemorque())->findAll(),
        ];
        return view('utils/remorques/liste', $donnees);
    }

    public function nouveau_remorque()
    {

        $donnees = [
            'chrono' => strtoupper('' . $this->request->getPost('chrono')),
            'immatriculation' => strtoupper('' . $this->request->getPost('immatriculation')),
            'ancienne_immatriculation' => strtoupper('' . $this->request->getPost('ancienne_immatriculation')),
            'genre' => strtoupper('' . $this->request->getPost('genre')),
            'au_rebut' => strtoupper('' . $this->request->getPost('au_rebut')),
            'remarque' => strtoupper('' . $this->request->getPost('remarque')),
        ];

        $model = new ModelRemorque();
        $model->insert($donnees);

        if ($model->first($donnees['chrono'])) {
            return redirect()->back()->with('success', true);
        } else {
            return redirect()->back()->withInput()->with('error', true);
        }
    }

    public function supprimer_remorque($matricule = null)
    {
        $model = new ModelRemorque();
        if ($model->delete($matricule)) {
            return redirect()->to(session()->root . '/remorques#tableau')->with('deleted', true);
        } else {
            return redirect()->to(session()->root . '/remorques#tableau')->with('deleted', false);
        }
    }

    public function modifier_remorque(string $matricule = null ){
        $data = [
            'remorque' => (new ModelRemorque())->find($matricule)
        ];
        return view('utils/remorques/modifier',$data);
    }

    public function save_remorque(string $chrono){
        $data = [
            'chrono' => strtoupper('' . $this->request->getPost('chrono')),
            'immatriculation' => strtoupper('' . $this->request->getPost('immatriculation')),
            'ancienne_immatriculation' => strtoupper('' . $this->request->getPost('ancienne_immatriculation')),
            'au_rebut' => strtoupper('' . $this->request->getPost('au_rebut')),
            'remarque' => strtoupper('' . $this->request->getPost('remarque')),
        ];
        $op = (new ModelRemorque())->update($chrono,$data);
        return redirect()->to(session()->root . '/remorques#tableau')->with('updated', $op);
    }

    public function dossier_tracteur(string $chrono)
    {
        $data = [
            'tracteur' => (new ModelTracteur())->find($chrono),
            'controle_vt' => (new ModeleControle())->where(
                [
                    'chrono_tracteur' => $chrono,
                    'actif' => 'y',
                    'type' => 'VT'
                ]
            )->first(),
            'controle_as' => (new ModeleControle())->where(
                [
                    'chrono_tracteur' => $chrono,
                    'actif' => 'y',
                    'type' => 'AS'
                ]
            )->first(),
            'controle_cat' => (new ModeleControle())->where(
                [
                    'chrono_tracteur' => $chrono,
                    'actif' => 'y',
                    'type' => 'CATS'
                ]
            )->first()
        ];
        return view('utils/controles/tracteur', $data);
    }

    public function dossier_remorque(string $chrono)
    {
        $data = [
            'remorque' => (new ModelRemorque())->find($chrono),
            'controle_vt' => (new ModeleControle())->where(
                [
                    'chrono_remorque' => $chrono,
                    'actif' => 'y',
                    'type' => 'VT'
                ]
            )->first(),
            'controle_as' => (new ModeleControle())->where(
                [
                    'chrono_remorque' => $chrono,
                    'actif' => 'y',
                    'type' => 'AS'
                ]
            )->first(),
            'controle_cat' => (new ModeleControle())->where(
                [
                    'chrono_remorque' => $chrono,
                    'actif' => 'y',
                    'type' => 'CATS'
                ]
            )->first()
        ];
        return view('utils/controles/remorque', $data);
    }

    public function handle_r_controle(string $action, string $chrono)
    {

        
        (new ModeleControle())->where(
            [
                'chrono_remorque' => $chrono,
                'type' => $action,
                'actif' => 'y',
            ]
        )->set(
            [
                'actif' => 'n'
            ]
        )->update();

        $data = [
            'chrono_remorque' => $chrono,
            'type' => $action,
            'debut' => $this->request->getPost('debut'),
            'fin' => $this->request->getPost('fin')
        ];

        if ((new ModeleControle())->insert($data)) {
            return redirect()->back()->with('success', true);
        } else {
            return redirect()->back()->with('error', true);
        }
    }

    public function handle_t_controle(string $action, string $chrono)
    {

        (new ModeleControle())->where(
            [
                'chrono_tracteur' => $chrono,
                'type' => $action,
                'actif' => 'y',
            ]
        )->set(
            [
                'actif' => 'n'
            ]
        )->update();

        $data = [
            'chrono_tracteur' => $chrono,
            'type' => $action,
            'debut' => $this->request->getPost('debut'),
            'fin' => $this->request->getPost('fin')
        ];

        if ((new ModeleControle())->insert($data)) {
            return redirect()->back()->with('success', true);
        } else {
            return redirect()->back()->with('error', true);
        }
    }
}
