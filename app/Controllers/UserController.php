<?php

namespace App\Controllers;

use App\Models\UsersModel;

class UserController extends BaseController
{
    protected $usersModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
    }

    public function index()
    {
        $session = session();
        if (!empty($session->get('username')) && !empty($session->get('id_level'))) {
            $data = [
                'title' => 'users',
                'users'  => $this->usersModel->findAll()
            ];
            return view('layout/_header')
                . view('layout/_navigasi')
                . view('_users', $data) // Mengarahkan ke view jasa
                . view('layout/_footer');
        } else {
            return redirect()->to(base_url());
        }
    }

    public function save()
    {
        $session = session();
        if (!empty($session->get('username')) && !empty($session->get('id_level'))) {
            $insert = [
            'nama'      => $this->request->getPost('nama'),
            'username'  => $this->request->getPost('username'),
            'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT), // Hash password
            'alamat'    => $this->request->getPost('alamat'),
            'email'     => $this->request->getPost('email'),
            'no_hp'     => $this->request->getPost('no_hp'),
            'role'      => $this->request->getPost('role'),
        ];

        $this->usersModel->insert($insert);
            $session->setFlashdata(
                'pesan',
                '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Berhasil simpan data pengguna</h4>
                </div>'
            );
            return redirect()->to(base_url() . 'infousers');
        } else {
            return redirect()->to(base_url());
        }
    }

    public function update()
    {
        $session = session();
        if (!empty($session->get('username')) && !empty($session->get('id_level'))) {
            $update = [
                'id'        => $this->request->getPost('id'),
                'nama'      => $this->request->getPost('nama'),
                'username'  => $this->request->getPost('username'),
                'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT), // Hash password
                'alamat'    => $this->request->getPost('alamat'),
                'email'     => $this->request->getPost('email'),
                'no_hp'     => $this->request->getPost('no_hp'),
                'role'      => $this->request->getPost('role'),
            ];
            $where = [
                'id'   => $this->request->getVar('id'),  // Mendapatkan ID jasa dari form
            ];
            $this->usersModel->update($where['id'], $update);
            $session->setFlashdata(
                'pesan',
                '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Berhasil update data jasa</h4>
                </div>'
            );
            return redirect()->to(base_url() . 'infousers');
        } else {
            return redirect()->to(base_url());
        }
}
 // Fungsi untuk menghapus user
 public function delete() {
    $id = $this->request->getGet('id'); // Mengambil ID dari query string
    $session = session();

    if (!empty($session->get('id')) && !empty($session->get('id_level'))) {
        // Memeriksa apakah penghapusan data berhasil
        if ($this->usersModel->delete($id)) {
            // Set pesan sukses ke session
            $session->setFlashdata(
                'pesan',
                '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Berhasil menghapus data jasa</h4>
                </div>'
            );
        } else {
            // Set pesan gagal ke session
            $session->setFlashdata(
                'pesan',
                '<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-times"></i> Gagal menghapus data jasa</h4>
                </div>'
            );
        }
        // Redirect ke halaman info jasa setelah penghapusan
        return redirect()->to(base_url('infousers'));

    } else {
        return redirect()->to(base_url('infousers'));

    }
}
}