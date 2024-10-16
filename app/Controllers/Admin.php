<?php

namespace App\Controllers;

use App\Models\AccountModel;
use App\Models\LevelUserModel;
use App\Models\UserModel;
use App\Models\KasModel;
use App\Models\JurnalModel;
use App\Models\JurnalbankModel;
use App\Models\InvoiceModel;
use App\Models\InvoicedetailModel;
use App\Models\KategoriModel;
use App\Models\JasaModel;



class Admin extends BaseController
{
    protected $levelModel, $userModel, $accountModel, $kasModel, $jurnalModel,
        $invoiceModel, $invoicedetailModel, $jurnalbankModel, $kategoriModel, $jasaModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->levelModel = new LevelUserModel();
        $this->accountModel = new AccountModel();
        $this->kasModel = new KasModel();
        $this->jurnalModel = new JurnalModel();
        $this->jurnalbankModel = new JurnalbankModel();
        $this->invoiceModel = new InvoiceModel();
        $this->invoicedetailModel = new InvoicedetailModel();
        $this->kategoriModel = new KategoriModel();
        $this->jasaModel = new JasaModel();
    }

    public function index()
    {
        $session = session();
        if (!empty($session->get('username')) and !empty($session->get('id_level'))) {
            $data = [
                'title' => 'WGSL',
                'kas'       => $this->ambilkas(),
                'kasb'       => $this->ambilkasbank(),
            ];
            return view('layout/_header')
                . view('layout/_navigasi')
                . view('layout/_content', $data)
                . view('layout/_footer');
        } else {
            return redirect()->to(base_url());
        }
    }

    public function user()
    {
        $session = session();
        if (!empty($session->get('username')) and !empty($session->get('id_level'))) {
            $data = [
                'title' => 'User',
                'user'  => $this->userModel->getUser(),
                "level" => $this->levelModel->findAll()
            ];
            return view('layout/_header')
                . view('layout/_navigasi')
                . view('_user', $data)
                . view('layout/_footer');
        } else {
            return redirect()->to(base_url());
        }
    }

    public function simpanuser()
    {
        $session = session();
        if (!empty($session->get('username')) and !empty($session->get('id_level'))) {
            $insert = [
                'username'  => $this->request->getVar('username'),
                'nama'      => $this->request->getVar('nama'),
                'password'  => md5($this->request->getVar('password')),
                'id_level'  => $this->request->getVar('id_level'),
                'aktif'     => 'Y',
                'idupdate' => $_SESSION['id'],
            ];
            $session->setFlashdata(
                'pesan',
                '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Berhasil simpan data user</h4>
            </div>'
            );
            $this->userModel->insert($insert);
            return redirect()->to(base_url() . 'infouser');
        } else {
            return redirect()->to(base_url());
        }
    }

    public function updateuser()
    {
        $session = session();
        if (!empty($session->get('username')) and !empty($session->get('id_level'))) {
            $update = [
                'username'  => $this->request->getVar('username'),
                'nama'      => $this->request->getVar('nama'),
                'password'  => md5($this->request->getVar('password')),
                'id_level'  => $this->request->getVar('id_level'),
                'aktif'     => 'Y',
                'idupdate' => $_SESSION['id'],
            ];
            $where = [
                'id'   => $this->request->getVar('id'),
            ];
            $session->setFlashdata(
                'pesan',
                '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Berhasil update data user</h4>
            </div>'
            );
            $this->userModel->update($where, $update);
            return redirect()->to(base_url() . 'infouser');
        } else {
            return redirect()->to(base_url());
        }
    }

 // Fungsi untuk menampilkan semua jasa kepada user (dengan session)
 public function jasa()
 {
     $session = session();
     if (!empty($session->get('username')) && !empty($session->get('id_level'))) {
         $data = [
             'title' => 'Jasa',
             'jasa'  => $this->jasaModel->findAll()
         ];
         return view('layout/_header')
             . view('layout/_navigasi')
             . view('_jasa', $data) // Mengarahkan ke view jasa
             . view('layout/_footer');
     } else {
         return redirect()->to(base_url());
     }
 }

 // Fungsi untuk menyimpan jasa baru
 public function simpanjasa()
 {
     $session = session();
     if (!empty($session->get('username')) && !empty($session->get('id_level'))) {
         $insert = [
             'nama_item' => $this->request->getVar('nama_item'),
             'type'      => $this->request->getVar('type'),
             'min_harga' => $this->request->getVar('min_harga'),
             'max_harga' => $this->request->getVar('max_harga'),
             'idupdate'  => $session->get('id'),  // Simpan ID user yang update
         ];
         $this->jasaModel->insert($insert);
         $session->setFlashdata(
             'pesan',
             '<div class="alert alert-success alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                 <h4><i class="icon fa fa-check"></i> Berhasil simpan data jasa</h4>
             </div>'
         );
         return redirect()->to(base_url() . 'infojasa');
     } else {
         return redirect()->to(base_url());
     }
 }

 // Fungsi untuk mengupdate jasa
 public function updatejasa()
 {
     $session = session();
     if (!empty($session->get('username')) && !empty($session->get('id_level'))) {
         $update = [
             'nama_item' => $this->request->getVar('nama_item'),
             'type'      => $this->request->getVar('type'),
             'min_harga' => $this->request->getVar('min_harga'),
             'max_harga' => $this->request->getVar('max_harga'),
             'idupdate'  => $session->get('id'),  // ID user yang update
         ];
         $where = [
             'id_jasa'   => $this->request->getVar('id_jasa'),  // Mendapatkan ID jasa dari form
         ];
         $this->jasaModel->update($where['id_jasa'], $update);
         $session->setFlashdata(
             'pesan',
             '<div class="alert alert-success alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                 <h4><i class="icon fa fa-check"></i> Berhasil update data jasa</h4>
             </div>'
         );
         return redirect()->to(base_url() . 'infojasa');
     } else {
         return redirect()->to(base_url());
     }
 }



    public function kategori()
    {
        $session = session();
        if (!empty($session->get('username')) && !empty($session->get('id_level'))) {
            $data = [
                'title' => 'Kategori',
                'kategori' => $this->kategoriModel->getKategori(),  // Ambil data kategori
            ];
            return view('layout/_header')
                . view('layout/_navigasi')
                . view('_kategori', $data)
                . view('layout/_footer');
        } else {
            return redirect()->to(base_url());
        }
    }

    public function simpankategori()
    {
        $session = session();
        if (!empty($session->get('username')) && !empty($session->get('id_level'))) {
            $insert = [
                'kategori' => $this->request->getVar('kategori'),
            ];
            $this->kategoriModel->insert($insert);  // Menyimpan data kategori baru
            $session->setFlashdata('pesan', 
                '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Berhasil simpan data kategori</h4>
            </div>');
            return redirect()->to(base_url('infokategori'));
        } else {
            return redirect()->to(base_url());
        }
    }

    public function updatekategori()
    {
        $session = session();
        if (!empty($session->get('username')) && !empty($session->get('id_level'))) {
            $id_k = $this->request->getVar('id');  // Mengambil ID dari form
            $update = [
                'kategori' => $this->request->getVar('kategori'),
            ];
            $this->kategoriModel->update($id_k, $update);  // Update berdasarkan ID
            $session->setFlashdata('pesan', 
                '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Berhasil update data kategori</h4>
            </div>');
            return redirect()->to(base_url('infokategori'));
        } else {
            return redirect()->to(base_url());
        }
    }

    public function hapuskategori()
    {
        $session = session();
        if (!empty($session->get('username')) && !empty($session->get('id_level'))) {
            $id_k = $this->request->getVar('id');  // Mengambil ID dari form
            $this->kategoriModel->delete($id_k);  // Hapus berdasarkan ID
            $session->setFlashdata('pesan', 
                '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Berhasil hapus data kategori</h4>
            </div>');
            return redirect()->to(base_url('infokategori'));
        } else {
            return redirect()->to(base_url());
        }
    }



    public function invoice()
    {
        $session = session();
        if (!empty($session->get('username')) and !empty($session->get('id_level'))) {
            $data = [
                'title'  => 'Invoice',
                'invoicecode' => $this->invoicecode(),
                'invoice' => $this->invoiceModel->orderby('id', 'DESC')->findAll(),
                'id'     => $this->ambilidinvoicemaks(),
            ];
            return view('layout/_header')
                . view('layout/_navigasi')
                . view('_invoice', $data)
                . view('layout/_footer');
        } else {
            return redirect()->to(base_url());
        }
    }

    public function simpaninvoice()
    {
        $session = session();
        if (!empty($session->get('username')) and !empty($session->get('id_level'))) {
            $inv = explode("-", $this->request->getVar('id_invoice'));
            $id = $inv[3];

            $insertinvoice = [
                'tgl_dibuat'    => date('Y-m-d', strtotime($this->request->getVar('tgl_dibuat'))),
                'penerima'      => $this->request->getVar('penerima'),
                'alamat'      => $this->request->getVar('alamat'),
                'notelp'      => $this->request->getVar('notelp'),
                'status'      => '1',
                'userupdate'  => $_SESSION['username'],

            ];
            $cek = $this->invoiceModel->insert($insertinvoice);
            if ($cek) {
                return redirect()->to(base_url() . 'detailinvoice/' . $id);
            }
            $session->setFlashdata(
                'pesan',
                '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4></i> Invoice Gagal di buat</h4>
            </div>'
            );
            return redirect()->to(base_url() . 'infoinvoice');
        } else {
            return redirect()->to(base_url());
        }
    }
    public function jurnal()
    {
        $session = session();
        if (!empty($session->get('username')) and !empty($session->get('id_level'))) {
            $data = [
                'title' => 'Jurnal',
                'jurnal'  => $this->jurnalbankModel->findAll(),
                'kas'   => $this->ambilkasbank(),
            ];
            return view('layout/_header')
                . view('layout/_navigasi')
                . view('_jurnal', $data)
                . view('layout/_footer');
        } else {
            return redirect()->to(base_url());
        }
    }

    public function cetakjurnal()
    {
        $session = session();
        if (!empty($session->get('username')) and !empty($session->get('id_level'))) {
            $pilihan = $this->request->getVar('pilihancetak');
            $bulan = $this->request->getVar('bulan');
            $tahun = $this->request->getVar('tahun');

            if ($pilihan == 'A' and $bulan == '0' and $tahun == '0') {
                $data = [
                    'title'     => 'Laporan Jurnal Keseluruhan',
                    'alamat'    => $this->alamat(),
                    'status'    => $pilihan,
                    'jurnal'    => $this->jurnalbankModel->findAll(),
                    'kas'    => $this->ambilkasbank(),
                ];
                return view('_jurnal-print', $data);
            } else if ($pilihan == 'A' and $bulan > '0' and $tahun > '0') {
                $data = [
                    'title'     => 'Laporan Jurnal Bulan : ' . $bulan . '-' . $tahun,
                    'alamat'    => $this->alamat(),
                    'status'    => $pilihan,
                    'jurnal'    => $this->jurnalbankModel->where("month(tgltransaksi)='$bulan' AND year(tgltransaksi)= '$tahun'")->findAll(),
                    'kas'    => $this->ambilkasbank(),
                ];
                return view('_jurnal-print', $data);
            } elseif ($pilihan == 'D' and $bulan > '0' and $tahun > '0') {
                // D
                $data = [
                    'title'     => 'Laporan Debet Jurnal Bulan : ' . $bulan . '-' . $tahun,
                    'alamat'    => $this->alamat(),
                    'status'    => $pilihan,
                    'jurnal'    => $this->jurnalbankModel->where("month(tgltransaksi)='$bulan' AND year(tgltransaksi)= '$tahun'")->findAll(),
                    'kas'    => $this->ambilkasbank(),
                ];
                return view('_jurnal-print-d', $data);
            } elseif ($pilihan == 'K' and $bulan > '0' and $tahun > '0') {
                // K
                $data = [
                    'title' => 'Laporan Kredit Jurnal Bulan : ' . $bulan . '-' . $tahun,
                    'alamat'    => $this->alamat(),
                    'status'    => $pilihan,
                    'jurnal'    => $this->jurnalbankModel->where("month(tgltransaksi)='$bulan' AND year(tgltransaksi)= '$tahun'")->findAll(),
                    'kas'    => $this->ambilkasbank(),
                ];
                return view('_jurnal-print-k', $data);
            }
        } else {
            return redirect()->to(base_url());
        }
    }
}
