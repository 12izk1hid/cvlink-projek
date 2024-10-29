<?php

namespace App\Controllers;

use App\Models\UsersModel;


class Home extends BaseController
{


    public function __construct()
    {
    }

    public function index()
    {
        //return view('welcome_message');
        return view('page-login');
    }

    // public function ceklogin()
    // {
    //     $session = session();
    //     $userModel = new UserModel();
    //     $username     = $this->request->getVar('username');
    //     $password     = md5($this->request->getVar('password'));
    //     dd($userModel->findAll());
    //     $user = $userModel->where("username ='$username' AND password='$password'")->first();
    //     if ($user) {
    //         $session->set('id', $user['id']);
    //         $session->set('username', $user['username']);
    //         $session->set('id_level', $user['id_level']);
    //         $session->set('nama', $user['nama']);
    //         $session->set('isLogin', true);

    //         if ($user['id_level'] == '1') {
    //             return redirect()->to(base_url('./admin'));
    //         } else if ($user['id_level'] == '2') {

    //             return redirect()->to(base_url('./manager'));
    //         }
    //     } else {
    //         $session->setFlashdata('pesan', 'Oppsss! Username atau password Salah');
    //         return redirect()->to(base_url('.'));
    //     }
    // }

    public function ceklogin()
    {
        $session = session();
        $userModel = new UsersModel();
        $username     = $this->request->getVar('username');
        $password     = md5($this->request->getVar('password'));
        // dd($userModel->findAll());
        $user = $userModel->where("username ='$username' AND password='$password'")->first();
        if ($user) {
            $session->set('id', $user['id']);
            $session->set('username', $user['username']);
            $session->set('id_level', $user['role']);
            $session->set('nama', $user['nama']);
            $session->set('isLogin', true);

            if ($user['role'] == 'admin') {
                return redirect()->to(base_url('./admin'));
            } else if ($user['role'] == 'klien') {

                return redirect()->to(base_url('./manager'));
            }
        } else {
            $session->setFlashdata('pesan', 'Oppsss! Username atau password Salah');
            return redirect()->to(base_url('.'));
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('.'));
    }
}
