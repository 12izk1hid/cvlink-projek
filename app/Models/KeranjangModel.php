<?php

namespace App\Models;

use CodeIgniter\Model;
use \App\Models\InvoiceModel;

class KeranjangModel extends Model
{
    protected $table = 'keranjang';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_paket_layanan', 'id_invoice'];

    public function addServiceToChart($user, $id_paket_layanan)
    {
        $invoiceModel = new InvoiceModel();
        $invoice = $invoiceModel->where('user_username', $user)
                                ->where('checkout', 0)
                                ->first();
        
        if ($invoice) {
            $id_invoice = $invoice['id'];
        } else {
            $newInvoiceData = [
                'user_username' => $user,
                'checkout' => 0,
                'tanggal_pemesanan' => date('Y-m-d H:i:s') 
            ];
            $invoiceModel->insert($newInvoiceData);
            $id_invoice = $invoiceModel->getInsertID();
        }

        $data = [
            'id_paket_layanan' => $id_paket_layanan,
            'id_invoice' => $id_invoice
        ];
        
        $this->insert($data);
        
        return true;
    }

    public function getChart() {
        
    }

}