<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\Pelanggan;
use App\Pemesanan;
use App\Pemesanan_tem;
use App\Temp_pesan;
use App\MetodePembayaran;
use RealRashid\SweetAlert\Facades\Alert;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */




    public function index()
    {
        $metodePembayaran = MetodePembayaran::all();
        $akun = \App\Akun::All();
        $menu = \App\Menu::All();
        $pelanggan = \App\Pelanggan::All();
        $temp_pesan = \App\Temp_pesan::All();
        //No otomatis untuk transaksi pemesanan
        $AWAL = 'TRX';
        $bulanRomawi = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $noUrutAkhir = \App\Pemesanan::max('no_pesan');
        $no = 1;
        $formatnya = sprintf("%03s", abs((int)$noUrutAkhir + 1)) . '/' . $AWAL . '/' . $bulanRomawi[date('n')] . '/' . date('Y');
        return view(
            'pemesanan.pemesanan',
            [
                'menu' => $menu,
                'akun' => $akun,
                'pelanggan' => $pelanggan,
                'temp_pemesanan' => $temp_pesan,
                'formatnya' => $formatnya,
                'metodePembayaran' => $metodePembayaran
            ]
        );
    }
    public function tambahOrder()
    {
        return view('pemesanan');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


     public function store(Request $request)
{
    $menu = Menu::find($request->mnu);

    if (!$menu) {
        return response()->json([
            'success' => false,
            'message' => 'Menu tidak ditemukan.',
        ]);
    }

    $existingItem = Pemesanan_tem::where('kd_mnu', $request->mnu)->first();

    if ($existingItem) {
        // Update existing item
        $existingItem->update([
            'qty_pesan' => $request->qty,
            'sub_total' => $request->qty * $menu->harga
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Barang sudah ada. QTY diperbarui.',
            'data' => [
                'kd_mnu' => $existingItem->kd_mnu,
                'nm_mnu' => $menu->nm_mnu,
                'qty_pesan' => $request->qty,
                'sub_total' => $request->qty * $menu->harga
            ]
        ]);
    } else {
        // Create new item
        $newItem = Pemesanan_tem::create([
            'qty_pesan' => $request->qty,
            'kd_mnu' => $request->mnu,
            'nm_mnu' => $menu->nm_mnu,
            'harga' => $menu->harga,
            'sub_total' => $request->qty * $menu->harga
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Menu ditambahkan.',
            'data' => [
                'kd_mnu' => $newItem->kd_mnu,
                'nm_mnu' => $menu->nm_mnu,
                'qty_pesan' => $request->qty,
                'sub_total' => $request->qty * $menu->harga
            ]
        ]);
    }
}





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {}


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kd_mnu)
    {
        try {
            $menu = \App\Pemesanan_tem::where('kd_mnu', $kd_mnu)->firstOrFail();
            $menu->delete();

            // Jika penghapusan berhasil
            return response()->json(['success' => true, 'message' => 'Data berhasil dihapus']);
        } catch (\Exception $e) {
            // Jika terjadi kesalahan
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat menghapus data']);
        }
    }

}
