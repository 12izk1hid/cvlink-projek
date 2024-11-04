<?php

namespace App\Controllers;

use App\Models\JasaModel;
use App\Models\KontrakModel;
use App\Models\InvoiceModel;
use App\Models\PemasanganModel;
use App\Models\SurveiModel;
use App\Models\UsersModel;


class AdminController extends BaseController
{
    protected $jasaModel;
    protected $kontrakModel;
    protected $invoiceModel;
    protected $pemasanganModel;
    protected $surveiModel;
    protected $usersModel;

    public function __construct()
    {
        $session = session();
        if (!empty($session->get('username')) and !empty($session->get('id_level'))) {
            if($session->get('id_level') === 'admin') {
                $this->jasaModel = new JasaModel();
                $this->kontrakModel = new KontrakModel();
                $this->invoiceModel = new InvoiceModel();
                $this->pemasanganModel = new PemasanganModel();
                $this->surveiModel = new SurveiModel();
                $this->usersModel = new UsersModel();
            } else {
                echo view('errors/forbidden', ['message' => 'NNN']);
                exit();
            }
        } else {
            header('Location: ' . base_url('login'));
            exit();
        }
    }

    public function index()
    {
        $session = session();
        if (!empty($session->get('username')) and !empty($session->get('id_level'))) {
            $data = [
                'title' => 'WGSL'
            ];
            return view('layout/_header')
                . view('layout/_navigasi')
                . view('layout/_content', $data)
                . view('layout/_footer');
        } else {
            return redirect()->to(base_url());
        }
    }

}
