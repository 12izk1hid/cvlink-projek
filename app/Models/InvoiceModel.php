<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'invoice';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['bukti_bayar', 'tanggal_checkout', 'confirmed']; // Menambahkan id_users


    public function getInvoiceDetails() {
        // Subquery to calculate harga_layanan
        $subQuery = $this->db->table('paket_layanan pl')
            ->select('pl.id_services, (SUM(b.harga) * pl.besar) as harga_layanan')
            ->join('barang b', 'b.id = pl.id_barang')
            ->groupBy('pl.id_services')
            ->getCompiledSelect(); // Get the SQL for the subquery
    
        // Main query with JOINs
        return $this->db->table('keranjang k')
            ->select('k.id_invoice, s.nama, i.bukti_bayar, i.tanggal_checkout, i.confirmed, pl.harga_layanan')
            ->join('users s', 's.username = k.user_username')
            ->join('invoice i', 'i.id = k.id_invoice')
            ->join("($subQuery) as pl", 'pl.id_services = k.id_services', 'left') // Using subquery here
            ->groupBy('k.id_invoice')
            ->get()
            ->getResultArray();
    }

    public function getInvoiceDetailsPerUsers($username) {
        // Subquery to calculate harga_layanan
        $subQuery = $this->db->table('paket_layanan pl')
            ->select('pl.id_services, (SUM(b.harga) * pl.besar) as harga_layanan')
            ->join('barang b', 'b.id = pl.id_barang')
            ->groupBy('pl.id_services')
            ->getCompiledSelect(); // Get the SQL for the subquery
    
        // Main query with JOINs
        return $this->db->table('keranjang k')
            ->select('k.id_invoice, s.nama, i.bukti_bayar, i.tanggal_checkout, i.confirmed, pl.harga_layanan')
            ->join('users s', 's.username = k.user_username')
            ->join('invoice i', 'i.id = k.id_invoice')
            ->join("($subQuery) as pl", 'pl.id_services = k.id_services', 'left') // Using subquery here
            ->groupBy('k.id_invoice')
            ->where('k.user_username', $username)
            ->get()
            ->getResultArray();
    }

    public function getInvoiceDetailsPerInvoice($id) {
        // Subquery to calculate harga_layanan
        $subQuery = $this->db->table('paket_layanan pl')
            ->select('pl.id_services, (SUM(b.harga) * pl.besar) as harga_layanan')
            ->join('barang b', 'b.id = pl.id_barang')
            ->groupBy('pl.id_services')
            ->getCompiledSelect(); // Get the SQL for the subquery
    
        // Main query with JOINs
        return $this->db->table('keranjang k')
            ->select('k.id_invoice, s.nama, i.bukti_bayar, i.tanggal_checkout, i.confirmed, pl.harga_layanan')
            ->join('users s', 's.username = k.user_username')
            ->join('invoice i', 'i.id = k.id_invoice')
            ->join("($subQuery) as pl", 'pl.id_services = k.id_services', 'left') // Using subquery here
            ->groupBy('k.id_invoice')
            ->where('k.id_invoice', $id)
            ->get()
            ->getResultArray();
    }

    public function getServicesByInvoice($idInvoice)
    {
        $subquery = $this->db->table('keranjang')
            ->select('id_services')
            ->where('id_invoice', $idInvoice);
    
        return $this->db->table('services')  // Tabel services, bukan tabel keranjang
                ->whereIn('ID', $subquery)      // Menggunakan subquery sebagai parameter dalam whereIn
                ->get()
                ->getResultArray();
    }
        
    
    
    /**
     * Mengambil semua data invoice
     */
    public function getAllInvoices()
    {
        return $this->findAll();
    }

    /**
     * Mengambil data invoice berdasarkan ID
     *
     * @param int $id
     * @return array|null
     */
    public function getInvoiceById($id)
    {
        return $this->where('id', $id)->first();
    }

    /**
     * Menyimpan data invoice baru
     *
     * @param array $data
     * @return bool
     */
    public function saveInvoice($data)
    {
        return $this->insert($data);
    }

    /**
     * Memperbarui data invoice berdasarkan ID
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateInvoice($id, $data)
    {
        return $this->update($id, $data);
    }

    /**
     * Menghapus invoice berdasarkan ID
     *
     * @param int $id
     * @return bool
     */
    public function deleteInvoice($id)
    {
        return $this->delete($id);
    }
}
