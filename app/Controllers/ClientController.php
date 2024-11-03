<?php

namespace App\Controllers;

use App\Models\JasaModel;
use App\Models\InvoiceModel;
use App\Models\UsersModel;

class ClientController extends BaseController
{
    protected $jasaModel;
    protected $invoiceModel;
    protected $usersModel;

    public function __construct()
    {
        $this->jasaModel = new JasaModel();
        $this->invoiceModel = new InvoiceModel();
        $this->usersModel = new UsersModel();
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

    public function order()
    {
        $session = session();
        if (!empty($session->get('username')) && !empty($session->get('id_level'))) {
            return view('clients/layout/header')
                .view('clients/layout/navigasi', ['loged' => true])
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
        $session = session();
        $username = $session->get('username'); // Ambil username dari session

        // Ambil data pengguna dari database berdasarkan username
        $user = $this->usersModel->where('username', $username)->first();

        // Cek apakah data pengguna ditemukan
        if (!$user) {
            return redirect()->to(base_url('login'));
        }

        // Kirim data $user ke view
        $data = [
            'user' => $user,
            'loged' => true
        ];

        return view('clients/layout/header')
            .view('clients/layout/navigasi', $data)
            .view('clients/profile', $data)
            .view('clients/layout/footer');
    }

    public function saveOrder()
    {
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
