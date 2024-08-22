<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    //jika tidak di definisikan makan primary akan terdetek id
    protected $primaryKey = 'no_pesan';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $table = "pemesanan";
    protected $fillable = ['no_pesan', 'tgl_pesan', 'total', 'kd_pel'];
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'kd_pel', 'kd_pel');
    }

    

}
