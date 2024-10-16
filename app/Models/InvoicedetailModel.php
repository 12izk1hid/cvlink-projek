<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoicedetailModel extends Model
{

    protected $table = 'tbl_invoicedetail';
    protected $primaryKey = 'id';
    //field yang akan di tampilkan
    protected $allowedFields = ['id_invoice', 'keterangan', 'jumlah', 'pajak', 'biaya'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'tgl_dibuat';
    protected $updatedField  = 'tgl_update';
    protected $deletedField  = 'deleted_at';
}
