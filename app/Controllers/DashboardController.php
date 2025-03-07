<?php

namespace App\Controllers;

use App\Models\ProdukModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $produkModel = new ProdukModel();

// Ambil jumlah produk kategori "iOS"
$kategoriIos = $produkModel->getProdukByKategori('iOS');

// Ambil jumlah produk kategori "Android"
$kategoriAndroid = $produkModel->getProdukByKategori('Android');

// Ambil total produk
$totalProduk = $produkModel->getTotalProduk();

// Pass data ke view
return view('dashboard', [
    'totalProduk' => $totalProduk,
    'kategoriIos' => $kategoriIos,
    'kategoriAndroid' => $kategoriAndroid
]);

    }
}
