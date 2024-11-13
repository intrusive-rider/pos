<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home() {
        return view('dashb.home');
    }

    public function kategori_brg() {
        return view('dashb.kategori');
    }

    public function data_brg() {
        return view('dashb.barang');
    }

    public function stok_brg() {
        return view('dashb.stok');
    }

    public function penjualan() {
        return view('dashb.penjualan');
    }

    public function laporan_pb() {
        return view('dashb.laporan-pb');
    }
}
