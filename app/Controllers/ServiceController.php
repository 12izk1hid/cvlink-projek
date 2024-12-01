<?php

namespace App\Controllers;

use App\Models\ServicesModel;
use CodeIgniter\Controller;

class ServiceController extends Controller
{
    protected $servicesModel;

    public function __construct()
    {
        // Inisialisasi model secara manual
        $this->servicesModel = new ServicesModel();
    }

    // Menampilkan daftar layanan
    public function index()
    {
        $services = $this->servicesModel->findAll();
        $title = 'Daftar Layanan';

        // View concatenation fixed
        return view('layout/_header')
            . view('layout/_navigasi')
            . view('Admin/_services', [
                'services' => $services,
                'title' => $title
            ]) 
            . view('layout/_footer');
    }

    // Menambahkan layanan baru
    public function save()
    {
        $validation = \Config\Services::validation();

        // Validasi file upload
        $validation->setRules([
            'foto' => [
                'label' => 'Foto',
                'rules' => 'uploaded[foto]|is_image[foto]|mime_in[foto,image/png,image/jpg,image/jpeg]|max_size[foto,2048]',
                'errors' => [
                    'uploaded' => 'File foto harus diunggah.',
                    'is_image' => 'File yang diunggah harus berupa gambar.',
                    'mime_in' => 'Format file yang diperbolehkan hanya PNG, JPG, atau JPEG.',
                    'max_size' => 'Ukuran file maksimal 2MB.',
                ]
            ],
        ]);

        // If validation fails
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->with('error', $validation->getErrors());
        }

        // Mengambil file foto
        $foto = $this->request->getFile('foto');
        $newName = $foto->getRandomName(); // Membuat nama file unik

        // Memindahkan file ke folder public/assets/images
        if ($foto->isValid() && !$foto->hasMoved()) {
            $foto->move(FCPATH . 'assets/images', $newName);
        } else {
            return redirect()->back()->with('error', 'Gagal mengunggah foto.');
        }

        // Simpan data ke database
        $data = [
            'nama' => $this->request->getPost('nama'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'harga' => $this->request->getPost('harga'),
            'img_url' => 'assets/images/' . $newName, // Path ke gambar
        ];

        // Insert data and handle errors if any
        if ($this->servicesModel->insert($data)) {
            return redirect()->to('/services')->with('success', 'Jasa berhasil ditambahkan.');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan layanan.');
        }
    }

    // Menghapus layanan
    public function delete($id)
    {
        $service = $this->servicesModel->find($id);

        if ($service) {
            $imgPath = FCPATH . $service['img_url']; // Path lengkap gambar

            // Hapus file gambar jika ada
            if (is_file($imgPath)) {
                unlink($imgPath);
            }

            // Hapus data dari database
            if ($this->servicesModel->delete($id)) {
                return redirect()->to('/services')->with('message', 'Layanan berhasil dihapus!');
            } else {
                return redirect()->to('/services')->with('error', 'Gagal menghapus layanan.');
            }
        }

        return redirect()->to('/services')->with('error', 'Layanan tidak ditemukan!');
    }

    // Memperbarui layanan
    public function update()
    {
        if ($this->request->getMethod() === 'post') {
            if (!$this->validate([
                'nama' => 'required',
                'deskripsi' => 'required',
                'harga' => 'required|numeric',
            ])) {
                return redirect()->back()->withInput()->with('error', 'Validasi gagal.');
            }

            $id = $this->request->getPost('id');
            $service = $this->servicesModel->find($id);

            if (!$service) {
                return redirect()->back()->with('error', 'Layanan tidak ditemukan.');
            }

            // Pemrosesan file gambar
            $foto = $this->request->getFile('foto');
            $img_url = $service['img_url']; // Default ke gambar lama

            if ($foto && $foto->isValid() && !$foto->hasMoved()) {
                $newName = $foto->getRandomName();
                $foto->move(FCPATH . 'assets/images', $newName);
                $img_url = 'assets/images/' . $newName;

                // Hapus gambar lama
                $oldImgPath = FCPATH . $service['img_url'];
                if (is_file($oldImgPath)) {
                    unlink($oldImgPath);
                }
            }

            // Update data
            $data = [
                'id' => $id,
                'nama' => $this->request->getPost('nama'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'harga' => $this->request->getPost('harga'),
                'img_url' => $img_url,
            ];

            if ($this->servicesModel->save($data)) {
                return redirect()->to('/services')->with('message', 'Layanan berhasil diperbarui!');
            }

            return redirect()->back()->with('error', 'Gagal memperbarui layanan.');
        }

        return redirect()->back()->with('error', 'Method tidak valid.');
    }

    // Menampilkan gambar berdasarkan ID layanan
    public function showImage($id)
    {
        $service = $this->servicesModel->find($id);

        if ($service && !empty($service['img_url'])) {
            $imgPath = FCPATH . $service['img_url'];

            if (is_file($imgPath)) {
                $mimeType = mime_content_type($imgPath);
                return $this->response
                    ->setHeader('Content-Type', $mimeType)
                    ->setBody(file_get_contents($imgPath));
            }
        }

        // Redirect ke gambar default jika tidak ditemukan
        return $this->response
            ->setHeader('Content-Type', 'image/jpeg')
            ->setBody(file_get_contents(FCPATH . 'assets/img/default.jpg'));
    }
}
