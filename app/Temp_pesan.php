<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temp_pesan extends Model
{
    protected $primaryKey = 'kd_brg';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $table = "view_temp_pesan";
    protected $fillable = ['kd_mnu', 'nm_mnu', 'harga'];
}
