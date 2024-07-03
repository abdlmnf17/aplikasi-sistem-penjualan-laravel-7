<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPesan extends Model
{
    protected $primaryKey = 'no_pesan';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $table = "detail_pesan";
    protected $fillable = ['no_pesan', 'kd_mnu', 'qty_mnu', 'subtotal'];
}
