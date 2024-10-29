<?php

namespace App\Controllers;

use App\Models\InvoiceModel;
use App\Models\KontrakModel;
use App\Models\JasaModel;


class KontrakController extends BaseController
{
    protected $kontrakModel;
    protected $invoiceModel;
    protected $jasaModel;

    public function __construct()
    {
        $this->kontrakModel = new KontrakModel();
        $this->invoiceModel = new InvoiceModel();
        $this->jasaModel = new JasaModel();
    }

    public function index()
    {
        $session = session();
        if (!empty($session->get('username')) && !empty($session->get('id_level'))) {
            $kliens = $this->kontrakModel->getKlien();
            // dd($this->invoiceModel->getIdUnsurveyedInvoice());
            $data = [
                'title' => 'kontrak',
                'kontrak'  => $this->kontrakModel->findAll(),
                'tagihan' => $this->invoiceModel->getIdUnsurveyedInvoice(), 
                'items' => $this->jasaModel->findAll(),
                'kliens' =>  $kliens
            ];
            return view('layout/_header')
                . view('layout/_navigasi')
                . view('_kontrak', $data) // Mengarahkan ke view jasa
                . view('layout/_footer');
        } else {
            return redirect()->to(base_url());
        }
    }

    public function save()
    {
        $session = session();
        if (!empty($session->get('username')) && !empty($session->get('id_level'))) {
            $id_tagihan = $this->request->getPost('id');

            // Ambil id_jasa yang merupakan array
            $id_jasa_array = $this->request->getPost('id_jasa');
        
            // Pastikan id_jasa_array bukan kosong
            if (!empty($id_jasa_array)) {
                foreach ($id_jasa_array as $id_jasa) {
                    // Persiapkan data untuk setiap insert
                    $insert = [
                        'id_tagihan' => $id_tagihan,
                        'id_jasa'    => $id_jasa,
                    ];
                    
                    // Insert data ke dalam kontrak model
                    $this->kontrakModel->insert($insert);
                }
            }
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
                'id'      => $this->request->getPost('id_kontrak'),
                'id_hasil_survei'               => $this->request->getPost('id_hasil_survei'),
                'id_klien'        => $this->request->getPost('id_klien'),
                'created_at'       => $this->request->getPost('created_at'),
                'updated_at'     => $this->request->getPost('updated_at'),
                'harga'        => $this->request->getPost('harga'),
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
            return redirect()->to(base_url() . 'infokontrak');
        } else {
            return redirect()->to(base_url());
        }
}
 // Fungsi untuk menghapus hasil kontrak
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
                    <h4><i class="icon fa fa-check"></i> Berhasil menghapus data kontrak</h4>
                </div>'
            );
        } else {
            // Set pesan gagal ke session
            $session->setFlashdata(
                'pesan',
                '<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-times"></i> Gagal menghapus data kontrak</h4>
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