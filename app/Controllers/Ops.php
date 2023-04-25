<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelChauffeur;
use App\Models\ModeleLivraison;
use App\Models\ModelTracteur;
use CodeIgniter\Model;

class Ops extends BaseController
{
    public function index()
    {
        return view('ops/dashboard');
    }

    public function liste_livraison()
    {
        $data = [
            'liv' => (new ModeleLivraison())->where('date_retour',null)->find(),
            'chauf' => (new ModelChauffeur())->findAll(),
            'trac' => (new ModelTracteur())->findAll(),
        ];
        return view('utils/livraisons/innacheves', $data);
    }

    public function nouvelle_livraison()
    {
        $data = [
            'chauf' => (new ModelChauffeur())->findAll(),
            'trac' => (new ModelTracteur())->findAll()
        ];
        return view('utils/livraisons/ajout',$data);
    }

    public function save_livraison()
    {
        $data = $this->request->getPost();
        if ($data['choix'] == 'non') {
            unset($data['date_retour']);
            unset($data['chauffeur_retour']);
            unset($data['mvt_retour']);
        }
        unset($data['choix']);
        $author = [
            'auteur' => session()
        ];
        array_merge($data,$author);
        $model = new ModeleLivraison();
        $op = $model->insert($data);
        return redirect()->back()->with('ajout',$op);
    }

    public function complement_livraison(){
        $data = $this->request->getPost();
        $model = new ModeleLivraison();
        $op = $model->update($data['id'],$data);
        return redirect()->back()->with('modif',$op);
    }

    public function suprimmer_livraison(string $cont){
        $op = (new ModeleLivraison())->where('conteneur',$cont)->delete();
        return redirect()->back()->with('delete',$op);
    }
}
