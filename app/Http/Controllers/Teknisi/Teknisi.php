<?php

namespace App\Http\Controllers\Teknisi;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Global\GlobalController;
use App\Models\Pesan\Pesan;
use App\Models\Registrasi\Pelanggan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Teknisi extends Controller
{
    public function index()
    {
        // dd('a');
        $user = (new GlobalController)->user_admin();
        $user_id = $user['user_id'];
        $role = (new globalController)->data_user($user_id);
        $data['role'] = $role->name;
        $m = date('m', strtotime(new Carbon()));

        $query = Pelanggan::select('pakets.id', 'pakets.paket_nama', 'pelanggans.*')
            ->join('pakets', 'pakets.id', '=', 'pelanggans.reg_paket')
            ->where('reg_status', '=', 1);

        $data['verifikasi'] = $query->get();
        $data['pemasangan'] = $query->count();

        $query1 = Pelanggan::where('reg_status', '=', 1);
        $data['total_pemasangan'] = $query1->count();

        // dd($data['pelanggan']);

        return view('Teknisi/index', $data);
    }
    public function aktivasi($id)
    {
        // dd('a');
        $user = (new GlobalController)->user_admin();
        $user_id = $user['user_id'];
        $role = (new globalController)->data_user($user_id);
        $data['role'] = $role->name;
        $m = date('m', strtotime(new Carbon()));

        $query = Pelanggan::select('pakets.id', 'pakets.paket_nama', 'pelanggans.*')
            ->join('pakets', 'pakets.id', '=', 'pelanggans.reg_paket')
            ->where('reg_status', '=', 1);

        $data['pel'] = $query->first();

        $query = Pelanggan::where('reg_status', '=', 1);
        $data['pemasangan'] = $query->count();

        $query1 = Pelanggan::where('reg_status', '=', 1);
        $data['total_pemasangan'] = $query1->count();

        // dd($data['pelanggan']);

        return view('Teknisi/aktivasi', $data);
    }

    // public function input()
    // {
    //     $data['data_wilayah'] = Wilayah::all();

    //     $data['data_paket'] = Paket::all();
    //     // $data['data_user'] = User::all();
    //     $user = (new GlobalController)->user_admin();
    //     $user_id = $user['user_id'];
    //     $role = (new globalController)->data_user($user_id);
    //     $data['role'] = $role->name;
    //     $data['admin_user'] = (new GlobalController)->user_admin();

    //     return view('sales/input', $data);
    // }

    public function proses_aktivasi(Request $request)
    {
        // $data['idpel'] = (new GlobalController)->idpel();
        $user = (new GlobalController)->user_admin();
        $admin_id = $user['user_id'];
        $admin = $user['user_nama'];

        Session::flash('reg_username', $request->reg_username);
        Session::flash('reg_password', $request->reg_password);
        Session::flash('reg_mrek', $request->reg_mrek);
        Session::flash('reg_kelengkapan', $request->reg_kelengkapan);
        Session::flash('reg_sn', $request->reg_sn);
        Session::flash('reg_kabel', $request->reg_kabel);
        Session::flash('reg_tgl_pasang', $request->reg_tgl_pasang);
        Session::flash('addons', $request->addons);


        $request->validate([
            'reg_username' => 'required',
            'reg_password' => 'required',
            'reg_mrek' => 'required',
            'reg_kelengkapan' => 'required',
            'reg_sn' => 'required',
            'reg_kabel' => 'required',


        ], [
            'reg_username.required' => 'Username tidak boleh kosong',
            'reg_mrek.required' => 'Merek Perangkat tidak boleh kosong',
            'reg_kelengkapan.required' => 'Kelengkapan Lainnya tidak boleh kosong',
            'reg_sn.required' => 'Serial Number Perangkat tidak boleh kosong',
            'reg_kabel.required' => 'Penggunaan kabel tidak boleh kosong',
        ]);


        $data['reg_username'] = $request->reg_username;
        $data['reg_password'] = $request->reg_password;
        $data['reg_mrek'] = $request->reg_mrek;
        $data['reg_sn'] = $request->reg_sn;
        $data['reg_kabel'] = $request->reg_kabel;
        $data['reg_tgl_pasang'] = date('Y-m-d', strtotime(Carbon::now()));
        $data['reg_status'] = '2';

        // dd($data);
        Pelanggan::where('reg_idpel', $request->reg_idpel)->update($data);

        $pel = Pelanggan::select('pakets.id', 'pakets.paket_nama', 'pelanggans.*')
            ->join('pakets', 'pakets.id', '=', 'pelanggans.reg_paket')
            ->where('reg_idpel', '=', $request->reg_idpel)
            ->first();
        $status = (new GlobalController)->whatsapp_status();

        if ($status) {
            if ($status->wa_status == 'Enable') {
                $pesan_pelanggan['status'] = '0';
                $pesan_group['status'] = '0';
            } else {
                $pesan_pelanggan['status'] = '10';
                $pesan_group['status'] = '10';
            }
        }



        $pesan_group['ket'] = 'registrasi';
        $pesan_group['target'] = '120363262623415382@g.us';
        $pesan_group['nama'] = $request->reg_nama;
        $pesan_group['pesan'] = '               -- SELESAI PEMASANGAN --

Pemasangan telah selesai dikerjakan  😊

Pelanggan : ' . $request->reg_nama . '
Alamat : ' . $pel->reg_wilayah .
            '
Panjang Kabel : ' . $request->total . '
Biaya Kabel : ' . $request->addons . '
Perlengkapan : ' . $request->reg_kelengkapan . '


Diaktivasi Oleh : ' . $admin . '
';
        // dd($pesan_group);

        Pesan::create($pesan_group);
        $notifikasi = array(
            'pesan' => 'Berhasil melakukan pemasangan',
            'alert' => 'success',
        );
        return redirect()->route('admin.teknisi.index')->with($notifikasi);
    }
}
