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
        
        $data = [
            'loged' => $this->session->get('username') && $this->session->get('id_level'),
            'services' => $services,
        ];

        if ($this->session->get('id_level') === 'admin') {
            return redirect()->to('admin');
        }

        return view('clients/layout/header')
            . view('clients/layout/navigasi', $data)
            . view('clients/index', $data)
            . view('clients/layout/footer');
    }

    // Handle checkout process
    public function checkout()
    {
        $buktiTransfer = $this->request->getFile('bukti_transfer');
        $idServices = $this->request->getPost('id_services');
        $username = $this->session->get('username'); // Ambil username dari session
        
        // Cek jika username tidak ada dalam session (belum login)
        if (!$username) {
            return redirect()->to(base_url('login'))->with('error', 'Silakan login terlebih dahulu.');
        }
        
        if ($buktiTransfer && $buktiTransfer->isValid() && !$buktiTransfer->hasMoved()) {
            $idServicesArray = explode(',', $idServices);
            $idServicesArray = array_map('intval', $idServicesArray);
            $newFileName = uniqid() . '.' . $buktiTransfer->getExtension();
            $buktiTransfer->move(ROOTPATH . 'public/assets/images/evidence', $newFileName);
            
            // Tambahkan user_username (id_user) pada data invoice
            $invoiceData = [
                'bukti_bayar' => $newFileName,
                'user_username' => $username // Menambahkan username ke data invoice
            ];
            
            // Simpan data invoice dan ambil ID invoice yang baru
            $invoiceId = $this->invoiceModel->insert($invoiceData);
    
            if ($invoiceId) {
                // Update keranjang dengan menambahkan id_invoice yang baru
                $this->keranjangModel->where('user_username', $username)
                                   ->whereIn('id_services', $idServicesArray)
                                   ->set(['id_invoice' => $invoiceId])
                                   ->update();
                return redirect()->to('/client/order')
                                 ->with('success', 'Checkout berhasil! Bukti pembayaran telah diunggah.');
            } else {
                // Jika terjadi kesalahan, hapus file yang sudah diupload
                unlink(ROOTPATH . 'assets/images/evidence/' . $newFileName);
                return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data invoice.');
            }
        } else {
            return redirect()->back()->with('error', 'Bukti transfer tidak valid atau tidak diunggah.');
        }
    }
    
        
    // View user orders
    public function order()
    {
        $username = $this->session->get('username');
    
        if ($username) {
            $paketLayanan = $this->paketLayananModel->getServiceInfo();
            $keranjangDetails = $this->paketLayananModel->getKeranjangOf($username);
            $keranjangBarang = [];

            foreach ($keranjangDetails as $keranjang) {
                $idServices = $keranjang['id']; 
                $dataBarang = $this->paketLayananModel->getBarangByService($idServices);
                $keranjangBarang[$keranjang['id']] = $dataBarang;
            }

            $data = [
                'username' => $username,
                'loged' => true,
                'paketLayanan' => $paketLayanan,
                'keranjangDetails' => $keranjangDetails,
                'keranjangBarang' => $keranjangBarang
            ];

            return view('clients/layout/header')
                . view('clients/layout/navigasi', $data)
                . view('clients/order', $data)
                . view('clients/layout/footer');
        } else {
            // If user is not logged in, redirect to login
            return redirect()->to(base_url('login'));
        }
    }

    public function invoice()
    {
        $username = $this->session->get('username');
    
        if ($username) {
            $paketLayanan = $this->paketLayananModel->getServiceInfo();
            $keranjangDetails = $this->paketLayananModel->getInvoiceOf($username);
            $keranjangBarang = [];

            foreach ($keranjangDetails as $keranjang) {
                $idServices = $keranjang['id']; 
                $dataBarang = $this->paketLayananModel->getBarangByService($idServices);
                $keranjangBarang[$keranjang['id']] = $dataBarang;
            }

            $data = [
                'username' => $username,
                'loged' => true,
                'paketLayanan' => $paketLayanan,
                'keranjangDetails' => $keranjangDetails,
                'keranjangBarang' => $keranjangBarang
            ];

            return view('clients/layout/header')
                . view('clients/layout/navigasi', $data)
                . view('clients/invoice', $data)
                . view('clients/layout/footer');
        } else {
            // If user is not logged in, redirect to login
            return redirect()->to(base_url('login'));
        }
    }

    // Save order to cart
    public function saveOrder()
    {
        $id_services = $this->request->getPost('id_services');
        $idUser = $this->session->get('username');
    
        if (!$idUser) {
            return $this->response->setStatusCode(401)->setJSON([
                'success' => false,
                'message' => 'NOT-LOGGED',
                'url' => base_url('login')
            ]);
        }
    
        if (!$id_services) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'ID Paket Layanan harus diisi.'
            ]);
        }

        $data = [
            'id_services' => $id_services,
            'user_username' => $idUser
        ];

        if ($this->keranjangModel->insert($data)) {
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

    // View cart
    public function viewCart()
    {
        $idUser = $this->session->get('username');

        if (!$idUser) {
            return redirect()->to(base_url('login'));
        }

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

    // View profile
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
