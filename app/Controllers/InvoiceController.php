<?php

namespace App\Controllers;

use App\Models\InvoiceModel;
use App\Models\KontrakModel;
use App\Models\UsersModel;


class InvoiceController extends BaseController
{
    protected $invoiceModel;
    protected $kontrakModel;
    protected $usersModel;

    public function __construct()
    {
        $this->invoiceModel = new InvoiceModel();
        $this->kontrakModel = new KontrakModel();
        $this->usersModel = new UsersModel();
    }

    public function index()
    {
        $session = session();
        if (!empty($session->get('username')) && !empty($session->get('id_level'))) {
            // Mengambil data kontrak dari model KontrakModel
            $kontrak = $this->invoiceModel->getKontrak();
            $data = [
                'title' => 'Invoice',
                'invoice' => $this->invoiceModel->getData(),
                'kontrak' => $kontrak,
                'clients' => $this->usersModel->getUserByRole('klien')
            ];
            // dd($data);
            return view('layout/_header')
                . view('layout/_navigasi')
                . view('_invoice', $data)
                . view('layout/_footer');
        } else {
            return redirect()->to(base_url());
        }
    }

    public function save()
    {
        $session = session();
        // dd( $this->request->getPost('status'));
        if (!empty($session->get('username')) && !empty($session->get('id_level'))) {
            $insert = [
                'username' => $this->request->getPost('username'),
                'harga' => 0,
                'status' => $this->request->getPost('status'),
            ];

            $this->invoiceModel->insert($insert);
            $session->setFlashdata(
                'pesan',
                '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Berhasil menyimpan data invoice</h4>
                </div>'
            );
            return redirect()->to(base_url('infoinvoice'));
        } else {
            return redirect()->to(base_url());
        }
    }

    public function update()
    {
        $session = session();
        // dd($this->request->getPost('status'));
        if (!empty($session->get('username')) && !empty($session->get('id_level'))) {
            $id = $this->request->getPost('id');
            $update = [
                'harga' => $this->request->getPost('harga'),
                'status' => $this->request->getPost('status')
            ];

            $this->invoiceModel->update($id, $update);
            $session->setFlashdata(
                'pesan',
                '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Berhasil mengupdate data invoice</h4>
                </div>'
            );
            return redirect()->to(base_url('infoinvoice'));
        } else {
            return redirect()->to(base_url());
        }
    }

    public function delete()
    {
        $id = $this->request->getGet('id');
        $session = session();

        if (!empty($session->get('username')) && !empty($session->get('id_level'))) {
            if (!empty($id)) {
                if ($this->invoiceModel->delete($id)) {
                    $session->setFlashdata(
                        'pesan',
                        '<div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-check"></i> Berhasil menghapus data kontrak</h4>
                        </div>'
                    );
                } else {
                    $session->setFlashdata(
                        'pesan',
                        '<div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-times"></i> Gagal menghapus data kontrak</h4>
                        </div>'
                    );
                }
            } else {
                $session->setFlashdata(
                    'pesan',
                    '<div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-times"></i> ID kontrak tidak valid</h4>
                    </div>'
                );
            }
            return redirect()->to(base_url('infoinvoice'));
        } else {
            return redirect()->to(base_url());
        }
    }
    public function getHargaByIdKontrak()
{
    $id_kontrak = $this->request->getGet('id_kontrak');
    $harga = $this->invoiceModel->getHargaById($id_kontrak); // Pastikan Anda membuat metode ini di model
    
    return $this->response->setJSON(['harga' => $harga]);
}

}