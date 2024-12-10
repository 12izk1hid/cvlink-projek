<?php
namespace App\Controllers;

use App\Models\InvoiceModel;
use App\Models\UsersModel;

class InvoiceController extends AdminController
{
    protected $invoiceModel;
    protected $usersModel;
    protected $session;

    public function __construct()
    {
        parent::__construct();
        $this->invoiceModel = new InvoiceModel(); // Memuat model Invoice
        $this->usersModel = new UsersModel(); // Memuat model Users
        $this->session = session(); // Memuat session untuk digunakan di setiap method
    }

    /**
     * Menampilkan halaman daftar invoice.
     */
    public function index()
    {
        // Memeriksa apakah pengguna sudah login
        if ($this->session->get('username') && $this->session->get('id_level')) {
            // Mengambil data invoice
            $invoices = $this->invoiceModel->getInvoiceDetails(); 
            
            // Cek jika data kosong
            if (empty($invoices)) {
                $this->session->setFlashdata('pesan', '<div class="alert alert-warning">Tidak ada data invoice yang tersedia.</div>');
            }
    
            $data = [
                'title'    => 'Invoice',
                'invoice'  => $invoices,
            ];

            // Mengembalikan view dengan data invoice
            return view('layout/_header')
                . view('layout/_navigasi')
                . view('admin/_invoice', $data)
                . view('layout/_footer');
        } else {
            // Jika tidak ada sesi login, redirect ke halaman login
            return redirect()->to(base_url());
        }
    }

    public function accept($invoice_id)
    {
        if ($this->session->get('username') && $this->session->get('id_level')) {
            $data = [
                'confirmed' => 1, // Menandakan invoice diterima
            ];
    
            $this->invoiceModel->update($invoice_id, $data);
    
            // Menampilkan pesan sukses
            $this->session->setFlashdata('pesan', 
                '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Invoice Accepted</h4>
                </div>' 
            );
    
            return redirect()->to(base_url('infoinvoice'));
        } else {
            return redirect()->to(base_url());
        }
    }

    /**
     * Menolak invoice.
     */
    public function reject($invoice_id)
    {
        if ($this->session->get('username') && $this->session->get('id_level')) {
            $data = [
                'confirmed' => -1, // Menandakan invoice ditolak
            ];

            $this->invoiceModel->update($invoice_id, $data);

            // Menampilkan pesan gagal
            $this->session->setFlashdata('pesan', 
                '<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-times"></i> Invoice Rejected</h4>
                </div>'
            );

            return redirect()->to(base_url('infoinvoice'));
        } else {
            return redirect()->to(base_url());
        }
    }
}
