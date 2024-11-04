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
        if ($session->has('username') && $session->has('id_level')) {
            $data = [
                'title' => 'Jasa',
                'jasa'  => $this->jasaModel->findAll()
            ];
            return view('layout/_header')
                . view('layout/_navigasi')
                . view('_jasa', $data)
                . view('layout/_footer');
        }
        
        return redirect()->to(base_url());
    }

// Fungsi untuk menyimpan jasa baru
public function simpanjasa()
{
    $session = session();
    if (!empty($session->get('username')) && !empty($session->get('id_level'))) {
        $file = $this->request->getFile('photo'); // Ambil file upload
        $photo_url = '';

        // Memastikan file diupload
        if ($file && $file->isValid()) {
            $photo_url = $file->getName(); // Ambil nama file
            // Jika ingin menyimpan file, aktifkan ini:
            // $file->move(WRITEPATH . 'uploads'); // Pindahkan ke folder uploads
        } else {
            $photo_url = 'default_image_url.jpg'; // Ganti dengan URL gambar default Anda
        }

        $insert = [
            'nama_item' => $this->request->getVar('nama_item'),
            'type'      => $this->request->getVar('type'),
            'min_harga' => $this->request->getVar('min_harga'),
            'max_harga' => $this->request->getVar('max_harga'),
            'photo_url' => $photo_url, // Menyimpan nama file
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
    if ($session->has('username') && $session->has('id_level')) {
        $id = $this->request->getVar('id');

        // Ambil data jasa berdasarkan ID
        $jasa = $this->jasaModel->find($id);

        if ($jasa) {
            // Memeriksa apakah file diupload
            $file = $this->request->getFile('photo_url'); // Pastikan nama input file sesuai

            // Variabel untuk menyimpan nama file
            $fileName = $jasa['photo_url']; // Menggunakan nama file lama secara default

            // Cek apakah file diupload dan valid
            if ($file && $file->isValid() && !$file->hasMoved()) {
                // Mendapatkan nama asli file
                $fileName = $file->getName(); // Nama file asli
                // Di sini Anda bisa menyimpan nama file ke database tanpa memindahkan file
            }

            // Update data jasa
            $update = [
                'nama_item' => $this->request->getVar('nama_item'),
                'type'      => $this->request->getVar('type'),
                'min_harga' => $this->request->getVar('min_harga'),
                'max_harga' => $this->request->getVar('max_harga'),
                'photo_url' => $fileName, // Menyimpan nama file ke database
                'idupdate'  => $session->get('id'),
            ];

            // Pastikan untuk men-debug error
            try {
                $this->jasaModel->update($id, $update);
                $session->setFlashdata(
                    'pesan',
                    '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Berhasil update data jasa</h4>
                    </div>'
                );
            } catch (\Exception $e) {
                // Tangkap exception jika ada error saat update
                $session->setFlashdata(
                    'pesan',
                    '<div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-times"></i> Gagal mengupdate data jasa: ' . $e->getMessage() . '</h4>
                    </div>'
                );
            }
            return redirect()->to(base_url() . 'infojasa');
        } else {
            $session->setFlashdata(
                'pesan',
                '<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-times"></i> Jasa tidak ditemukan</h4>
                </div>'
            );
            return redirect()->to(base_url() . 'infojasa');
        }
    } else {
        return redirect()->to(base_url());
    }
}



    // Fungsi untuk menghapus jasa
    public function delete()
    {
        $id = $this->request->getGet('id');
        $session = session();

        if ($session->has('id') && $session->has('id_level')) {
            if ($this->jasaModel->delete($id)) {
                $session->setFlashdata('pesan', 
                    '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Berhasil menghapus data jasa</h4>
                    </div>'
                );
            } else {
                $session->setFlashdata('pesan', 
                    '<div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-times"></i> Gagal menghapus data jasa</h4>
                    </div>'
                );
            }
            return redirect()->to(base_url('infojasa'));
        }
        
        return redirect()->to(base_url('infojasa'));
    }
}
