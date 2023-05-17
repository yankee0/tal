<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Carburant as ModelsCarburant;
use App\Models\ModelRemorque;
use App\Models\ModelTracteur;

class Carburant extends BaseController
{
    public function index()
    {
       return view('carburant/dashboard',[
        'trs' => (new ModelTracteur())->findAll(),
        'hms' => (new ModelRemorque())->where('genre','HAMMAR')->findAll()
       ]);
    }

    public function ajouter(){
        if ((new ModelsCarburant())->insert($this->request->getVar())) {
            return redirect()->back()->with('ops',true);
        } else {
            return redirect()->back()->with('ops',false);
        }
    }
}
