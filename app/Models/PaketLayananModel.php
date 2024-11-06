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
                ->select('s.img_url as gambar_service, pl.id_services as id, s.nama as nama_service, (SUM(b.harga * pl.besar)+s.harga) as harga_total, s.deskripsi')
                ->join('services s', 's.id = pl.id_services')
                ->join('barang b', 'b.id = pl.id_barang')
                ->groupBy('pl.id_services')
                ->get()
                ->getResultArray();
        } else {
            return $this->db->table('paket_layanan pl')
                ->select('b.img_url as gambar_barang, pl.id_services as id, s.nama as nama_services, b.harga as harga_satuan, pl.besar as jumlah, b.nama as nama_barang, b.harga * pl.besar as harga_total')
                ->join('services s', 's.id = pl.id_services')
                ->join('barang b', 'b.id = pl.id_barang')
                ->where('pl.id_services', $id_services)
                ->get()
                ->getResultArray();
        }
    }
}
