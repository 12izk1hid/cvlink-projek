<?php

namespace App\Controllers;

use App\Models\UsersModel;


class Home extends BaseController
{

    protected $usersModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
    }

    public function login()
    {
        return view('page-login');
    }

    public function ceklogin()
    {
        $session = session();
        $userModel = new UsersModel();
        $username     = $this->request->getVar('username');
        $password     = hash('sha256', $this->request->getPost('password'));
        $user = $userModel->where("username ='$username' AND password='$password'")->first();
        if ($user) {
            $session->set('id', $user['id']);
            $session->set('username', $user['username']);
            $session->set('id_level', $user['role']);
            $session->set('nama', $user['nama']);
            $session->set('isLogin', true);

            if ($user['role'] == 'admin') {
                return redirect()->to(base_url('admin'));
            } else if ($user['role'] == 'klien') {
                return redirect()->to(base_url('client'));
            } else if($user['role'] == 'surveyor') {
                return redirect()->to(base_url('surveyor'));
            }
        } else {
            $session->setFlashdata('pesan', 
                '<div class="alert alert-danger text-center alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>Ops! Password atau Username salah</h4>
                </div>'
        );
            return redirect()->to(base_url('login'));
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url());
    }

    public function register() 
    {
        return view('clients/register');
    }

    public function save()
    {
        $insert = [
            'nama'      => $this->request->getPost('nama'),
            'username'  => $this->request->getPost('username'),
            'password'  => hash('sha256', $this->request->getPost('password')), // Hash password
            'alamat'    => $this->request->getPost('alamat'),
            'email'     => $this->request->getPost('email'),
            'no_hp'     => $this->request->getPost('no_hp'),
            'role'      => $this->request->getPost('role'),
        ];

        $this->usersModel->insert($insert);
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
