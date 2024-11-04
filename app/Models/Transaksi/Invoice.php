<?php

namespace App\Models\Transaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'inv_id',
        'inv_status',
        'inv_idpel',
        'inv_paket',
        'inv_mitra',
        'inv_tgl_tagih',
        'inv_tgl_jatuh_tempo',
        'inv_tgl_isolir',
        'inv_tgl_bayar',
        'inv_periode',
        'inv_diskon',
        'inv_fee_sales',
        'inv_total',
        'inv_admin',
    ];
}
