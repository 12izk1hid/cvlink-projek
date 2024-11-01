<?php

namespace App\Controllers;

use App\Models\JasaModel;

class ClientDashboardController extends BaseController
{
    public function index()
    {
        $session = session();
        $jasaModel = new JasaModel();
        $services = $jasaModel->findAll(); 
        $data = [
            'loged' => !empty($session->get('username')) && !empty($session->get('id_level'))
        ];

        return view('clients/layout/header')
            .view('clients/layout/navigasi', $data)
            .view('clients/index')
            .view('clients/layout/footer');
    }
}
