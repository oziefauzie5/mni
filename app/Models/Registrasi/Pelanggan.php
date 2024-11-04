<?php

namespace App\Models\Registrasi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    protected $fillable = [
        'reg_idpel',
        'reg_nama',
        'reg_tgl_lahir',
        'reg_identistas',
        'reg_hp1',
        'reg_hp2',
        'reg_email',
        'reg_alamat_pasang',
        'reg_alamat_tagih',
        'reg_sales',
        'reg_fee_sales',
        'reg_subseles',
        'reg_paket',
        'reg_harga',
        'reg_username',
        'reg_password',
        'reg_tgl_pasang',

        'reg_mrek',
        'reg_sn',
        'reg_status',

        'reg_kabel',
        'reg_kelengkapan',
        'reg_catatan',
        'reg_wilayah',
    ];
}
