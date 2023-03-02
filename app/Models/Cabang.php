<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    use HasFactory;

    protected $table = 'cabang';

    protected $fillable = ['kd_cab', 'nama_cab', 'alamat_cab'];

    protected $primaryKey = 'kd_cab';
}
