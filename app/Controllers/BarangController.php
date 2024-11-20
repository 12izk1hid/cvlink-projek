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
        $data = [
            'title' => 'Data Barang',
            'barang' => $this->barangModel->findAll()
        ];

        return view('layout/_header')
                . view('layout/_navigasi')
                . view('Admin/_barang', $data)
                . view('layout/_footer');
    }
    
    public function save()
    {
        $barangModel = new \App\Models\BarangModel();
    
        $data = [
            'nama' => $this->request->getPost('nama'),
            'merk' => $this->request->getPost('merk'),
            'harga' => $this->request->getPost('harga'),
            'besaran' => $this->request->getPost('besaran'),
        ];
    
        if ($barangModel->insert($data)) {
            return redirect()->to('/barang')->with('pesan', 'Data berhasil ditambahkan!');
        } else {
            return redirect()->back()->with('pesan', 'Gagal menambahkan data.')->withInput();
        }
    }

    // Fungsi untuk menampilkan form edit
    public function edit($id)
    {
        $barang = $this->barangModel->find($id);
        if ($barang) {
            $data = [
                'title' => 'Edit Barang',
                'barang' => $barang
            ];

            return view('layout/_header')
                    . view('layout/_navigasi')
                    . view('Admin/_edit_barang', $data)  // Gantilah dengan nama view yang sesuai
                    . view('layout/_footer');
        } else {
            return redirect()->to('/barang')->with('pesan', 'Barang tidak ditemukan!');
        }
    }

    public function update()
    {
        // Ambil data yang dikirimkan oleh form
        $id = $this->request->getPost('id');
        $nama = $this->request->getPost('nama');
        $merk = $this->request->getPost('merk');
        $harga = $this->request->getPost('harga');
        $besaran = $this->request->getPost('besaran');

        // Validasi input data
        if (!$id || !$nama || !$merk || !$harga || !$besaran) {
            return redirect()->back()->with('pesan', 'Semua field harus diisi.');
        }

        // Update data barang
        $barangModel = new BarangModel();
        $barangModel->update($id, [
            'nama' => $nama,
            'merk' => $merk,
            'harga' => $harga,
            'besaran' => $besaran
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->to('/barang')->with('pesan', 'Barang berhasil diupdate.');
    }
}
