<?php

namespace App\Models;

use CodeIgniter\Model;

class PaketLayananModel extends Model
{
    protected $table = 'paket_layanan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_services', 'id_barang', 'besar'];

    // Fungsi untuk mendapatkan informasi layanan
    public function getServiceInfo($id_services = null)
    {
        if (is_null($id_services)) {
            return $this->db->table('paket_layanan pl')
                ->select('s.img_url as gambar_service, pl.id_services as id, s.nama as nama_service, 
                         (SUM(b.harga * pl.besar) + s.harga) as harga_total, s.deskripsi')
                ->join('services s', 's.id = pl.id_services')
                ->join('barang b', 'b.id = pl.id_barang')
                ->groupBy('pl.id_services')
                ->get()
                ->getResultArray();
        } else {
            return $this->db->table('paket_layanan pl')
                ->select('s.nama as nama_service, b.nama as nama_barang, pl.besar as besar_jumlah, 
                         b.harga as harga_satuan, b.besaran as besaran, b.harga * pl.besar as harga_total')
                ->join('services s', 's.id = pl.id_services')
                ->join('barang b', 'b.id = pl.id_barang')
                ->where('pl.id_services', $id_services)
                ->get()
                ->getResultArray();
        }
    }

    // Fungsi untuk mendapatkan keranjang berdasarkan user_username
    public function getKeranjangOf($user_username)
    {
        return $this->db->table('paket_layanan pl')
            ->select('s.img_url as gambar_service, pl.id_services as id, s.nama as nama_service, 
                    (SUM(b.harga * pl.besar) + s.harga) as harga_total, s.deskripsi')
            ->join('services s', 's.id = pl.id_services')
            ->join('barang b', 'b.id = pl.id_barang')
            ->join('keranjang k', 'k.id_services = pl.id_services')
            ->join('invoice i', 'i.id = k.id_invoice')
            ->where('i.user_username', $user_username)
            ->groupBy('pl.id_services')
            ->get()
            ->getResultArray();
    }

    // Fungsi untuk mendapatkan barang berdasarkan layanan
    public function getBarangByService($idServices)
    {
        $builder = $this->db->table('barang b');
        $builder->select('DISTINCT b.*, pl.besar as jumlah', false);
        $builder->join('paket_layanan pl', 'pl.id_barang = b.id');
        $builder->where('pl.id_services', $idServices);
        return $builder->get()->getResultArray();
    }

    // Fungsi CRUD
    /**
     * Tambahkan paket layanan baru.
     */
    public function createPaketLayanan($data)
    {
        return $this->insert($data);
    }

    /**
     * Ambil paket layanan berdasarkan ID.
     */
    public function getPaketLayananById($id)
    {
        return $this->find($id);
    }

    /**
     * Perbarui paket layanan berdasarkan ID.
     */
    public function updatePaketLayanan($id, $data)
    {
        return $this->update($id, $data);
    }

    /**
     * Hapus paket layanan berdasarkan ID.
     */
    public function deletePaketLayanan($id)
    {
        return $this->delete($id);
    }
}
