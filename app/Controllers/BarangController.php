<?php

namespace App\Controllers;

use App\Models\BarangModel;

class BarangController extends BaseController
{
    protected $barangModel;

    public function __construct()
    {
        $this->barangModel = new BarangModel();
    }

    public function index()
    {
        // Mengambil data barang
        $data = [
            'title' => 'Data Barang',
            'barang' => $this->barangModel->findAll()
        ];

        // Menampilkan halaman dengan data barang
        return view('layout/_header')
                . view('layout/_navigasi')
                . view('Admin/_barang', $data)
                . view('layout/_footer');
    }
    
    public function save()
    {
        // Mengambil data dari form
        $data = [
            'nama_barang' => $this->request->getPost('nama'),
            'merk'        => $this->request->getPost('merk'),
            'harga'       => intval($this->request->getPost('harga')),
            'besaran'     => $this->request->getPost('besaran'),
        ];

        // Validasi input
        if (!$this->barangModel->validate($data)) {
            return redirect()->back()->with('pesan', 'Gagal menambahkan data.')->withInput();
        }

        // Menyimpan data barang
        if ($this->barangModel->insert($data)) {
            return redirect()->to('/barang')->with('pesan', 'Data berhasil ditambahkan!');
        } else {
            return redirect()->back()->with('pesan', 'Gagal menambahkan data.')->withInput();
        }
    }

    public function edit($id)
    {
        // Mengambil data barang berdasarkan ID
        $barang = $this->barangModel->find($id);

        // Mengecek apakah data barang ditemukan
        if ($barang) {
            $data = [
                'title' => 'Edit Barang',
                'barang' => $barang
            ];

            // Menampilkan form edit
            return view('layout/_header')
                    . view('layout/_navigasi')
                    . view('Admin/_edit_barang', $data)
                    . view('layout/_footer');
        } else {
            return redirect()->to('/barang')->with('pesan', 'Barang tidak ditemukan!');
        }
    }

    public function update()
    {
        // Ambil data yang dikirimkan oleh form
        $id = $this->request->getPost('id');
        $data = [
            'nama_barang' => $this->request->getPost('nama'),
            'merk'        => $this->request->getPost('merk'),
            'harga'       => $this->request->getPost('harga'),
            'besaran'     => $this->request->getPost('besaran')
        ];

        // Validasi input data
        if (!$this->barangModel->validate($data)) {
            return redirect()->back()->with('pesan', 'Gagal memperbarui data.')->withInput();
        }

        // Update data barang
        if ($this->barangModel->update($id, $data)) {
            return redirect()->to('/barang')->with('pesan', 'Barang berhasil diupdate.');
        } else {
            return redirect()->back()->with('pesan', 'Gagal memperbarui data.')->withInput();
        }
    }

    public function delete($id)
    {
        // Cek apakah barang dengan ID yang diberikan ada
        $barang = $this->barangModel->find($id);
    
        if ($barang) {
            // Coba hapus data dari database dan tangani exception jika ada constraint
            try {
                if ($this->barangModel->delete($id)) {
                    // Jika berhasil menghapus data barang
                    session()->setFlashdata('pesan', 'Barang berhasil dihapus!');
                    return redirect()->to('/barang');
                }
                // Jika gagal menghapus barang tanpa ada foreign key constraint
                session()->setFlashdata('pesan', 'Gagal menghapus barang.');
                return redirect()->to('/barang');
            } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
                // Cek jika error terkait foreign key constraint
                if (strpos($e->getMessage(), 'foreign key constraint fails') !== false) {
                    session()->setFlashdata('pesan', 'Tidak bisa menghapus barang ini karena masih terkait dengan data  pada paket layanan.');
                    return redirect()->to('/barang');
                }
                // Untuk error lain yang mungkin terjadi
                session()->setFlashdata('pesan', 'Gagal menghapus barang: ' . $e->getMessage());
                return redirect()->to('/barang');
            }
        }
    
        // Jika barang tidak ditemukan
        session()->setFlashdata('pesan', 'Barang tidak ditemukan!');
        return redirect()->to('/barang');
    }
    

     

}
