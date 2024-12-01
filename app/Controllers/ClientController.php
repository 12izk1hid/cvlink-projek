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

    public function checkout()
    {
        $buktiTransfer = $this->request->getFile('bukti_transfer');
        $idServices = $this->request->getPost('id_services');
        $username = $this->session->get('username');
    
        if ($buktiTransfer && $buktiTransfer->isValid() && !$buktiTransfer->hasMoved()) {
            $idServicesArray = explode(',', $idServices);
            $idServicesArray = array_map('intval', $idServicesArray);
            $newFileName = uniqid() . '.' . $buktiTransfer->getExtension();
            $buktiTransfer->move(ROOTPATH . 'assets/images/evidence', $newFileName);
            $invoiceData = [ 'bukti_bayar' => $newFileName ];    
            $invoiceId = $this->invoiceModel->insert($invoiceData);

            if ($invoiceId) {
                $this->keranjangModel->where('user_username', $username)
                               ->whereIn('id_services', $idServicesArray)
                               ->set(['id_invoice' => $invoiceId])
                               ->update();
                return redirect()->to('/client/order')
                                 ->with('success', 'Checkout berhasil! Bukti pembayaran telah diunggah.');
            } else {
                unlink(ROOTPATH . 'assets/images/evidence/' . $newFileName);
                return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data invoice.');
            }
        } else {
            return redirect()->back()->with('error', 'Bukti transfer tidak valid atau tidak diunggah.');
        }
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

            // dd($keranjangDetails);

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
        $id_services = $this->request->getPost('id_services');
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
        if (!$id_services) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Data tidak valid. ID Paket Layanan harus diisi.'
            ]);
        }

        $data = [
            'id_services' => $id_services,
            'user_username' => $idUser
        ];

        if($this->keranjangModel->insert($data)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Berhasil menambahkan ke keranjang.'
            ]);
        } else {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan pada server.'
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
