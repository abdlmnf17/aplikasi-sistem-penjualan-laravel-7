<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penjualan;
use PDF;

class LaporanPenjualanController extends Controller
{

    public function index()
    {
        return view('laporan.penjualan');
    }

    public function generatePDF(Request $request)
    {
        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');


        $penjualans = Penjualan::whereBetween('tgl_jual', [$tanggal_awal, $tanggal_akhir])->get();


        $pdf = PDF::loadView('laporan.penjualancetak', compact('penjualans', 'tanggal_awal', 'tanggal_akhir'));

        return $pdf->stream('laporan_penjualan.pdf');
    }
}
