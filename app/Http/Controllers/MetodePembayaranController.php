<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MetodePembayaran; // Pastikan ini mengarah ke model yang benar
use RealRashid\SweetAlert\Facades\Alert;

class MetodePembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil semua data metode pembayaran
        $metodePembayaran = MetodePembayaran::all();
        // Mengirim data ke view
        return view('metode_pembayaran.index', ['metodePembayaran' => $metodePembayaran]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Menampilkan form untuk menambahkan metode pembayaran
        return view('metode_pembayaran.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'status' => 'required|string',
            'saldo' => 'required|numeric|min:0',
        ]);

        // Menyimpan data metode pembayaran baru
        MetodePembayaran::create([
            'nama' => $request->input('nama'),
            'status' => $request->input('status'),
            'saldo' => $request->input('saldo'),
        ]);

        // Menampilkan notifikasi sukses
        Alert::success('Success', 'Metode pembayaran berhasil ditambahkan.');

        // Mengalihkan kembali ke halaman daftar
        return redirect()->route('metodepembayaran.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Menampilkan detail metode pembayaran
        $metode = MetodePembayaran::findOrFail($id);
        return view('metode_pembayaran.show', ['metode' => $metode]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Menampilkan form untuk mengedit metode pembayaran
        $metode = MetodePembayaran::findOrFail($id);
        return view('metode_pembayaran.edit', ['metode' => $metode]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'status' => 'required|string',
            'saldo' => 'required|numeric|min:0',
        ]);

        // Menemukan metode pembayaran berdasarkan ID
        $metode = MetodePembayaran::findOrFail($id);

        // Memperbarui data metode pembayaran
        $metode->update([
            'nama' => $request->input('nama'),
            'status' => $request->input('status'),
            'saldo' => $request->input('saldo'),
        ]);

        // Menampilkan notifikasi sukses
        Alert::success('Success', 'Metode pembayaran berhasil diperbarui.');

        // Mengalihkan kembali ke halaman daftar
        return redirect()->route('metodepembayaran.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Menemukan metode pembayaran berdasarkan ID
        $metode = MetodePembayaran::findOrFail($id);

        // Menghapus data metode pembayaran
        $metode->delete();

        // Menampilkan notifikasi sukses
        Alert::success('Success', 'Metode pembayaran berhasil dihapus.');

        // Mengalihkan kembali ke halaman daftar
        return redirect()->route('metodepembayaran.index');
    }
}
