<?php

namespace App\Controllers;

use App\Models\JasaModel;
use App\Models\InvoiceModel;
use App\Models\UsersModel;
use App\Models\PaketLayananModel;
use App\Models\ServicesModel; // Tambahkan ini di bagian atas
use App\Models\KeranjangModel;

class ClientController extends BaseController
{
    protected $jasaModel;
    protected $invoiceModel;
    protected $usersModel;
    protected $paketLayananModel;
    protected $servicesModel;
    protected $keranjangModel;

    public function __construct()
    {
        $this->jasaModel = new JasaModel();
        $this->invoiceModel = new InvoiceModel();
        $this->usersModel = new UsersModel();
        $this->paketLayananModel = new PaketLayananModel();
        $this->servicesModel = new ServicesModel();
        $this->keranjangModel = new KeranjangModel();
    }

    public function index()
    {
        $session = session();
        $data = [
            'loged' => !empty($session->get('username')) && !empty($session->get('id_level')),
            'services' => $this->paketLayananModel->getServiceInfo() // Ambil data layanan
        ];

        return view('clients/layout/header')
            .view('clients/layout/navigasi', $data)
            .view('clients/index')
            .view('clients/layout/footer');
    }

    public function order()
    {
        $session = session();
    
        if (!empty($session->get('username')) && !empty($session->get('id_level'))) {
            $paketLayanan = $this->paketLayananModel->getServiceInfo();
            $keranjangDetails = $this->paketLayananModel->getKeranjangOf($session->get('username'));
    
            $keranjangBarang = [];
    
            foreach ($keranjangDetails as $keranjang) {
                $idServices = $keranjang['id']; 
                $dataBarang = $this->paketLayananModel->getBarangByService($idServices);
    
                $keranjangBarang[$keranjang['id']] = $dataBarang;
            }

            // Siapkan data untuk view
            $data = [
                'username' => $session->get('username'),
                'loged' => true,
                'paketLayanan' => $paketLayanan,
                'keranjangDetails' => $keranjangDetails,
                'keranjangBarang' => $keranjangBarang // Array baru untuk barang
            ];

            return view('clients/layout/header')
                .view('clients/layout/navigasi', $data)
                .view('clients/order', $data)
                .view('clients/layout/footer');
        } else {
            // Jika session tidak valid, redirect ke login
            return redirect()->to(base_url('login'));
        }
    }
    
    public function saveOrder()
    {
        $session = session();
        $idPaketLayanan = $this->request->getPost('id_paket_layanan');
        $idUser = $session->get('username');
    
        // Cek apakah pengguna belum login
        if (!$idUser) {
            return $this->response->setStatusCode(401)->setJSON([
                'success' => false,
                'message' => 'NOT-LOGGED',
                'url' => base_url('login')
            ]);
        }
    
        // Validasi data input
        if (!$idPaketLayanan) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Data tidak valid. ID Paket Layanan harus diisi.'
            ]);
        }
    
        try {
            // Debug log
            log_message('info', "Menambahkan ke keranjang: id_paket_layanan=$idPaketLayanan, id_user=$idUser");
    
            // Memasukkan paket layanan ke dalam keranjang
            $this->keranjangModel->addServiceToChart($idUser, $idPaketLayanan);
    
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Berhasil menambahkan ke keranjang.'
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Error menambahkan ke keranjang: ' . $e->getMessage());
    
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan pada server.'
            ]);
        }
    }

    // Menampilkan keranjang belanja pengguna
    public function viewCart()
    {
        $session = session();
        $idUser = $session->get('username');
        
        // Mengambil data keranjang berdasarkan user_id
        $cartItems = $this->keranjangModel->getKeranjangDetails($idUser);

        $data = [
            'cartItems' => $cartItems,
            'loged' => true
        ];

        return view('clients/layout/header')
            .view('clients/layout/navigasi', $data)
            .view('clients/cart', $data) // Halaman keranjang
            .view('clients/layout/footer');
    }
    
    public function profile()
    {
        $session = session();
        $username = $session->get('username'); // Ambil username dari session

        // Ambil data pengguna dari database berdasarkan username
        $user = $this->usersModel->where('username', $username)->first();

        // Cek apakah data pengguna ditemukan
        if (!$user) {
            return redirect()->to(base_url('login'));
        }

        // Kirim data $user ke view
        $data = [
            'user' => $user,
            'loged' => true
        ];

        return view('clients/layout/header')
            .view('clients/layout/navigasi', $data)
            .view('clients/profile', $data)
            .view('clients/layout/footer');
    }
}
