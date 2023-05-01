<?php

namespace App\Controllers;

use App\Models\ModelTransfert;
use App\Models\ModeleLivraison;
use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Facturation extends BaseController
{
    public function index()
    {
        return view('rapport/dashboard');
    }

    public function generate(){
        if ($this->request->getPost('type') == 'livraison') {
            $this->generateReportLivraison($this->request->getPost('m'),$this->request->getPost('y'));
        }else {
            $this->generateReportTransfert($this->request->getPost('m'),$this->request->getPost('y'));
        }
    }

    public function generateReportLivraison($m, $y)
    {
        // Récupération des livraisons du mois courant
        $livraisons = (new ModeleLivraison())
            ->where('date_retour IS NOT NULL')
            ->where('MONTH(date_livraison)', $m)
            ->where('YEAR(date_livraison)', $y)
            ->findAll();

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
        $filename = 'rapport_livraisons_' . $m . '_' . $y . '.xlsx';
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        $writer->save('php://output');
    }

    public function generateReportTransfert($m, $y)
    {
        // Récupération des transferts du mois en cours
        $transfers = (new ModelTransfert())
            ->where('eirs','OK')
            ->where('MONTH(date_mvt)', $m)
            ->where('YEAR(date_mvt)', $y)
            ->findAll();

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
        $filename = 'rapport_transferts_'  . $m . '_' . $y . '.xls';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer = new Xls($spreadsheet);
        if ($writer->save('php://output')) {

            return redirect()->back();
        }
    }
}
