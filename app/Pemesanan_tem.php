<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemesanan_tem extends Model
{
    protected $primaryKey = 'kd_mnu';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $table = "temp_pemesanan";
    protected $fillable = ['kd_mnu', 'qty_pesan'];
}
