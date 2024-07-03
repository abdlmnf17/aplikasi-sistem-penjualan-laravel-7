<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    //jikatidak di definisikan makan primary akan terdetek id
    protected $primaryKey = 'no_jurnal';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $table = "jurnal";
    protected $fillable = ['no_jurnal', 'keterangan', 'tgl_jurnal', 'no_akun', 'debet', 'kredit'];
}
