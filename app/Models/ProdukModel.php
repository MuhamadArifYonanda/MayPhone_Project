<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id';
    protected $allowedFields = ['thumbnail', 'produk', 'harga', 'id_kategori'];

    // Mengambil produk beserta nama kategori berdasarkan ID produk
    public function getProdukWithKategori($id = null)
    {
        $builder = $this->select('produk.*, kategori.nama_kategori') // Pilih kolom dari produk dan kategori
                        ->join('kategori', 'kategori.id = produk.id_kategori'); // Join tabel kategori berdasarkan id

        if ($id !== null) {
            $builder->where('produk.id', $id); // Tambahkan kondisi berdasarkan id produk
            return $builder->get()->getRowArray(); // Ambil satu baris data sebagai array
        }

        return $builder->findAll(); // Jika id tidak diberikan, ambil semua data
    }

    // Mengambil jumlah total produk
    public function getTotalProduk()
    {
        return $this->countAll();
    }

    // Ambil jumlah produk berdasarkan nama kategori
    public function getProdukByKategori($kategori)
    {
        return $this->select('produk.*')
                    ->join('kategori', 'kategori.id = produk.id_kategori') // Join dengan kategori
                    ->where('kategori.nama_kategori', $kategori) // Filter berdasarkan nama kategori
                    ->countAllResults();
    }
}
