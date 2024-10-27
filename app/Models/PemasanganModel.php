<?php

namespace App\Models;

use CodeIgniter\Model;

class PemasanganModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pemasangan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = ['id_kontrak', 'tanggal_mulai', 'tanggal_selesai', 'status_pemasangan', 'id_teknisi', 'catatan_pemasangan'];


    // Fungsi untuk mengambil data id dari pengguna yang role-nya surveyor
    public function getId_kontrak()
    {
        // Gunakan query builder untuk mengambil data dari tabel users dengan role 'surveyor'
        return $this->db->table('kontrak')
                        ->select('id')  // Ambil kolom id saja
   
                        ->get()
                        ->getResultArray();
    }
    public function getId_teknisi()
    {
        // Gunakan query builder untuk mengambil data dari tabel users dengan role 'surveyor'
        return $this->db->table('users')
                        ->select('id')  // Ambil kolom id saja
                        ->where('role', 'teknisi')  // Kondisi role = surveyor
                        ->get()
                        ->getResultArray();  // Mengembalikan hasil sebagai array
    }
}
