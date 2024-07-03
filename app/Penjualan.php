<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $primaryKey = 'no_jual';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $table = "penjualan";
    protected $fillable = ['no_jual','tgl_jual', 'no_faktur', 'total_jual', 'no_pesan'];
}
