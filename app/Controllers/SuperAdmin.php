<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class SuperAdmin extends BaseController
{
    public function index()
    {
        session()->position = 'dashboard';
        return view('super-admin/dashboard');
    }
}
