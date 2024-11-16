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
            // Mengambil informasi paket layanan
            $data = [
                'username' => $session->get('username'),
                'loged' => true,
                'paketLayanan' => $this->paketLayananModel->getServiceInfo(),
                'keranjangDetails' => $this->paketLayananModel->getKeranjangOf($session->get('username'))
            ];

            return view('clients/layout/header')
                .view('clients/layout/navigasi', $data)
                .view('clients/order', $data) // Menyertakan data paket layanan ke dalam view
                .view('clients/layout/footer');
        } else {
            return redirect()->to(base_url('login'));
        }
    }

    public function saveOrder()
    {
        $session = session();
        $idPaketLayanan = $this->request->getPost('id_paket_layanan');
        $idUser = $session->get('username'); // Menggunakan username dari session sebagai id_user
    
        if (!$idPaketLayanan || !$idUser) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Data tidak valid.'
            ]);
        }

        try {
            // Debug log (opsional, hapus di produksi)
            log_message('info', "Adding to cart: id_paket_layanan=$idPaketLayanan, id_user=$idUser");

            // Memasukkan paket layanan ke dalam keranjang
            $this->keranjangModel->addServiceToChart($idUser, $idPaketLayanan);

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Berhasil menambahkan ke keranjang.'
            ]);
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());

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
