<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //jika tidak di definisikan, maka primary akan terdetek id
    protected $primaryKey = 'kd_mnu';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $table = "menu";
    protected $fillable = ['kd_mnu', 'nm_mnu', 'harga'];
}
