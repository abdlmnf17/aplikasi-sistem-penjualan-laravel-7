<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jual extends Model
{
    protected $primaryKey = 'no_pesan';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $table = "tampil_pemesanan";
    protected $fillable = ['kd_menu', 'no_pesan', 'nm_mnu', 'qty_pesan', 'sub_total'];
}
