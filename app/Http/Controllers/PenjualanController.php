<?php

namespace App\Http\Controllers;
use App\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use App\DetailPenjualan;
use App\Penjualan;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade\Pdf;

class PenjualanController extends Controller
{
    public function index()
    {
        $pesan = \App\Pemesanan::All();
        $pesan = DB::select('SELECT * FROM pemesanan where not exists (select * from penjualan where pemesanan.no_pesan=penjualan.no_pesan)');
        return view('penjualan.penjualan', ['pemesanan' => $pesan]);
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
        $detail = DB::table('tampil_pemesanan')->where('no_pesan', $decrypted)->get();
        $pemesanan = DB::table('pemesanan')->where('no_pesan', $decrypted)->get();
        $akunkas = DB::table('setting')->where('nama_transaksi', 'Kas')->get();
        $akunpenjualan = DB::table('setting')->where('nama_transaksi', 'penjualan')->get();
        return view('penjualan.jual', ['detail' => $detail, 'format' => $format, 'no_pesan' => $decrypted, 'pemesanan' => $pemesanan, 'formatj' => $formatj, 'kas' => $akunkas, 'penjualan' => $akunpenjualan]);
    }
    public function pdf($id)
    {
        $decrypted = Crypt::decryptString($id);
        $detail = DB::table('tampil_pemesanan')->where('no_pesan', $decrypted)->get();
        $pelanggan = DB::table('pelanggan')->get();
        $pemesanan = DB::table('pemesanan')->where('no_pesan', $decrypted)->get();
        $pdf = PDF::loadView('laporan.faktur', ['detail' => $detail, 'order' => $pemesanan, 'pel' => $pelanggan, 'noorder' => $decrypted]);
        return $pdf->stream();
    }
    public function simpan(Request $request)
    {
        if (Penjualan::where('no_pesan', $request->no_pesan)->exists()) {
            Alert::warning('Pesan ', 'Penjualan Telah dilakukan ');
            return redirect('penjualan');
        } else {
            //Simpan ke table pembelian
            $tambah_penjualan = new \App\Penjualan;
            $tambah_penjualan->no_jual = $request->no_faktur;
            $tambah_penjualan->tgl_jual = $request->tgl;
            $tambah_penjualan->no_faktur = $request->no_faktur;
            $tambah_penjualan->total_jual = $request->total;
            $tambah_penjualan->no_pesan = $request->no_pesan;
            $tambah_penjualan->save();
            //SIMPAN DATA KE TABEL DETAIL PENJUALAN
            $kdmnu = $request->kd_mnu;
            $qtyjual = $request->qty_jual;
            $subjual = $request->sub_jual;
            if ($request->kdmnu) {
                foreach ($kdmnu as $key) {
                    $input['no_jual'] = $request->no_faktur;
                    $input['kd_mnu'] = $kdmnu[$key];
                    $input['qty_jual'] = $qtyjual[$key];
                    $input['sub_jual'] = $subjual[$key];
                    DetailPenjualan::insert($input);
                }
            }
            //SIMPAN ke table jurnal bagian debet
            $tambah_jurnaldebet = new \App\Jurnal;
            $tambah_jurnaldebet->no_jurnal = $request->no_jurnal;
            $tambah_jurnaldebet->keterangan = ' KAS ';
            $tambah_jurnaldebet->tgl_jurnal = $request->tgl;
            $tambah_jurnaldebet->no_akun = $request->penjualan;
            $tambah_jurnaldebet->debet = $request->total;
            $tambah_jurnaldebet->kredit = '0';
            $tambah_jurnaldebet->save();
            //SIMPAN ke table jurnal bagian kredit
            $tambah_jurnalkredit = new \App\Jurnal;
            $tambah_jurnalkredit->no_jurnal = $request->no_jurnal;
            $tambah_jurnalkredit->keterangan = 'PENJUALAN';
            $tambah_jurnalkredit->tgl_jurnal = $request->tgl;
            $tambah_jurnalkredit->no_akun = $request->akun;
            $tambah_jurnalkredit->debet = '0';
            $tambah_jurnalkredit->kredit = $request->total;
            $tambah_jurnalkredit->save();
            Alert::success('Pesan ', 'Data berhasil disimpan');
            return redirect('/penjualan');
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
