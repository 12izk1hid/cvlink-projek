<?php

namespace App\Models;

use CodeIgniter\Model;

class KontrakModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kontrak';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_hasil_survei', 'id_klien', 'created_at', 'updated_at', 'harga'];

  // Fungsi untuk mengambil data id dari pengguna yang role-nya surveyor
  public function getid_hasil_survei()
  {
      // Gunakan query builder untuk mengambil data dari tabel hasil_survei
      return $this->db->table('hasil_survei')
                      ->select('id')  // Ambil kolom id saja
                     
                      ->get()
                      ->getResultArray();  // Mengembalikan hasil sebagai array
  }
  
  public function getKlien()
  {
      // Gunakan query builder untuk mengambil data dari tabel users dengan role 'surveyor'
      return $this->db->table('users')
                      ->select('id')  // Ambil kolom id saja
                      ->where('role', 'klien')  // Kondisi role = surveyor
                      ->get()
                      ->getResultArray();  // Mengembalikan hasil sebagai array
  }
}

