<?php

namespace App\Controllers;

use CodeIgniter\Model;
use App\Models\ModelTracteur;
use App\Models\ModelChauffeur;
use App\Models\ModelTransfert;
use App\Models\ModeleLivraison;
use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Ops extends BaseController
{
    public function index()
    {
        $trans = (new ModelTransfert())->where('auteur', session()->donnees_utilisateur['matricule'])->findAll();
        $trans_ok = [];
        for ($i = 0; $i < sizeof($trans); $i++) {
            if ($this->isCurrentWeek($trans[$i]['created_at'])) {
                $trans_ok[$i] = $trans[$i];
            }
        }

        $liv = (new ModeleLivraison())->where('auteur', session()->donnees_utilisateur['matricule'])->findAll();
        $liv_ok = [];
        for ($i = 0; $i < sizeof($liv); $i++) {
            if ($this->isCurrentWeek($liv[$i]['created_at'])) {
                $liv_ok[$i] = $liv[$i];
            }
        }

        $data = [
            'trans' => $trans_ok,
            'liv' => $liv_ok
        ];
        return view('ops/dashboard', $data);
    }

    public function liste_livraison()
    {
        $data = [
            'liv' => (new ModeleLivraison())->where('date_retour', null)->find(),
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
        return view('utils/livraisons/ajout', $data);
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

        $data['auteur'] = session()->donnees_utilisateur['matricule'];


        $model = new ModeleLivraison();
        $op = $model->insert($data);
        return redirect()->back()->with('ajout', $op);
    }

    public function complement_livraison()
    {
        $data = $this->request->getPost();
        $model = new ModeleLivraison();
        $op = $model->update($data['id'], $data);
        return redirect()->back()->with('modif', $op);
    }

    public function suprimmer_livraison(string $cont)
    {
        $op = (new ModeleLivraison())->where('conteneur', $cont)->delete();
        return redirect()->back()->with('delete', $op);
    }

    public function nouveau_transfert()
    {
    
        return view('utils/transferts/ajouter',[
            'chauf' => (new ModelChauffeur())->findAll(),
            'trac' => (new ModelTracteur())->findAll()

        ]);
    }

    public function ajouter_transfert()
    {
        $data = $this->request->getPost();
        if ($data['choixch'] == 'tal') {
            $data['chauffeur'] = $data['cht'];
            $data['chrono'] = $data['camion'];
        }
        else {
            $data['chauffeur'] = $data['chs'];
        }
        unset($data['camion']);
        unset($data['choixch']);
        unset($data['cht']);
        unset($data['chs']);
        $data['auteur'] = session()->donnees_utilisateur['matricule'];


        $op = (new ModelTransfert())->insert($data);
        return redirect()->back()->with('ajout', $op);
    }

    public function suprimmer_transfert(string $cont)
    {
        $op = (new ModelTransfert())->where('conteneur', $cont)->delete();
        return redirect()->back()->with('delete', $op);
    }

    public function isCurrentWeek($date)
    {
        $currentWeek = date('W'); // Semaine du jour d'aujourd'hui
        $week = date('W', strtotime($date)); // Semaine de la date fournie en paramètre
        $year = date('Y', strtotime($date)); // Année de la date fournie en paramètre
        $currentYear = date('Y'); // Année du jour d'aujourd'hui

        // Vérifie si la date fournie en paramètre appartient à la semaine en cours
        if ($currentWeek == $week && $currentYear == $year) {
            return true;
        } else {
            return false;
        }
    }



    public function marquer_transfert(string $cont)
    {
        $op = (new ModelTransfert())->where('conteneur', $cont)->set('eirs','OK')->update();
        return redirect()->back()->with('update', $op);
    }

    public function non_eirs_transfert(){
        $data = [
            'trans' => (new ModelTransfert())->where('eirs','NON OK')->find()
        ];
        return view('utils/transferts/non-eirs',$data);
    }
}
