<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class CreateViews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Buat view view_temp_pesan
        DB::statement("
            CREATE VIEW view_temp_pesan AS
            SELECT
                temp_pemesanan.kd_mnu AS kd_mnu,
                CONCAT(menu.nm_mnu, menu.harga) AS nm_mnu,
                temp_pemesanan.qty_pesan AS qty_pesan,
                menu.harga * temp_pemesanan.qty_pesan AS sub_total
            FROM
                temp_pemesanan
            JOIN
                menu
            ON
                temp_pemesanan.kd_mnu = menu.kd_mnu;
        ");

        // Buat view tampil_pemesanan
        DB::statement("
            CREATE VIEW tampil_pemesanan AS
            SELECT
                detail_pesan.kd_mnu AS kd_mnu,
                detail_pesan.no_pesan AS no_pesan,
                menu.nm_mnu AS nm_mnu,
                detail_pesan.qty_pesan AS qty_pesan,
                detail_pesan.subtotal AS sub_total
            FROM
                detail_pesan
            JOIN
                menu
            ON
                detail_pesan.kd_mnu = menu.kd_mnu;
        ");

        // Buat view tampil_penjualan
        DB::statement("
            CREATE VIEW tampil_penjualan AS
            SELECT
                menu.kd_mnu AS kd_mnu,
                detail_penjualan.no_jual AS no_jual,
                menu.nm_mnu AS nm_mnu,
                menu.harga AS harga,
                detail_penjualan.qty_jual AS qty_jual
            FROM
                menu
            JOIN
                detail_penjualan
            ON
                menu.kd_mnu = detail_penjualan.kd_mnu;
        ");

        // Buat view lap_jurnal
        DB::statement("
            CREATE VIEW lap_jurnal AS
            SELECT
                akun.nm_akun AS nm_akun,
                jurnal.tgl_jurnal AS tgl,
                SUM(jurnal.debet) AS debet,
                SUM(jurnal.kredit) AS kredit
            FROM
                akun
            JOIN
                jurnal
            ON
                akun.no_akun = jurnal.no_akun
            GROUP BY
                akun.nm_akun, jurnal.tgl_jurnal;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Hapus view jika migrasi di-rollback
        DB::statement('DROP VIEW IF EXISTS view_temp_pesan');
        DB::statement('DROP VIEW IF EXISTS tampil_pemesanan');
        DB::statement('DROP VIEW IF EXISTS tampil_penjualan');
        DB::statement('DROP VIEW IF EXISTS lap_jurnal');
    }
}
