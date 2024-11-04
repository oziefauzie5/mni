<?php

namespace App\Models\Teknisi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teknisi extends Model
{
    use HasFactory;
    protected $fillable = [
        'teknisi_userid',
        'teknisi_team',
        'teknisi_job',
        'teknisi_idpel',
        'teknisi_start_date',
        'teknisi_end_date',
        'teknisi_status',
    ];
}
