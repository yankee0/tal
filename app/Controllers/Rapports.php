<?php

namespace App\Controllers;

use App\Models\ModelTracteur;
use App\Models\ModelChauffeur;
use App\Models\ModelTransfert;
use App\Models\ModeleLivraison;
use App\Controllers\BaseController;
use App\Models\Carburant;
use App\Models\Modelegarage;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Rapports extends BaseController
{
    public function index()
    {
        $m = $this->request->getVar('m');
        $y = $this->request->getVar('y');
        $t = $this->request->getVar('type');

        if ($t == 'chauffeur') {
            $chs = $this->rmcc($m, $y);
            // Création du fichier Excel
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            // Ajout des en-têtes de colonnes
            $headers = ['Matricule', 'Nom', 'Nombre de TEUs'];
            $sheet->fromArray($headers, null, 'A1');
            $row = 2;
            foreach ($chs as $ch) {
                $data = [
                    $ch['matricule'],
                    $ch['nom'],
                    $ch['teus'],
                ];
                $sheet->fromArray($data, null, 'A' . $row);
                $row++;
            }
            // Enregistrement du fichier
            $filename = 'rapport_classement_chauffeurs_TEUs_Transferts_' . $m . '_' . $y . '.xlsx';
        } else {
            $trs = $this->mcm($m, $y);
            // Création du fichier Excel
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            // Ajout des en-têtes de colonnes
            $headers = ['Chrono', 'Nombre opérations'];
            $sheet->fromArray($headers, null, 'A1');
            $row = 2;
            foreach ($trs as $tr) {
                $data = [
                    $tr['chrono'],
                    $tr['ops'],
                ];
                $sheet->fromArray($data, null, 'A' . $row);
                $row++;
            }
            // Enregistrement du fichier
            $filename = 'rapport_classement_tracteurs_operations_' . $m . '_' . $y . '.xlsx';
        }

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        $writer->save('php://output');
    }
    //rapport mensuel classement chauffeurs
    public function rmcc($m, $y)
    {
        $cs = (new ModelChauffeur())->findAll();
        $ts = (new ModelTransfert())->where('MONTH(date_mvt)', $m)->where('YEAR(date_mvt)', $y)->find();
        $rs = [];

        for ($i = 0; $i < sizeof($cs); $i++) {
            $rs[$i]['matricule'] = $cs[$i]['matricule'];
            $rs[$i]['nom'] = $cs[$i]['prenom'] . ' ' . $cs[$i]['nom'];
            $rs[$i]['teus'] = 0;
        }

        if (sizeof($ts) == 0) {
            return $rs;
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

    // mouvement camion mensuel
    public function mcm($m, $y)
    {
        $cs = (new ModelTracteur())->findAll();
        $ts = (new ModelTransfert())->where('MONTH(date_mvt)', $m)->where('YEAR(date_mvt)', $y)->find();
        $ls = (new ModeleLivraison())->where('MONTH(date_livraison)', $m)->where('YEAR(date_livraison)', $y)->find();

        $rs = [];

        for ($i = 0; $i < sizeof($cs); $i++) {
            $rs[$i]['chrono'] = $cs[$i]['chrono'];
            $rs[$i]['ops'] = 0;
        }
        if (sizeof($ts) == 0 or sizeof($ls) == 0) {
            return $rs;
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


    function trierParTeus($tableau)
    {
        usort($tableau, function ($a, $b) {
            return $b['teus'] - $a['teus'];
        });
        return $tableau;
    }

    public function garage()
    {
        $m = $this->request->getVar('m');
        $y = $this->request->getVar('y');

        $gs = (new Modelegarage())->where('MONTH(date)', $m)->where('YEAR(date)', $y)->findAll();
        // Création du fichier Excel
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // Ajout des en-têtes de colonnes
        $headers = ['Chrono', 'Total', 'Date', 'Commentaire'];
        $sheet->fromArray($headers, null, 'A1');
        $row = 2;
        foreach ($gs as $g) {
            $data = [
                $g['chrono'],
                $g['total'],
                $g['date'],
                $g['commentaire'],
            ];
            $sheet->fromArray($data, null, 'A' . $row);
            $row++;
        }
        // Enregistrement du fichier
        $filename = 'rapport_garage_' . $m . '_' . $y . '.xlsx';
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        $writer->save('php://output');
    }

    public function carburant()
    {
        $m = $this->request->getVar('m');
        $y = $this->request->getVar('y');

        $gs = (new Carburant())->where('MONTH(date)', $m)->where('YEAR(date)', $y)->findAll();
        // Création du fichier Excel
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // Ajout des en-têtes de colonnes
        $headers = ['Chrono', 'Litres', 'Date'];
        $sheet->fromArray($headers, null, 'A1');
        $row = 2;
        foreach ($gs as $g) {
            $data = [
                $g['chrono'],
                $g['litres'],
                $g['date'],
            ];
            $sheet->fromArray($data, null, 'A' . $row);
            $row++;
        }
        // Enregistrement du fichier
        $filename = 'rapport_carburant_' . $m . '_' . $y . '.xlsx';
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        $writer->save('php://output');
    }

    public function tracteur()
    {
        $m = $this->request->getVar('m');
        $y = $this->request->getVar('y');

        $trs = (new ModelTracteur())->findAll();
        $tab = [];
        // dd($trs);
        foreach ($trs as $tr) {

            //carburant
            $carbs = (new Carburant())
                ->where('chrono', $tr['chrono'])
                ->where('MONTH(date)', $m)
                ->where('YEAR(date)', $y)
                ->find();
            // dd($carbs);
            $sumCarbs = 0;
            foreach ($carbs as $carb) {
                $sumCarbs += $carb['litres'];
            }
            // dd($sumCarbs);

            //garages
            $gars = (new Modelegarage())
                ->where('chrono', $tr['chrono'])
                ->where('MONTH(date)', $m)
                ->where('YEAR(date)', $y)
                ->find();
            $sumGars = 0;
            foreach ($gars as $gar) {
                $sumGars += $gar['total'];
            }
            // dd($sumGars);

            //teus
            $teuss = (new ModelTransfert())
                ->where('chrono', $tr['chrono'])
                ->where('MONTH(date_mvt)', $m)
                ->where('YEAR(date_mvt)', $y)
                ->find();
            $sumTeus = 0;
            foreach ($teuss as $teus) {
                $sumTeus += $teus['teus'];
            }
            // dd($sumTeus);

            array_push($tab, [
                'chrono' => $tr['chrono'],
                'carburant' => $sumCarbs,
                'garage' => $sumGars,
                'teus' => $sumTeus,
            ]);
        }
        // Création du fichier Excel
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // Ajout des en-têtes de colonnes
        $headers = ['Chrono', 'Carburant consommé', 'Dépannage','Teus transferts'];
        $sheet->fromArray($headers, null, 'A1');
        $row = 2;
        foreach ($tab as $t) {
            $data = [
                $t['chrono'],
                $t['carburant'],
                $t['garage'],
                $t['teus'],

            ];
            $sheet->fromArray($data, null, 'A' . $row);
            $row++;
        }
        // Enregistrement du fichier
        $filename = 'rapport_tracteur_(TEUS transferts - CARBURANT - DEPANNAGE)_' . $m . '_' . $y . '.xlsx';
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        $writer->save('php://output');
    }
}
