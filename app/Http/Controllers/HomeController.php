<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home() {
        return view('dashb.home');
    }

    public function kategori_brg() {

        $posts = Post::paginate(10); // 10 item per halaman
        return view('dashb.kategori', compact('posts'));
    }

    public function tb_kategori() {
        return view('dashb.tambah-kategori');
    }

    public function submitKategori(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|min:5|max:50',
        ], [
            'nama_kategori.required' => 'Isian title wajib diisikan',
            'nama_kategori.min' => 'Minimal isian untuk title adalah 5 karakter',
            'nama_kategori.max' => 'Maksimum isian untuk title adalah 50 karakter',
        ]);

        Post::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('kategori_brg')->with('massage', 'Nama Kategori berhasil ditambahkan');
    } 

    public function data_brg() {
        return view('dashb.barang');
    }

    public function tb_barang() {
        return view('dashb.tambah-barang');
    }

    public function stok_brg() {
        return view('dashb.stok');
    }

    public function tb_stok() {
        return view('dashb.tambah-stok');
    }

    public function penjualan() {
        return view('dashb.penjualan');
    }

    public function laporan_pb() {
        return view('dashb.laporan-pb');
    }
}
