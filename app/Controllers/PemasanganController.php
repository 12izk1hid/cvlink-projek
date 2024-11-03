<?php

namespace App\Controllers;

class PemasanganController extends AdminController
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
            $id_teknisi = $this->pemasanganModel->getId_teknisi();
            $id_kontrak = $this->pemasanganModel->getId_Kontrak();

            $data = [
                'title' => 'pemasangan',
                'pemasangan'  => $this->pemasanganModel->findAll(),
                'Id_teknisi'     => $id_teknisi,
                'Id_kontrak'  => $id_kontrak    // Tambahkan data surveyors ke view
            ];
            return view('layout/_header')
                . view('layout/_navigasi')
                . view('_pemasangan', $data)
                . view('layout/_footer');
        } else {
            return redirect()->to(base_url());
        }
    }

    // Fungsi untuk menyimpan pemasangan baru
    public function save()
    {
        $session = session();
        if (!empty($session->get('username')) && !empty($session->get('id_level'))) {
            $data = [
                'id'      => $this->request->getPost('id_pemasangan'),
                'id_kontrak'       => $this->request->getPost('id_kontrak'),
                'tanggal_mulai'     => $this->request->getPost('tanggal_mulai'),
                'tanggal_selesai'    => $this->request->getPost('tanggal_selesai'),
                'status_pemasangan' => $this->request->getPost('status_pemasangan'),
                'id_teknisi'     => $this->request->getPost('id_teknisi'),
                'catatan_pemasangan'=> $this->request->getPost('catatan_pemasangan')
            ];

            // Validasi input
            if ($this->validate([
                'id_kontrak' => 'required',
                'tanggal_mulai' => 'required',
                'tanggal_selesai' => 'required',
                'status_pemasangan' => 'required',
                'id_teknisi' => 'required',
                'catatan_pemasangan' => 'required'
            ])) {
                $this->pemasanganModel->insert($data);

                // Pesan sukses
                $session->setFlashdata(
                    'pesan',
                    '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Data Pemasangan berhasil disimpan</h4>
                    </div>'
                );
            } else {
                // Pesan gagal validasi
                $session->setFlashdata(
                    'pesan',
                    '<div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-times"></i> Gagal menyimpan data Pemasangan, periksa kembali inputan Anda</h4>
                    </div>'
                );
            }
            return redirect()->to(base_url('infopemasangan'));
        } else {
            return redirect()->to(base_url());
        }
    }

    // Fungsi untuk memperbarui Pemasangan
    public function update()
    {
        $session = session();
        if (!empty($session->get('username')) && !empty($session->get('id_level'))) {
            $update = [
                'id'      => $this->request->getPost('id'),
                'id_kontrak'       => $this->request->getPost('id_kontrak'),
                'tanggal_mulai'     => $this->request->getPost('tanggal_mulai'),
                'tanggal_selesai'    => $this->request->getPost('tanggal_selesai'),
                'status_pemasangan' => $this->request->getPost('status_pemasangan'),
                'id_teknisi'     => $this->request->getPost('id_teknisi'),
                'catatan_pemasangan'=> $this->request->getPost('catatan_pemasangan'),
                 ];
                $where = [
                    'id'   => $this->request->getVar('id'),  // Mendapatkan ID pemasangan dari form
                ];
                $this-> pemasanganModel->update($where, $update);
                $session->setFlashdata(
                    'pesan',
                    '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Berhasil update data jasa</h4>
                    </div>'
                );
                return redirect()->to(base_url() . 'infopemasangan');
            } else {
                return redirect()->to(base_url());
            }
    }

    // Fungsi untuk menghapus Pemasangan
    public function delete()
    {
        $session = session();
        if (!empty($session->get('username')) && !empty($session->get('id_level'))) {
            $id = $this->request->getGet('id'); // Ambil ID dari URL

            if ($this->pemasanganModel->delete($id)) {
                // Pesan sukses
                $session->setFlashdata(
                    'pesan',
                    '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Data Pemasangan berhasil dihapus</h4>
                    </div>'
                );
            } else {
                // Pesan gagal
                $session->setFlashdata(
                    'pesan',
                    '<div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-times"></i> Gagal menghapus data Pemasangan</h4>
                    </div>'
                );
            }

            return redirect()->to(base_url('infopemasangan'));
        } else {
            return redirect()->to(base_url());
        }
    }
}
