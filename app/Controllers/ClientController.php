<?php

namespace App\Controllers;

use App\Models\JasaModel;
use App\Models\InvoiceModel;
use App\Models\UsersModel;
use App\Models\PaketLayananModel;
use App\Models\ServicesModel;
use App\Models\KeranjangModel;

class ClientController extends BaseController
{
    protected $jasaModel;
    protected $invoiceModel;
    protected $usersModel;
    protected $paketLayananModel;
    protected $servicesModel;
    protected $keranjangModel;
    protected $session;

    public function __construct()
    {
        // Inisialisasi model dan session
        $this->jasaModel = new JasaModel();
        $this->invoiceModel = new InvoiceModel();
        $this->usersModel = new UsersModel();
        $this->paketLayananModel = new PaketLayananModel();
        $this->servicesModel = new ServicesModel();
        $this->keranjangModel = new KeranjangModel();
        $this->session = session(); // Menyimpan session untuk akses lebih mudah
    }

    // Menampilkan halaman utama
    public function index()
    {
        $services = $this->paketLayananModel->getServiceInfo();
        // Ambil data layanan dan pastikan 'img_url' ada di dalam data tersebut
        $data = [
            'loged' => $this->session->get('username') && $this->session->get('id_level'),
            'services' => $services, // Data layanan dengan 'img_url'
        ];

        // dd($services);
    
        // Cek jika admin, arahkan ke halaman admin
        if ($this->session->get('id_level') === 'admin') {
            return redirect()->to('admin');
        }
    
        // Gabungkan semua view dalam satu string dan kirim data layanan ke view
        return view('clients/layout/header')
            . view('clients/layout/navigasi', $data)
            . view('clients/index', $data)
            . view('clients/layout/footer');
    }
    
    


    // Menampilkan halaman order
    public function order()
    {
        $username = $this->session->get('username');
        $idLevel = $this->session->get('id_level');

        if ($username && $idLevel) {
            // Mengambil data keranjang dengan cara yang lebih efisien
            $keranjangDetails = $this->keranjangModel->getKeranjangDetails($username);

            if (empty($keranjangDetails)) {
                return redirect()->to(base_url('order'))->with('error', 'Keranjang kosong.');
            }

            $keranjangBarang = [];
            foreach ($keranjangDetails as $keranjang) {
                $idServices = $keranjang['id'];
                $dataBarang = $this->paketLayananModel->getBarangByService($idServices);
                $keranjangBarang[$keranjang['id']] = $dataBarang;
            }

            $data = [
                'username' => $username,
                'loged' => true,
                'keranjangDetails' => $keranjangDetails,
                'keranjangBarang' => $keranjangBarang,
            ];

            return view('clients/layout/header')
                . view('clients/layout/navigasi', $data)
                . view('clients/order', $data)
                . view('clients/layout/footer');
        } else {
            return redirect()->to(base_url('login'))->with('error', 'Anda belum login.');
        }
    }

    // Menyimpan pesanan ke dalam keranjang
    public function saveOrder()
    {
        $idPaketLayanan = $this->request->getPost('id_paket_layanan');
        $idUser = $this->session->get('username');

        if (!$idUser) {
            return $this->response->setStatusCode(401)->setJSON([
                'success' => false,
                'message' => 'Anda belum login.',
                'url' => base_url('login'),
            ]);
        }

        if (!$idPaketLayanan) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'ID Paket Layanan harus diisi.',
            ]);
        }

        try {
            $this->keranjangModel->addServiceToCart($idUser, $idPaketLayanan);
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Berhasil menambahkan ke keranjang.',
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Error menambahkan ke keranjang: ' . $e->getMessage());

            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan pada server.',
            ]);
        }
    }

    

    // Menampilkan keranjang belanja pengguna
    public function viewCart()
    {
        $idUser = $this->session->get('username');

        if (!$idUser) {
            return redirect()->to(base_url('login'));
        }

        // Mengecek apakah keranjang kosong
        $cartItems = $this->keranjangModel->getKeranjangDetails($idUser);
        if (empty($cartItems)) {
            return redirect()->to(base_url('order'))->with('error', 'Keranjang Anda kosong.');
        }

        $data = [
            'cartItems' => $cartItems,
            'loged' => true,
        ];

        return view('clients/layout/header')
            . view('clients/layout/navigasi', $data)
            . view('clients/cart', $data)
            . view('clients/layout/footer');
    }

    // Menampilkan profil pengguna
    public function profile()
    {
        $username = $this->session->get('username');
        $user = $this->usersModel->where('username', $username)->first();

        if (!$user) {
            return redirect()->to(base_url('login'))->with('error', 'Pengguna tidak ditemukan.');
        }

        $data = [
            'user' => $user,
            'loged' => true,
        ];

        return view('clients/layout/header')
            . view('clients/layout/navigasi', $data)
            . view('clients/profile', $data)
            . view('clients/layout/footer');
    }
}
