<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Modelegarage;
use App\Models\ModelRemorque;
use App\Models\ModelTracteur;

class Garagiste extends BaseController
{
    public function index()
    {
        $data = [
            'trs' => (new ModelTracteur())->findAll(),
            'rms' => (new ModelRemorque())->findAll(),
        ];
        return view('garagiste/dashboard',$data);
    }

    public function ajouter(){
        $data = $this->request->getVar();
        unset($data['type']);
        $model = new Modelegarage();
        try {
            $model->insert($data);
        } catch (\Throwable $th) {

            return redirect()->back()->with('ops',false);
        }
        return redirect()->back()->with('ops',true);

    }
}
