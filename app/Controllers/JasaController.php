<?php

namespace App\Controllers;

use App\Controllers\AdminController;

class JasaController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $session = session();
        if (!empty($session->get('username')) && !empty($session->get('id_level'))) {
            $data = [
                'title' => 'Jasa',
                'jasa'  => $this->jasaModel->findAll()
            ];
            return view('layout/_header')
                . view('layout/_navigasi')
                . view('_jasa', $data)
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
                'photo_url' => $this->request->getVar('photo_url'), // Menyimpan URL gambar
                'idupdate'  => $session->get('id'),
            ];
            $this->jasaModel->insert($insert);
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
                'photo_url' => $this->request->getVar('photo_url'), // Mengupdate URL gambar
                'idupdate'  => $session->get('id'),
            ];
            $where = [
                'id' => $this->request->getVar('id'),
            ];
            $this->jasaModel->update($where['id'], $update);
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
    public function delete()
    {
        $id = $this->request->getGet('id');
        $session = session();

        if (!empty($session->get('id')) && !empty($session->get('id_level'))) {
            if ($this->jasaModel->delete($id)) {
                $session->setFlashdata(
                    'pesan',
                    '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Berhasil menghapus data jasa</h4>
                    </div>'
                );
            } else {
                $session->setFlashdata(
                    'pesan',
                    '<div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-times"></i> Gagal menghapus data jasa</h4>
                    </div>'
                );
            }
            return redirect()->to(base_url('infojasa'));
        } else {
            return redirect()->to(base_url('infojasa'));
        }
    }
}
