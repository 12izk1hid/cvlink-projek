<?php

namespace App\Controllers;

use App\Models\JasaModel;

class ClientDashboardController extends BaseController
{

    protected $jasaModel;

    public function __construct()
    {
        $this->jasaModel = new JasaModel();
    }

    public function index()
    {
        $session = session();
        // $services = $jasaModel->findAll(); 
        $data = [
            'loged' => !empty($session->get('username')) && !empty($session->get('id_level'))
        ];

        return view('clients/layout/header')
            .view('clients/layout/navigasi', $data)
            .view('clients/index')
            .view('clients/layout/footer');
    }

    public function order() {
        $session = session();
        if (!empty($session->get('username')) && !empty($session->get('id_level'))) {
            return view('clients/layout/header')
                .view('clients/layout/navigasi', [ 'loged' => true])
                .view('clients/order', [
                    'username' => $session->get('username'),
                    'services' => $this->jasaModel->getJasa()
                ])
                .view('clients/layout/footer');
        } else {
            return redirect()->to(base_url('login'));
        }
    }

    public function profile()
    {
        return view('clients/layout/header')
                .view('clients/layout/navigasi', [ 'loged' => true])
                .view('clients/profile', [])
                .view('clients/layout/footer');
    }

    
}
