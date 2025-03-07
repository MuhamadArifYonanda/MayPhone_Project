<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\KategoriModel;
use CodeIgniter\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $produkModel = new ProdukModel();
        $kategoriModel = new KategoriModel();

        $data = [
            'produk' => $produkModel->getProdukWithKategori(), // Pastikan metode ini mengembalikan data
            'kategori' => $kategoriModel->findAll(),
            'title' => 'Daftar Produk',
        ];

        return view('admin', $data);
    }

    public function create()
    {
        $produk = $this->request->getPost('produk');
        $harga = $this->request->getPost('harga');
        $id_kategori = $this->request->getPost('id_kategori');

        // Handle file upload
        $thumbnail = $this->request->getFile('thumbnail');
        $thumbnail_name = '';

        if ($thumbnail && $thumbnail->isValid() && !$thumbnail->hasMoved()) {
            $thumbnail_name = $thumbnail->getRandomName();
            $thumbnail->move(ROOTPATH . 'public/uploads', $thumbnail_name);
        }

        $produkModel = new ProdukModel();

        $data = [
            'thumbnail' => $thumbnail_name,
            'produk' => $produk,
            'harga' => $harga,
            'id_kategori' => $id_kategori,
        ];

        $produkModel->save($data);

        return redirect()->to(base_url('/admin'))->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit($id)
{
    $produkModel = new ProdukModel();
    $kategoriModel = new KategoriModel();

    // Ambil data produk berdasarkan ID
    $produk = $produkModel->getProdukWithKategori($id);

    // Cek apakah produk ditemukan
    if (!$produk) {
        return redirect()->to(base_url('/admin'))->with('error', 'Produk tidak ditemukan.');
    }

    $data = [
        'produk' => $produk,
        'kategori' => $kategoriModel->findAll(),
        'title' => 'Edit Produk',
    ];

    return view('edit', $data);
}

public function update($id)
{
    $produkModel = new ProdukModel();

    // Validasi dan update data
    $data = [
        'produk' => $this->request->getPost('produk'),
        'harga' => $this->request->getPost('harga'),
        'id_kategori' => $this->request->getPost('id_kategori'),
    ];

    if ($this->request->getFile('thumbnail')->isValid()) {
        // Hapus file lama
        $produk = $produkModel->find($id);
        if ($produk['thumbnail']) {
            unlink(ROOTPATH . '/public/uploads/' . $produk['thumbnail']);
        }

        // Simpan file baru
        $file = $this->request->getFile('thumbnail');
        $thumbnail_name = $file->getRandomName();
        $file->move(ROOTPATH . '/public/uploads', $thumbnail_name);

        $data['thumbnail'] = $thumbnail_name;
    }

    $produkModel->update($id, $data);

    // Set flashdata sukses
    return redirect()->to(base_url('/admin'))->with('success', 'Produk berhasil diperbarui!');
}


    public function delete($id)
    {
        $produkModel = new ProdukModel();

        // Fetch the product to delete (to delete the image as well)
        $produk = $produkModel->find($id);

        if ($produk) {
            // Delete the associated image if exists
            if (!empty($produk['thumbnail']) && file_exists(ROOTPATH . 'public/uploads/' . $produk['thumbnail'])) {
                unlink(ROOTPATH . 'public/uploads/' . $produk['thumbnail']);
            }

            $produkModel->delete($id);
            return redirect()->to(base_url('/admin'))->with('success', 'Produk berhasil dihapus!');
        }

        return redirect()->to(base_url('/admin'))->with('error', 'Produk tidak ditemukan.');
    }
}
