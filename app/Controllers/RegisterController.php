<?php

namespace App\Controllers;

use App\Models\RegisterModel;

class RegisterController extends BaseController
{
    protected $registerModel;

    public function __construct()
    {
        $this->registerModel = new RegisterModel();
    }

    public function index()
    {
        $data = [
            'title' => 'register',
        ];
        
        return view('register_view', $data); // Sesuaikan nama view
    }

    public function save()
    {
        $insert = [
            'nama'      => $this->request->getPost('nama'),
            'username'  => $this->request->getPost('username'),
            'password'  => md5($this->request->getPost('password')), // Hash password
            'alamat'    => $this->request->getPost('alamat'),
            'email'     => $this->request->getPost('email'),
            'no_hp'     => $this->request->getPost('no_hp'),
            'role'      => $this->request->getPost('role'),
        ];

        $this->registerModel->insert($insert);
        session()->setFlashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Berhasil simpan data pengguna</h4>
            </div>'
        );
        return redirect()->to(base_url('login')); // Pastikan ini sesuai dengan rute login Anda
    }
}
