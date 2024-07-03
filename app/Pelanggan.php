<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    
    //jika tidak di definisikan, maka primary akan terdetek id
    protected $primaryKey = 'kd_pel';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $table = "pelanggan";
    protected $fillable = ['kd_pel', 'nm_pel', 'telepon'];
}
