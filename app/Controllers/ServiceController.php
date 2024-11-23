<?php

namespace App\Controllers;

use App\Models\ServicesModel;
use CodeIgniter\Controller;

class ServiceController extends Controller
{

    protected $servicesModel;

    public function __construct()
    {
        $this->servicesModel = new ServicesModel();
    }


    public function index()
    {
        $data = [
            'title' => 'Data Barang',
            'services' => $this->servicesModel->findAll()
        ];

        return view('layout/_header')
                . view('layout/_navigasi')
                . view('Admin/_services', $data)
                . view('layout/_footer');
    }


    public function save()
    {
        // Mengambil data dari input POST
        $data = [
            'nama'      => $this->request->getPost('nama'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'harga'     => $this->request->getPost('harga'),
            'img_url'   => $this->handleImageUpload(), // Menangani upload gambar
        ];

        // Validasi input
        if (!$this->validate([
            'nama'      => 'required|max_length[255]',
            'deskripsi' => 'required|max_length[500]',
            'harga'     => 'required|numeric',
            'img_url'   => 'permit_empty|is_image[img_url]|max_size[img_url,1024]|ext_in[img_url,jpg,jpeg,png,gif]', // Validasi file gambar dengan ekstensi yang diperbolehkan
        ])) {
            // Menampilkan error validasi dan input kembali
            dd($this->validator->getErrors());
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Menyimpan data ke dalam database menggunakan model
        $servicesModel = new ServicesModel();
        if(!$servicesModel->save($data)) {
            $errors = $servicesModel->errors();
            dd($errors); // dev
        }

        // Menampilkan pesan sukses atau redirect ke halaman tertentu
        return redirect()->to('/services')->with('message', 'Jasa baru berhasil ditambahkan!');
    }

    public function update()
    {
        $id = $this->request->getPost('id');
        $data = [
            'nama'      => $this->request->getPost('nama'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'harga'     => $this->request->getPost('harga'),
            'img_url'   => $this->handleImageUpload(), // Menangani upload gambar (opsional)
        ];

        // Validasi input
        if (!$this->validate([
            'nama'      => 'required|max_length[255]',
            'deskripsi' => 'required|max_length[500]',
            'harga'     => 'required|numeric',
            'img_url'   => 'permit_empty|is_image[img_url]|max_size[img_url,1024]|ext_in[img_url,jpg,jpeg,png,gif]', // Validasi file gambar
        ])) {
            // Menampilkan error validasi dan input kembali
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Memperbarui data di dalam database menggunakan model
        $servicesModel = new ServicesModel();
        if (!$servicesModel->update($id, $data)) {
            $errors = $servicesModel->errors();
            dd($errors); // Debugging (opsional)
        }

        // Menampilkan pesan sukses atau redirect ke halaman tertentu
        return redirect()->to('/services')->with('message', 'Data jasa berhasil diperbarui!');
    }

    public function delete($id)
    {
        // Inisialisasi model
        $servicesModel = new ServicesModel();
        $service = $servicesModel->find($id);
        
        if (!$service) {
            // Jika tidak ditemukan, tampilkan pesan error
            return redirect()->to('/services')->with('error', 'Data tidak ditemukan.');
        }

        if (!$servicesModel->delete($id)) {
            $errors = $servicesModel->errors();
            dd($errors); // Debugging (opsional)
        }

        return redirect()->to('/services')->with('message', 'Data jasa berhasil dihapus!');
    }


    /**
     * Menangani proses upload gambar
     *
     * @return string|null URL gambar yang diupload atau null jika gagal
     */
    private function handleImageUpload()
    {
        // Cek apakah ada file yang diupload
        $imgFile = $this->request->getFile('img_url');

        // Jika file ada dan valid
        if ($imgFile && $imgFile->isValid() && !$imgFile->hasMoved()) {
            // Tentukan folder tujuan untuk menyimpan gambar
            $folderPath = WRITEPATH . 'uploads/services/';

            // Membuat folder jika belum ada
            if (!is_dir($folderPath)) {
                mkdir($folderPath, 0777, true);  // Membuat folder jika belum ada
            }

            // Menghasilkan nama file acak untuk menghindari bentrok nama
            $newName = $imgFile->getRandomName(); 

            // Pindahkan file ke folder yang sudah ditentukan
            if ($imgFile->move($folderPath, $newName)) {
                // Kembalikan URL file yang diupload
                return 'uploads/services/' . $newName; // Path relatif yang akan disimpan di database
            } else {
                // Jika file gagal diupload, return nilai default atau error
                return null;
            }
        }

        // Jika tidak ada gambar yang diupload atau upload gagal, return nilai default
        return null;
    }
}
