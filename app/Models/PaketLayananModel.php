<?php

namespace App\Models;

use CodeIgniter\Model;

class PaketLayananModel extends Model
{
    protected $table = 'paket_layanan';
    protected $primaryKey = 'id';

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
            // Mengambil data berdasarkan layanan yang spesifik
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

    // Fungsi untuk mendapatkan detail keranjang berdasarkan user_id
    public function getKeranjangDetails($idUser) {
        return $this->db->table('keranjang k')
            ->select('s.nama as nama_layanan, b.nama as nama_barang, pl.besar as besar_jumlah, 
                     b.harga as harga_satuan, b.besaran as besaran, b.harga * pl.besar as harga_total')
            ->join('paket_layanan pl', 'k.id_paket_layanan = pl.id')
            ->join('services s', 'pl.id_services = s.id')
            ->join('barang b', 'pl.id_barang = b.id')
            ->where('k.id_user', $idUser)
            ->get()
            ->getResultArray();
    }

    public function getKeranjangOf($user_username) {
        return $this->db->table('paket_layanan pl')
            ->select('s.img_url as gambar_service, pl.id_services as id, s.nama as nama_service, 
                    (SUM(b.harga * pl.besar) + s.harga) as harga_total, s.deskripsi')
            ->join('services s', 's.id = pl.id_services') // Join tabel services untuk data service
            ->join('barang b', 'b.id = pl.id_barang') // Join tabel barang untuk data barang
            ->join('keranjang k', 'k.id_paket_layanan = pl.id') // Join tabel keranjang untuk menghubungkan paket layanan
            ->join('invoice i', 'i.id = k.id_invoice') // Join tabel invoice untuk mendapatkan invoice yang terkait dengan keranjang
            ->where('i.user_username', $user_username) // Pastikan hanya mengambil yang sesuai dengan user_username
            ->groupBy('pl.id_services') // Kelompokkan hasil berdasarkan id_services
            ->get()
            ->getResultArray();

    }

    public function getBarangByService($idServices)
    {
        // Menggunakan query builder untuk menjalankan SQL
        $builder = $this->db->table('barang b');
        $builder->select('DISTINCT b.*, pl.besar as jumlah', false); // Menambahkan DISTINCT
        $builder->join('paket_layanan pl', 'pl.id_barang = b.id'); // Pastikan join sesuai hubungan tabel
        $builder->where('pl.id_services', $idServices); // Menentukan layanan yang sesuai
    
        // Menjalankan query dan mengembalikan hasilnya
        return $builder->get()->getResultArray();
    }
    
}
