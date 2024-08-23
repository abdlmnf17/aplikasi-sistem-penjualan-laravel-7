<?php

namespace App\Http\Controllers;
use App\Pelanggan;
use Illuminate\Http\Request;
use App\DetailPesan;
use App\Pemesanan;
use RealRashid\SweetAlert\Facades\Alert;

class DetailPesanController extends Controller
{
    public function simpan(Request $request)
    {
        //Simpan ke table pemesanan
        $tambah_pemesanan = new \App\Pemesanan;
        $tambah_pemesanan->no_pesan = $request->no_pesan;
        $tambah_pemesanan->tgl_pesan = $request->tgl;
        $tambah_pemesanan->total = $request->total_akhir;
        $tambah_pemesanan->kd_pel = $request->kd_pel;
        $tambah_pemesanan->save();
        //Simpan data ke table detail pesan
        $kd_mnu = $request->kd_mnu;
        $qty = $request->qty_pesan;
        $sub_total = $request->sub_total;

        foreach ($kd_mnu as $key => $no) {
            $input['no_pesan'] = $request->no_pesan;
            $input['kd_mnu'] = $kd_mnu[$key];
            $input['qty_pesan'] = $qty[$key];
            $input['metode_pembayaran'] = $request->metode_pembayaran;
            $input['subtotal'] = $sub_total[$key];
            DetailPesan::insert($input);
        }
        Alert::success('Pesan ', 'Data berhasil disimpan');
        return redirect('/transaksi');
    }
}
