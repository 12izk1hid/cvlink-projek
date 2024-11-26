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
        $this->servicesModel = new ServicesModel();  // Model untuk tabel services
        $this->barangModel = new BarangModel();  // Model untuk tabel barang
    }

    public function index()
{
    $paket_layanan = $this->paketModel->findAll();

    // Retrieve service names and barang names
    foreach ($paket_layanan as &$paket) {
        // Retrieve service name based on id_services
        $service = $this->servicesModel->find($paket['id_services']);
        $paket['service_name'] = $service ? $service['nama'] : 'Unknown';  // Handle missing service
        
        // Retrieve barang name based on id_barang
        $barang = $this->barangModel->find($paket['id_barang']);
        $paket['barang_name'] = $barang ? $barang['nama'] : 'Unknown';  // Handle missing barang

    }

    // Prepare data to pass to the view
    $data = [
        'title' => 'Data Paket Layanan',
        'paket_layanan' => $paket_layanan,
        'services' => $this->servicesModel->findAll(),  // Add services data if needed
        'barang' => $this->barangModel->findAll()  // Barang data
    ];

    // Pass data to the view
    return view('layout/_header')
           . view('layout/_navigasi')
           . view('Admin/_PaketLayanan', $data)
           . view('layout/_footer');
}

    // Save new Paket Layanan
    public function save()
    {
        // Validate and retrieve post data
        $data = [
            'id_services' => $this->request->getPost('id_services'),
            'id_barang' => $this->request->getPost('id_barang'),
            'besar' => $this->request->getPost('besar'),
            'photo_url' => $this->request->getFile('photo_url')->getTempName()  // Save photo file temporarily
        ];

        // Insert data into the database
        try {
            if ($this->paketModel->insert($data)) {
                return redirect()->to(base_url('paketlayanan'))->with('pesan', 'Paket Layanan berhasil ditambahkan!');
            } else {
                return redirect()->back()->with('pesan', 'Gagal menambahkan Paket Layanan.')->withInput();    
            }
        } catch (Throwable $e) {
            return redirect()->back()->with('pesan', 'Error: ' . $e->getMessage())->withInput();
        }
    }

    // Edit and show the Paket Layanan
    public function edit($id)
    {
        $paket = $this->paketModel->find($id);
        if ($paket) {
            $data = [
                'title' => 'Edit Paket Layanan',
                'paket' => $paket
            ];

            return view('Admin/_EditPaketLayanan', $data);
        }
    }

    // Update the Paket Layanan
    public function update()
    {
        $id = $this->request->getPost('id');
        $data = [
            'id_services' => $this->request->getPost('id_services'),
            'id_barang' => $this->request->getPost('id_barang'),
            'besar' => $this->request->getPost('besar'),
            'photo_url' => $this->request->getFile('photo_url')->getTempName()
        ];

        if ($this->paketModel->update($id, $data)) {
            return redirect()->to('/paket')->with('pesan', 'Paket Layanan berhasil diperbarui!');
        } else {
            return redirect()->back()->with('pesan', 'Gagal memperbarui Paket Layanan.')->withInput();
        }
    }

    // Delete Paket Layanan
    public function delete($id)
    {
        if ($this->paketModel->delete($id)) {
            return redirect()->to('/paket')->with('pesan', 'Paket Layanan berhasil dihapus!');
        }
    }
}
