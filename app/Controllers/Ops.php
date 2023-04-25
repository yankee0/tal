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

        ]);
    }

    public function ajouter_transfert()
    {
        $data = $this->request->getPost();
        if ($data['choixch'] == 'tal') {
            $data['chauffeur'] = $data['cht'];
        }
        else {
            $data['chauffeur'] = $data['chs'];
        }
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

    public function generateMonthlyReportTransfert()
    {
        // Récupération des transferts du mois en cours
        $transfers = (new ModelTransfert())->where('MONTH(date_mvt)', date('m'))->findAll();

        // Création du fichier Excel
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Rapport transferts');

        // Entête du tableau
        $header = ['Type transfert', 'Date mouvement', 'Conteneur', 'Type conteneur', 'TEUs', 'Ligne', 'Rame', 'Mouvement', 'PV', 'Chauffeur', 'Remarque ST', 'Imm. tracteur', 'Chrono', 'EIRS'];
        $sheet->fromArray($header, NULL, 'A1');

        // Corps du tableau
        $body = [];
        foreach ($transfers as $transfer) {
            $body[] = [
                $transfer['type_transfert'],
                $transfer['date_mvt'],
                $transfer['conteneur'],
                $transfer['type_conteneur'],
                $transfer['teus'],
                $transfer['ligne'],
                $transfer['rame'],
                $transfer['mouvement'],
                $transfer['p_v'],
                $transfer['chauffeur'],
                $transfer['remarque_sous_traitant'],
                $transfer['imm_tracteur'],
                $transfer['chrono'],
                $transfer['eirs']
            ];
        }
        $sheet->fromArray($body, NULL, 'A2');

        // Enregistrement du fichier
        $filename = 'rapport_transferts_' . date('Y-m') . '.xls';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer = new Xls($spreadsheet);
        if ($writer->save('php://output')) {

            return redirect()->back();
        }
    }



    public function generateMonthlyReportLivraison()
    {
        // Récupération des livraisons du mois courant
        $livraisons = (new ModeleLivraison())->where('MONTH(date_livraison)', date('m'))->findAll();

        // Création du fichier Excel
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Ajout des en-têtes de colonnes
        $headers = ['Date de dépôt BL', 'Date de livraison', 'Conteneur', 'Armateur', 'Type de TC', 'Camion', 'Chauffeur aller', 'Mvt aller', 'Adresse', 'Zone', 'Client', 'Date de retour', 'Chauffeur retour', 'Mvt retour', 'Date de validité'];
        $sheet->fromArray($headers, null, 'A1');

        // Ajout des données des livraisons
        $row = 2;
        foreach ($livraisons as $livraison) {
            $data = [
                $livraison['date_depot_bl'],
                $livraison['date_livraison'],
                $livraison['conteneur'],
                $livraison['armateur'],
                $livraison['type_tc'],
                $livraison['camion'],
                $livraison['chauffeur_aller'],
                $livraison['mvt_aller'],
                $livraison['adresse'],
                $livraison['zone'],
                $livraison['client'],
                $livraison['date_retour'],
                $livraison['chauffeur_retour'],
                $livraison['mvt_retour'],
                $livraison['date_validite']
            ];
            $sheet->fromArray($data, null, 'A' . $row);
            $row++;
        }

        // Enregistrement du fichier
        $filename = 'rapport_livraisons_' . date('Y-m') . '.xlsx';
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        $writer->save('php://output');
    }
}
