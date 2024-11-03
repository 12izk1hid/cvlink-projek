<?php

namespace App\Controllers;

class SurveiController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $session = session();
        if (!empty($session->get('username')) && !empty($session->get('id_level'))) {
            // Ambil daftar surveyors
            $surveyors = $this->surveiModel->getSurveyors();
            // dd($this->surveiModel->getData());
            $data = [
                'title' => 'hasil_survei',
                'hasil_survei'  => $this->surveiModel->getData(),
                'surveyors'     => $surveyors  // Tambahkan data surveyors ke view
            ];
            return view('layout/_header')
                . view('layout/_navigasi')
                . view('_survei', $data)
                . view('layout/_footer');
        } else {
            return redirect()->to(base_url());
        }
    }

    // Fungsi untuk menyimpan survei baru
    public function save()
    {
        $session = session();
        if (!empty($session->get('username')) && !empty($session->get('id_level'))) {
            $data = [
                'id_surveyors'       => $this->request->getPost('id_surveyors'),
                'Tanggal_survei'     => $this->request->getPost('Tanggal_survei'),
                'Jenis_instalasi'    => $this->request->getPost('Jenis_instalasi'),
                'kebutuhan_material' => $this->request->getPost('kebutuhan_material'),
                'estimasi_waktu'     => $this->request->getPost('estimasi_waktu'),
                'catatan_hasil_survei'=> $this->request->getPost('catatan_hasil_survei')
            ];

            // Validasi input
            if ($this->validate([
                'id_surveyors' => 'required',
                'Tanggal_survei' => 'required',
                'Jenis_instalasi' => 'required',
                'kebutuhan_material' => 'required',
                'estimasi_waktu' => 'required',
                'catatan_hasil_survei' => 'required'
            ])) {
                $this->surveiModel->insert($data);

                // Pesan sukses
                $session->setFlashdata(
                    'pesan',
                    '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Data survei berhasil disimpan</h4>
                    </div>'
                );
            } else {
                // Pesan gagal validasi
                $session->setFlashdata(
                    'pesan',
                    '<div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-times"></i> Gagal menyimpan data survei, periksa kembali inputan Anda</h4>
                    </div>'
                );
            }
            return redirect()->to(base_url('infosurvei'));
        } else {
            return redirect()->to(base_url());
        }
    }

    // Fungsi untuk memperbarui survei
    public function update()
    {
        $session = session();
        if (!empty($session->get('username')) && !empty($session->get('id_level'))) {
            $data = [
                'id_surveyors'       => $this->request->getPost('id_surveyors'),
                'Tanggal_survei'     => $this->request->getPost('Tanggal_survei'),
                'Jenis_instalasi'    => $this->request->getPost('Jenis_instalasi'),
                'kebutuhan_material' => $this->request->getPost('kebutuhan_material'),
                'estimasi_waktu'     => $this->request->getPost('estimasi_waktu'),
                'catatan_hasil_survei'=> $this->request->getPost('catatan_hasil_survei')
            ];

            // Validasi input
            if ($this->validate([
                'id_surveyors' => 'required',
                'Tanggal_survei' => 'required',
                'Jenis_instalasi' => 'required',
                'kebutuhan_material' => 'required',
                'estimasi_waktu' => 'required',
                'catatan_hasil_survei' => 'required'
            ])) {
                $id = $this->request->getPost('id');
                $this->surveiModel->update($id, $data);

                // Pesan sukses
                $session->setFlashdata(
                    'pesan',
                    '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Data survei berhasil diperbarui</h4>
                    </div>'
                );
            } else {
                // Pesan gagal validasi
                $session->setFlashdata(
                    'pesan',
                    '<div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-times"></i> Gagal memperbarui data survei, periksa kembali inputan Anda</h4>
                    </div>'
                );
            }
            return redirect()->to(base_url('infosurvei'));
        } else {
            return redirect()->to(base_url());
        }
    }

    // Fungsi untuk menghapus survei
    public function delete()
    {
        $session = session();
        if (!empty($session->get('username')) && !empty($session->get('id_level'))) {
            $id = $this->request->getGet('id'); // Ambil ID dari URL

            if ($this->surveiModel->delete($id)) {
                // Pesan sukses
                $session->setFlashdata(
                    'pesan',
                    '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Data survei berhasil dihapus</h4>
                    </div>'
                );
            } else {
                // Pesan gagal
                $session->setFlashdata(
                    'pesan',
                    '<div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-times"></i> Gagal menghapus data survei</h4>
                    </div>'
                );
            }

            return redirect()->to(base_url('infosurvei'));
        } else {
            return redirect()->to(base_url());
        }
    }
}
