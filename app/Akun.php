<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    protected $primaryKey = 'no_akun';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $table = "akun";
    protected $fillable = ['no_akun', 'nama_akun'];
}
