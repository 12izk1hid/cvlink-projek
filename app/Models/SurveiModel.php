<?php

namespace App\Models;

use CodeIgniter\Model;

class SurveiModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'hasil_survei';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = ['id_surveyors', 'Tanggal_survei', 'Jenis_instalasi', 'kebutuhan_material', 'estimasi_waktu', 'catatan_hasil_survei'];


    // Fungsi untuk mengambil data id dari pengguna yang role-nya surveyor
    public function getSurveyors()
    {
        // Gunakan query builder untuk mengambil data dari tabel users dengan role 'surveyor'
        return $this->db->table('users')
                        ->select('id,nama')  // Ambil kolom id saja
                        ->where('role', 'surveyor')  // Kondisi role = surveyor
                        ->get()
                        ->getResultArray();  // Mengembalikan hasil sebagai array
    }

    public function getData() {
        return $this->db->table('hasil_survei h')
            ->select('u.nama as nama_surveyor, h.*')
            ->join('users u', 'u.id = h.id_surveyors')
            ->get()
            ->getResultArray();
    }
}
