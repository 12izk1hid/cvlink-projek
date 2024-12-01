<?php

namespace App\Controllers;

use App\Models\PaketLayananModel;
use App\Models\ServicesModel;
use App\Models\BarangModel;
use Throwable;

class PaketLayananController extends BaseController
{
    protected $paketModel;
    protected $servicesModel;
    protected $barangModel;

    public function __construct()
    {
        // Initialize models
        $this->paketModel = new PaketLayananModel();
        $this->servicesModel = new ServicesModel();
        $this->barangModel = new BarangModel();
    }

    // Menampilkan data Paket Layanan
    public function index()
    {
        $paket_layanan = $this->paketModel->findAll();

        // Retrieve service and barang details
        foreach ($paket_layanan as &$paket) {
            $service = $this->servicesModel->find($paket['id_services']);
            $paket['service_name'] = $service ? $service['nama'] : 'Unknown'; // Handle missing service
            
            $barang = $this->barangModel->find($paket['id_barang']);
            $paket['barang_name'] = $barang ? $barang['nama'] : 'Unknown'; // Handle missing barang
        }

        // Prepare data for view
        $data = [
            'title' => 'Data Paket Layanan',
            'paket_layanan' => $paket_layanan,
            'services' => $this->servicesModel->findAll(),
            'barang' => $this->barangModel->findAll()
        ];

        // Load view
        return view('layout/_header')
            . view('layout/_navigasi')
            . view('Admin/_PaketLayanan', $data)
            . view('layout/_footer');
    }

    // Menambahkan Paket Layanan baru
    public function save()
    {
        // Validasi input
        if (!$this->validate([
            'id_services' => 'required|integer',
            'id_barang' => 'required|integer',
            'besar' => 'required|decimal',
            'photo_url' => 'uploaded[photo_url]|max_size[photo_url,2048]|is_image[photo_url]|mime_in[photo_url,image/jpg,image/jpeg,image/png]'
        ])) {
            return redirect()->back()->with('pesan', 'Gagal menambahkan Paket Layanan.')->withInput();
        }

        // Mengelola file gambar
        $photo = $this->request->getFile('photo_url');
        $photo_name = $photo->getRandomName();
        $photo->move('assets/images', $photo_name); // Pindahkan ke folder tujuan

        // Simpan data
        $data = [
            'id_services' => $this->request->getPost('id_services'),
            'id_barang' => $this->request->getPost('id_barang'),
            'besar' => $this->request->getPost('besar'),
            'photo_url' => 'assets/images/' . $photo_name
        ];

        try {
            if ($this->paketModel->insert($data)) {
                return redirect()->to('/paketlayanan')->with('pesan', 'Paket Layanan berhasil ditambahkan!');
            }
        } catch (Throwable $e) {
            return redirect()->back()->with('pesan', 'Error: ' . $e->getMessage())->withInput();
        }
    }

    // Menampilkan form edit Paket Layanan
    public function edit($id)
    {
        $paket = $this->paketModel->find($id);
        if (!$paket) {
            return redirect()->to('/paket')->with('pesan', 'Paket Layanan tidak ditemukan.');
        }

        $data = [
            'title' => 'Edit Paket Layanan',
            'paket' => $paket,
            'services' => $this->servicesModel->findAll(),
            'barang' => $this->barangModel->findAll()
        ];

        return view('Admin/_EditPaketLayanan', $data);
    }

    // Memperbarui Paket Layanan
    public function update($id)
    {
        $paket = $this->paketModel->find($id);
        if (!$paket) {
            return redirect()->to('/paket')->with('pesan', 'Paket Layanan tidak ditemukan.');
        }

        // Validasi input
        if (!$this->validate([
            'id_services' => 'required|integer',
            'id_barang' => 'required|integer',
            'besar' => 'required|decimal',
            'photo_url' => 'if_exist|max_size[photo_url,2048]|is_image[photo_url]|mime_in[photo_url,image/jpg,image/jpeg,image/png]'
        ])) {
            return redirect()->back()->with('pesan', 'Gagal memperbarui Paket Layanan.')->withInput();
        }

        // Mengelola file gambar jika diupload
        $photo = $this->request->getFile('photo_url');
        if ($photo && $photo->isValid()) {
            $photo_name = $photo->getRandomName();
            $photo->move('assets/images', $photo_name);
            $paket['photo_url'] = 'assets/images/' . $photo_name;
        }

        // Update data
        $paket['id_services'] = $this->request->getPost('id_services');
        $paket['id_barang'] = $this->request->getPost('id_barang');
        $paket['besar'] = $this->request->getPost('besar');

        if ($this->paketModel->update($id, $paket)) {
            return redirect()->to('/paketlayanan')->with('pesan', 'Paket Layanan berhasil diperbarui!');
        }

        return redirect()->back()->with('pesan', 'Gagal memperbarui Paket Layanan.')->withInput();
    }

    // Menghapus Paket Layanan
    public function delete($id)
    {
        $paket = $this->paketModel->find($id);
        if (!$paket) {
            return redirect()->to('/paketlayanan')->with('pesan', 'Paket Layanan tidak ditemukan.');
        }

        // Hapus file gambar jika ada
        if (file_exists($paket['photo_url'])) {
            unlink($paket['photo_url']);
        }

        if ($this->paketModel->delete($id)) {
            return redirect()->to('/paketlayanan')->with('pesan', 'Paket Layanan berhasil dihapus!');
        }

        return redirect()->to('/paketlayanan')->with('pesan', 'Gagal menghapus Paket Layanan.');
    }
}
