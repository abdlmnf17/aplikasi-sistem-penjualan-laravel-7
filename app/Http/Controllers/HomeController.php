<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Menu;
use App\MetodePembayaran;
use App\Pelanggan;
use App\Pemesanan;
use App\Penjualan;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $totalPembayaran = MetodePembayaran::count();
        $totalMenu = Menu::count();
        $totalSaldoMenu = DB::table('metode_pembayaran')->sum('saldo');
        $totalPelanggan = Pelanggan::count();
        $totalPemesanan = DB::table('pemesanan')
            ->whereNotExists(function ($query) {
                $query->select('*')
                    ->from('penjualan')
                    ->whereColumn('pemesanan.no_pesan', 'penjualan.no_pesan');
            })
            ->count();
        $totalPenjualan = Penjualan::count();
        $totalInvoice = Pemesanan::count();


        return view('home', [
            'totalPembayaran' => $totalPembayaran,
            'totalMenu' => $totalMenu,
            'totalPelanggan' => $totalPelanggan,
            'totalPemesanan' => $totalPemesanan,
            'totalPenjualan' => $totalPenjualan,
            'totalSaldoMenu' => $totalSaldoMenu,
            'totalInvoice' => $totalInvoice,
        ]);
    }
}
