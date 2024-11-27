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
        $imgBlob = $this->handleImageBlob(); // Mengubah file gambar ke BLOB

        // Mengambil data dari input POST
        $data = [
            'nama'      => $this->request->getPost('nama'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'harga'     => $this->request->getPost('harga'),
            'img_url'   => $imgBlob, // Menyimpan gambar dalam format BLOB
        ];

        // Validasi input
        if (!$this->validate([
            'nama'      => 'required|max_length[255]',
            'deskripsi' => 'required|max_length[500]',
            'harga'     => 'required|numeric',
            'img_url'   => 'permit_empty', // Tidak memvalidasi file di sini karena sudah di-handle manual
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Simpan ke database
        if (!$this->servicesModel->save($data)) {
            return redirect()->back()->withInput()->with('errors', $this->servicesModel->errors());
        }

        return redirect()->to('/services')->with('message', 'Jasa baru berhasil ditambahkan!');
    }

    public function update()
    {
        $id = $this->request->getPost('id');
        $imgBlob = $this->handleImageBlob(); // Mengubah file gambar ke BLOB (opsional)

        // Data untuk diupdate
        $data = [
            'id'        => $id,
            'nama'      => $this->request->getPost('nama'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'harga'     => $this->request->getPost('harga'),
        ];

        // Hanya tambahkan gambar jika ada file yang diunggah
        if ($imgBlob) {
            $data['img_url'] = $imgBlob;
        }

        // Validasi input
        if (!$this->validate([
            'nama'      => 'required|max_length[255]',
            'deskripsi' => 'required|max_length[500]',
            'harga'     => 'required|numeric',
            'img_url'   => 'permit_empty', // Validasi manual untuk gambar
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Update ke database
        if (!$this->servicesModel->save($data)) {
            return redirect()->back()->withInput()->with('errors', $this->servicesModel->errors());
        }

        return redirect()->to('/services')->with('message', 'Data jasa berhasil diperbarui!');
    }

    public function delete($id)
    {
        $service = $this->servicesModel->find($id);
        
        if (!$service) {
            return redirect()->to('/services')->with('error', 'Data tidak ditemukan.');
        }

        if (!$this->servicesModel->delete($id)) {
            return redirect()->to('/services')->with('error', 'Gagal menghapus data.');
        }

        return redirect()->to('/services')->with('message', 'Data jasa berhasil dihapus!');
    }

    /**
     * Menangani proses konversi file gambar ke BLOB
     *
     * @return string|null Konten file dalam format BLOB atau null jika gagal
     */
    private function handleImageBlob()
    {
        $imgFile = $this->request->getFile('img_url');

        // Jika file valid dan diunggah
        if ($imgFile && $imgFile->isValid() && !$imgFile->hasMoved()) {
            // Ambil isi file sebagai BLOB
            return file_get_contents($imgFile->getTempName());
        }

        // Jika tidak ada file yang diunggah, kembalikan null
        return null;
    }
}
