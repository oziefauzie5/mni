<?php

namespace App\Http\Controllers\Global;

use App\Http\Controllers\Controller;
use App\Models\Applikasi\SettingAkun;
use App\Models\Applikasi\SettingBiaya;
use App\Models\Applikasi\SettingWhatsapp;
use App\Models\Mitra\Mutasi;
use App\Models\Mitra\MutasiSales;
use App\Models\PSB\InputData;
use App\Models\Registrasi\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaksi\Invoice;
use App\Models\Transaksi\Jurnal;
use App\Models\Transaksi\Kendaraan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class GlobalController extends Controller
{
    public function tanggal() #mennampilkan data user
    {
        $tanggal = Carbon::now();

        return $tanggal;
    }
    public function user_admin() #mennampilkan data user
    {
        $data['user_id'] = Auth::user()->id;
        $data['user_nama'] = Auth::user()->name;
        $data['user_hp'] = Auth::user()->hp;
        return $data;
    }

    public function data_user($iduser) #mennampilkan data user sesuai hak akses (Mitra Controller |  |  |)
    {
        $data_user =  DB::table('users')
            ->select('users.name AS nama_user', 'roles.name', 'users.hp', 'users.email', 'users.alamat_lengkap', 'users.username', 'users.password')
            ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->where('users.id', '=', $iduser)
            ->first();
        return $data_user;
    }
    public function role($iduser) #mennampilkan data user sesuai hak akses (Mitra Controller |  |  |)
    {
        $role =  DB::table('users')
            ->select('users.name AS nama_user', 'roles.name', 'roles.id as role_id', 'users.hp', 'users.email', 'users.alamat_lengkap', 'users.username', 'users.password')
            ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->where('users.id', '=', $iduser)
            ->first();
        return $role;
    }

    public function all_user() #mennampilkan data user
    {
        $all_user =  DB::table('users')
            ->select('users.name AS nama_user', 'roles.name', 'users.*', 'model_has_roles.*')
            ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->where('users.id', '>', 10);
        return $all_user;
    }

    public function whatsapp_status()
    {
        $wa_status =  SettingWhatsapp::first();
        return $wa_status;
    }



    // function idpel()
    // {
    //     $latest = InputData::latest()->first();
    //     if (! $latest) {
    //         return '0001';
    //     }
    //     $string = substr($latest->id, 2);
    //     return sprintf('%05d', $latest->id + 1);
    // }
    // test pembuatan idpelanggan otomatis
    function idpel()
    {
        $th = date('y', strtotime(new Carbon()));
        $bl = date('m', strtotime(new Carbon()));
        $count = Pelanggan::count();
        $latest = Pelanggan::latest()->first();

        if (! $latest) {
            return $th . $bl . '0001';
        }
        $cek_count = Pelanggan::where('id', $count)->count();
        if ($cek_count) {
            return $th . $bl . sprintf('%04d', $latest->id + 1);
        } else {
            return $th . $bl . sprintf('%04d', $count + 1);
        }
    }
}
