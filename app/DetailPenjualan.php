<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    protected $primaryKey = 'no_jual';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $table = "detail_penjualan";
    protected $fillable = ['no_jual', 'kd_mnu', 'qty_jual', 'sub_jual'];
}
