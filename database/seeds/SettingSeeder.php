<?php

use Illuminate\Database\Seeder;
use  App\Setting;
class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
            $setting = Setting :: create([
            'id_setting' => '1',
            'no_akun' => '401',
            'nama_transaksi' => 'Penjualan',
            ]);
            $setting = Setting :: create([
            'id_setting' => '2',
            'no_akun' => '101',
            'nama_transaksi' => 'Kas',
            ]);
    }
}
