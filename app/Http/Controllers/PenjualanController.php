<?php

namespace App\Http\Controllers;

use App\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use App\DetailPenjualan;
use App\MetodePembayaran;
use App\Penjualan;
use App\Pemesanan;
use App\DetailPesan;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade\Pdf;

class PenjualanController extends Controller
{
    public function index()
    {
        // Ambil semua pemesanan dengan nama pelanggan

        $pesan = DB::select('SELECT * FROM pemesanan where not exists (select * from penjualan where pemesanan.no_pesan=penjualan.no_pesan)');

        return view('penjualan.penjualan', ['pemesanan' => $pesan]);
    }
    public function invoice()
    {
        $pesan = Pemesanan::with('pelanggan')->get();

        return view('laporan.invoicepenjualan', ['pemesanan' => $pesan]);
    }

    public function edit($id)
    {
        $AWAL = 'FKT';
        $bulanRomawi = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $noUrutAkhir = \App\Penjualan::max('no_jual');
        $no = 1;
        $format = sprintf("%03s", abs((int)$noUrutAkhir + 1)) . '/' . $AWAL . '/' . $bulanRomawi[date('n')] . '/' . date('Y');
        $AWALJurnal = 'JRP';
        $bulanRomawij = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $noUrutAkhirj = \App\Jurnal::max('no_jurnal');
        $noj = 0;
        $formatj = sprintf("%03s", abs((int)$noUrutAkhirj + 1)) . '/' . $AWALJurnal . '/' . $bulanRomawij[date('n')] . '/' . date('Y');



        $decrypted = Crypt::decryptString($id);
        $pelanggan = Pemesanan::with('pelanggan')->get();
        $detail = DB::table('tampil_pemesanan')->where('no_pesan', $decrypted)->get();
        $metode = DB::table('detail_pesan')
            ->where('no_pesan', $decrypted)
            ->limit(1)
            ->get();



        $pemesanan = DB::table('pemesanan')
            ->join('pelanggan', 'pemesanan.kd_pel', '=', 'pelanggan.kd_pel')
            ->select('pemesanan.*', 'pelanggan.nm_pel as nama_pelanggan')
            ->where('pemesanan.no_pesan', $decrypted)
            ->get();


        $akunkas = DB::table('setting')->where('nama_transaksi', 'Kas')->get();
        $akunpenjualan = DB::table('setting')->where('nama_transaksi', 'penjualan')->get();
        return view('penjualan.jual', ['detail' => $detail, 'format' => $format, 'no_pesan' => $decrypted, 'pemesanan' => $pemesanan, 'formatj' => $formatj, 'kas' => $akunkas, 'penjualan' => $akunpenjualan, 'metode' => $metode]);
    }
    public function pdf($id)
    {
        $decrypted = Crypt::decryptString($id);
        $detail = DB::table('tampil_pemesanan')->where('no_pesan', $decrypted)->get();
        $pelanggan = DB::table('pelanggan')->get();
        $pemesanan = DB::table('pemesanan')->where('no_pesan', $decrypted)->get();
        $detailpesan = DB::table('detail_pesan')
            ->where('no_pesan', $decrypted)
            ->select('metode_pembayaran')
            ->distinct()
            ->get();

        $pdf = PDF::loadView('laporan.faktur', ['detail' => $detail, 'detailpesan' => $detailpesan, 'order' => $pemesanan, 'pel' => $pelanggan, 'noorder' => $decrypted]);
        return $pdf->stream();
    }

    public function simpan(Request $request)
    {
        // Validasi data yang diperlukan
        $request->validate([
            'no_pesan' => 'required',
            'no_faktur' => 'required',
            'tgl' => 'required|date',
            'total' => 'required|numeric',
            'totalAkhir' => 'required|numeric',
            'kd_mnu' => 'required|array',
            'qty_jual' => 'required|array',
            'sub_jual' => 'required|array',
            'no_jurnal' => 'required',
            'penjualan' => 'required',
            'akun' => 'required'
        ]);

        if (Penjualan::where('no_pesan', $request->no_pesan)->exists()) {
            Alert::warning('Pesan', 'Penjualan Telah dilakukan');
            return redirect('penjualan');
        } else {
            try {
                \DB::beginTransaction();

                // Simpan ke tabel pembelian
                $tambah_penjualan = new \App\Penjualan;
                $tambah_penjualan->no_jual = $request->no_faktur;
                $tambah_penjualan->tgl_jual = $request->tgl;
                $tambah_penjualan->no_faktur = $request->no_faktur;
                $tambah_penjualan->total_jual = $request->totalAkhir;
                $tambah_penjualan->no_pesan = $request->no_pesan;
                $tambah_penjualan->save();

                // Simpan data ke tabel detail penjualan
                $kdmnu = $request->kd_mnu;
                $qtyjual = $request->qty_jual;
                $subjual = $request->sub_jual;

                if ($kdmnu && $qtyjual && $subjual) {
                    foreach ($kdmnu as $key => $value) {
                        if (isset($qtyjual[$key]) && isset($subjual[$key])) {
                            $input = [
                                'no_jual' => $request->no_faktur,
                                'kd_mnu' => $value,
                                'qty_jual' => $qtyjual[$key],
                                'sub_jual' => $subjual[$key]
                            ];
                            DetailPenjualan::create($input);
                        } else {
                            throw new \Exception("Indeks $key tidak ditemukan di qty_jual atau sub_jual");
                        }
                    }
                } else {
                    throw new \Exception('Data kd_mnu, qty_jual, atau sub_jual tidak ada');
                }

                // Update saldo metode pembayaran
                $detailPesan = DetailPesan::where('no_pesan', $request->no_pesan)->get();
                foreach ($detailPesan as $item) {
                    $metodePembayaran = MetodePembayaran::where('nama', $item->metode_pembayaran)->first();

                    if ($metodePembayaran) {
                        $metodePembayaran->saldo += $request->totalAkhir;
                        $metodePembayaran->save();
                    }
                }

                // Simpan ke tabel jurnal bagian debit
                $tambah_jurnaldebet = new \App\Jurnal;
                $tambah_jurnaldebet->no_jurnal = $request->no_jurnal;
                $tambah_jurnaldebet->keterangan = 'KAS';
                $tambah_jurnaldebet->tgl_jurnal = $request->tgl;
                $tambah_jurnaldebet->no_akun = $request->penjualan;
                $tambah_jurnaldebet->debet = $request->totalAkhir;
                $tambah_jurnaldebet->kredit = '0';
                $tambah_jurnaldebet->save();

                // Simpan ke tabel jurnal bagian kredit
                $tambah_jurnalkredit = new \App\Jurnal;
                $tambah_jurnalkredit->no_jurnal = $request->no_jurnal;
                $tambah_jurnalkredit->keterangan = 'PENJUALAN';
                $tambah_jurnalkredit->tgl_jurnal = $request->tgl;
                $tambah_jurnalkredit->no_akun = $request->akun;
                $tambah_jurnalkredit->debet = '0';
                $tambah_jurnalkredit->kredit = $request->totalAkhir;
                $tambah_jurnalkredit->save();

                \DB::commit();

                Alert::success('Pesan', 'Pembelian berhasil');
                return redirect('/daftar-penjualan');
            } catch (\Exception $e) {
                \DB::rollBack();
                // Log the error message
                \Log::error($e->getMessage());
                Alert::error('Pesan', 'Terjadi kesalahan: ' . $e->getMessage());
                return redirect('penjualan');
            }
        }
    }


    public function destroy($no_pesan)
    {
        $pesan = \App\Penjualan::findOrFail($no_pesan);
        $pesan->delete();
        Alert::success('Penjualan', 'Data berhasil dihapus');
        return redirect('transaksi');
    }
}
