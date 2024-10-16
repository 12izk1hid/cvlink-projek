<?php

namespace App\Controllers;

use App\Models\KontrakModel;

class KontrakController extends BaseController
{
    protected $kontrakModel;

    public function __construct()
    {
        $this->kontrakModel = new KontrakModel();
    }

    public function index()
    {
        $session = session();
        if (!empty($session->get('username')) && !empty($session->get('id_level'))) {
            $data = [
                'title' => 'hasil_survei',
                'hasil_survei'  => $this->kontrakModel->findAll()
            ];
            return view('layout/_header')
                . view('layout/_navigasi')
                . view('_survei', $data) // Mengarahkan ke view jasa
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
            'id'      => $this->request->getPost('id_hasil_survei'),
            'id_surveyors'               => $this->request->getPost('id_surveyors'),
            'Tanggal_survei'        => $this->request->getPost('Tanggal_survei'),
            'Jenis_instalasi'       => $this->request->getPost('Jenis_instalasi'),
            'kebutuhan_material'     => $this->request->getPost('kebutuhan_material'),
            'estimasi_waktu'        => $this->request->getPost('estimasi_waktu'),
            'catatan_hasil_survei'   => $this->request->getPost('catatan_hasil_survei'),
        ];

        $this->kontrakModel->insert($insert);
            $session->setFlashdata(
                'pesan',
                '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Berhasil simpan data pengguna</h4>
                </div>'
            );
            return redirect()->to(base_url() . 'infokontrak');
        } else {
            return redirect()->to(base_url());
        }
    }

    public function update()
    {
        $session = session();
        if (!empty($session->get('username')) && !empty($session->get('id_level'))) {
            $update = [
              'id'      => $this->request->getPost('id'),
            'id_surveyors'               => $this->request->getPost('id_surveyors'),
            'Tanggal_survei'        => $this->request->getPost('Tanggal_survei'),
            'Jenis_instalasi'       => $this->request->getPost('Jenis_instalasi'),
            'kebutuhan_material'     => $this->request->getPost('kebutuhan_material'),
            'estimasi_waktu'        => $this->request->getPost('estimasi_waktu'),
            'catatan_hasil_survei'   => $this->request->getPost('catatan_hasil_survei'),
            ];
            $where = [
                'id'   => $this->request->getVar('id'),  // Mendapatkan ID jasa dari form
            ];
            $this->kontrakModel->update($where['id'], $update);
            $session->setFlashdata(
                'pesan',
                '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Berhasil update data jasa</h4>
                </div>'
            );
            return redirect()->to(base_url() . 'infosurvei');
        } else {
            return redirect()->to(base_url());
        }
}
 // Fungsi untuk menghapus hasil survei
 public function delete() {
    $id = $this->request->getGet('id'); // Mengambil ID dari query string
    $session = session();

    if (!empty($session->get('id')) && !empty($session->get('id_level'))) {
        // Memeriksa apakah penghapusan data berhasil
        if ($this->kontrakModel->delete($id)) {
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
        return redirect()->to(base_url('infokontrak'));

    } else {
        return redirect()->to(base_url('infokontrak'));

    }
}
}