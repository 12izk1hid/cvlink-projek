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
    protected $allowedFields    = ['id_tagihan', 'id_jasa'];

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
                      ->select('*')  // Ambil kolom id saja
                      ->where('role', 'klien')  // Kondisi role = surveyor
                      ->get()
                      ->getResultArray();  // Mengembalikan hasil sebagai array
  }

  public function getHargaFromId($id) {
    return $this->db->table('kontrak')->select('harga')->where('id', $id)->get()->getResultArray()[0]['harga'];
  }

  public function getData() {
    return $this->db->table('kontrak k')->select('k.*, u.nama as nama_client')
      ->join('users u', 'u.id = k.id_klien')
      ->get()->getResultArray();
  }

}

