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
    protected $allowedFields    = ['id', 'id_surveyors', 'Tanggal_survei', 'Jenis_instalasi', 'kebutuhan_material', 'estimasi_waktu', 'catatan_hasil_survei'];


}
