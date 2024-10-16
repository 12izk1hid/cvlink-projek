<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JasaModel;

class JasaController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new JasaModel();
    }

    public function index()
    {
        $session = session();
        if (!empty($session->get('username')) && !empty($session->get('id_level'))) {
            $data = [
                'title' => 'Jasa',
                'jasa'  => $this->model->findAll()
            ];
            return view('layout/_header')
                . view('layout/_navigasi')
                . view('_jasa', $data) // Mengarahkan ke view jasa
                . view('layout/_footer');
        } else {
            return redirect()->to(base_url());
        }
    }

    // Fungsi untuk menyimpan jasa baru
    public function simpanjasa()
    {
        $session = session();
        if (!empty($session->get('username')) && !empty($session->get('id_level'))) {
            $insert = [
                'nama_item' => $this->request->getVar('nama_item'),
                'type'      => $this->request->getVar('type'),
                'min_harga' => $this->request->getVar('min_harga'),
                'max_harga' => $this->request->getVar('max_harga'),
                'idupdate'  => $session->get('id'),  // Simpan ID user yang update
            ];
            $this->model->insert($insert);
            $session->setFlashdata(
                'pesan',
                '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Berhasil simpan data jasa</h4>
                </div>'
            );
            return redirect()->to(base_url() . 'infojasa');
        } else {
            return redirect()->to(base_url());
        }
    }

    // Fungsi untuk mengupdate jasa
    public function updatejasa()
    {
        $session = session();
        if (!empty($session->get('username')) && !empty($session->get('id_level'))) {
            $update = [
                'nama_item' => $this->request->getVar('nama_item'),
                'type'      => $this->request->getVar('type'),
                'min_harga' => $this->request->getVar('min_harga'),
                'max_harga' => $this->request->getVar('max_harga'),
                'idupdate'  => $session->get('id'),  // ID user yang update
            ];
            $where = [
                'id'   => $this->request->getVar('id'),  // Mendapatkan ID jasa dari form
            ];
            $this->model->update($where['id'], $update);
            $session->setFlashdata(
                'pesan',
                '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Berhasil update data jasa</h4>
                </div>'
            );
            return redirect()->to(base_url() . 'infojasa');
        } else {
            return redirect()->to(base_url());
        }
    }

    // Fungsi untuk menghapus jasa
    public function delete() {
        $id = $this->request->getGet('id'); // Mengambil ID dari query string
        $session = session();

        if (!empty($session->get('id')) && !empty($session->get('id_level'))) {
            // Memeriksa apakah penghapusan data berhasil
            if ($this->model->delete($id)) {
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
            return redirect()->to(base_url('infojasa'));

        } else {
            return redirect()->to(base_url('infojasa'));

        }
    }
}
