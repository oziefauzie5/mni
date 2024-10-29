<?php

namespace App\Models\Paket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;
    protected $fillable = [
        'paket_nama',
        'paket_harga',
        'paket_status',

    ];
}
