<?php

namespace App\Controllers;

use App\Models\JasaModel;
use App\Models\InvoiceModel;

class ClientController extends BaseController
{

    protected $jasaModel;
    protected $invoiceModel;

    public function __construct()
    {
        $this->jasaModel = new JasaModel();
        $this->invoiceModel = new InvoiceModel();
    }

    public function index()
    {
        $session = session();
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

    public function saveOrder() {
        $session = session();
        if (!empty($session->get('username')) && !empty($session->get('id_level'))) {
            $insert = [
                'username' => $session->get('username'),
                'harga' => 0,
                'status' => 'unsurveyed',
                'request_description' => $this->request->getPost('service')
            ];

            $this->invoiceModel->insert($insert);
            $session->setFlashdata(
                'pesan',
                '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Berhasil menyimpan data invoice</h4>
                </div>'
            );
            return redirect()->to(base_url('client/order'));
        } else {
            return redirect()->to(base_url());
        }
    }
    
}
