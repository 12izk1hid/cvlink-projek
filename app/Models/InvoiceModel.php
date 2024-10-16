<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceModel extends Model
{

    protected $table = 'tbl_invoice';
    protected $primaryKey = 'id';
    //field yang akan di tampilkan
    protected $allowedFields = ['penerima', 'alamat', 'notelp', 'jumlah', 'status', 'userupdate'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'tgl_dibuat';
    protected $updatedField  = 'tgl_diterima';
    protected $deletedField  = 'deleted_at';

    public function getInvoice()
    {
        return $this->findAll();
    }

    public function ambilidInvoicemaks()
    {
        $builder = $this->db->table('tbl_invoice');
        $builder->selectMax('id');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getInvoiceDetail($id = '')
    {
        $builder = $this->db->table('tbl_invoice');
        $builder->select('*');
        $builder->join('tbl_invoicedetail', 'tbl_invoicedetail.id_invoice = tbl_invoice.id', 'inner');
        if ($id) {
            $builder->where('id_invoice', $id);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
}
