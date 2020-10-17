<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangSatuan extends Model
{
    protected $table = 'barang_satuan';
    protected $fillable = ['id_barang', 'satuan', 'x', 'y'];
    public $timestamps = false;
}
