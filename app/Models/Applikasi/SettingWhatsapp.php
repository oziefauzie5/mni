<?php

namespace App\Models\Applikasi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingWhatsapp extends Model
{
    use HasFactory;
    protected $fillable = [
        'wa_nama',
        'wa_key',
        'wa_url',
        'wa_groupid',
        'wa_group_regist',
        'wa_status',
    ];
}
