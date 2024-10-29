<?php

namespace App\Models\Area;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    use HasFactory;
    protected $fillable = [
        'wil_id',
        'wil_desa',
        'wil_kecamatan',
        'wil_kota',
        'wil_status',
    ];
}
