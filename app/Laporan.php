<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = "jurnal";
    protected $fillable = ['no_jurnal', 'tgl_jurnal', 'no_akun', 'debet', 'kredit'];
}
