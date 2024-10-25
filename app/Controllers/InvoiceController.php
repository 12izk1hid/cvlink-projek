<?php

namespace App\Controllers;

use App\Models\InvoiceModel;


class InvoiceController extends BaseController
{
    protected $invoiceModel;


    public function __construct()
    {
        $this->invoiceModel = new InvoiceModel();
    }

    public function index()
    {
        $session = session();
        if (!empty($session->get('username')) && !empty($session->get('id_level'))) {
            $kontrak = $this->invoiceModel->getKontrak();
            $data = [
                'title' => 'invoice',
                'invoice'  => $this->invoiceModel->findAll(),
                'kontrak' => $kontrak
            ];
            return view('layout/_header')
                . view('layout/_navigasi')
                . view('_invoice', $data) // Mengarahkan ke view jasa
                . view('layout/_footer');
        } else {
            return redirect()->to(base_url());
        }
    }

    public function save()
    {
        $session = session();
        if (!empty($session->get('username')) && !empty($session->get('id_level'))) {
            $insert = [
         
            'id_kontrak'   => $this->request->getPost('id_kontrak'),
            'harga'        => $this->request->getPost('harga'),
            'Status'       => $this->request->getPost('Status'),
        ];

        $this->invoiceModel->insert($insert);
            $session->setFlashdata(
                'pesan',
                '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Berhasil simpan data pengguna</h4>
                </div>'
            );
            return redirect()->to(base_url() . 'infoinvoice');
        } else {
            return redirect()->to(base_url());
        }
    }

    public function update()
    {
        $session = session();
        if (!empty($session->get('username')) && !empty($session->get('id_level'))) {
            $update = [
                'id_kontrak'   => $this->request->getPost('id_kontrak'),
                'harga'        => $this->request->getPost('harga'),
                'Status'       => $this->request->getPost('Status'),
                    ];
            $where = [
                'id_kontrak'   => $this->request->getVar('id_kontrak'),  
            ];
            $this->invoiceModel->update($where['id_kontrak'], $update);
            $session->setFlashdata(
                'pesan',
                '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Berhasil update data jasa</h4>
                </div>'
            );
            return redirect()->to(base_url() . 'infoinvoice');
        } else {
            return redirect()->to(base_url());
        }
}
public function delete() {
    $id = $this->request->getGet('id_kontrak'); // Mengambil ID dari query string
    $session = session();

    if (!empty($session->get('username')) && !empty($session->get('id_level'))) {
        // Memeriksa apakah ID tidak kosong
        if (!empty($id)) {
            // Memeriksa apakah penghapusan data berhasil
            if ($this->invoiceModel->delete($id)) { // Metode ini sudah benar jika id_kontrak adalah primary key
                // Set pesan sukses ke session
                $session->setFlashdata(
                    'pesan',
                    '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Berhasil menghapus data kontrak</h4>
                    </div>'
                );
            } else {
                // Set pesan gagal ke session
                $session->setFlashdata(
                    'pesan',
                    '<div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-times"></i> Gagal menghapus data kontrak</h4>
                    </div>'
                );
            }
        } else {
            // Set pesan jika ID kosong
            $session->setFlashdata(
                'pesan',
                '<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-times"></i> ID kontrak tidak valid</h4>
                </div>'
            );
        }
        // Redirect ke halaman info jasa setelah penghapusan
        return redirect()->to(base_url('infoinvoice'));

    } else {
        return redirect()->to(base_url('infoinvoice'));
    }
}

}
