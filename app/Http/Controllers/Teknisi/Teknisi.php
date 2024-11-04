<?php

namespace App\Http\Controllers\Teknisi;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Global\GlobalController;
use App\Models\Pesan\Pesan;
use App\Models\Registrasi\Pelanggan;
use App\Models\Teknisi\Teknisi as TeknisiTeknisi;
use App\Models\Transaksi\Invoice;
use App\Models\Transaksi\SubInvoice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Teknisi extends Controller
{
    public function index()
    {
        $user = (new GlobalController)->user_admin();
        $user_id = $user['user_id'];
        $role = (new globalController)->data_user($user_id);
        $data['role'] = $role->name;
        $data['teknisi'] = (new GlobalController)->all_user()->where('model_has_roles.role_id', '>', 5)->get();
        $m = date('m', strtotime(new Carbon()));

        $query = Pelanggan::select('users.id', 'users.name', 'pakets.id', 'pakets.paket_nama', 'pelanggans.*')
            ->join('pakets', 'pakets.id', '=', 'pelanggans.reg_paket')
            ->join('users', 'users.id', '=', 'pelanggans.reg_sales')
            ->whereIn('reg_status', [1, 2]);

        $data['job'] = $query->get();
        $data['pemasangan'] = $query->count();

        $query1 = Pelanggan::where('reg_status', '=', 1);
        $data['total_pemasangan'] = $query1->count();

        return view('Teknisi/index', $data);
    }
    public function job(Request $request, $id)
    {
        $user = (new GlobalController)->user_admin();
        $tanggal = (new GlobalController)->tanggal();
        $user_id = $user['user_id'];
        $explode1 = explode("|", $request->teknisi);
        $team = $explode1[1] . ' & ' . ucwords($request->sub_teknisi);
        $data['teknisi_userid'] = $user_id;
        $data['teknisi_team'] = $team;
        $data['teknisi_job'] = $request->job;
        $data['teknisi_idpel'] = $id;
        $data['teknisi_start_date'] = date('Y-m-d H:m:s', strtotime($tanggal));
        $data['teknisi_status'] = 0;
        TeknisiTeknisi::create($data);

        $reg['reg_status'] = 2;
        Pelanggan::where('reg_idpel', $id)->update($reg);
        $notifikasi = array(
            'pesan' => 'Berhasil mengambil Job',
            'alert' => 'success',
        );
        return redirect()->route('admin.teknisi.index')->with($notifikasi);
    }
    public function list_aktivasi()
    {
        $user = (new GlobalController)->user_admin();
        $data['teknisi_id'] = $user['user_id'];

        $query = Pelanggan::select('teknisis.id', 'teknisis.teknisi_team', 'teknisis.teknisi_userid', 'pelanggans.*')
            ->join('teknisis', 'teknisis.teknisi_idpel', '=', 'pelanggans.reg_idpel')
            ->where('reg_status', '=', 2);

        $data['pel'] = $query->get();
        return view('Teknisi/list_aktivasi', $data);
    }
    public function aktivasi($id)
    {
        $user = (new GlobalController)->user_admin();
        $user_id = $user['user_id'];
        $role = (new globalController)->data_user($user_id);
        $data['role'] = $role->name;
        $m = date('m', strtotime(new Carbon()));

        $query = Pelanggan::select('pakets.id', 'pakets.paket_nama', 'pelanggans.*')
            ->join('pakets', 'pakets.id', '=', 'pelanggans.reg_paket')
            ->where('reg_status', '=', 2)
            ->where('reg_idpel', '=', $id);

        $data['pel'] = $query->first();

        $query = Pelanggan::where('reg_status', '=', 1);
        $data['pemasangan'] = $query->count();

        $query1 = Pelanggan::where('reg_status', '=', 1);
        $data['total_pemasangan'] = $query1->count();
        return view('Teknisi/aktivasi', $data);
    }

    public function proses_aktivasi(Request $request)
    {
        $tanggal = (new GlobalController)->tanggal();
        $user = (new GlobalController)->user_admin();
        $admin_id = $user['user_id'];
        $admin = $user['user_nama'];
        $no_inv = (new GlobalController)->no_inv();
        $data_pelanggan = (new GlobalController)->data_pelanggan($request->reg_idpel);
        $tgl_pasang = date('Y-m-d', strtotime($tanggal));
        $tgl_jatuh_tempo = Carbon::create($tgl_pasang)->toDateString();
        $tgl_tagih = Carbon::create($tgl_pasang)->toDateString();
        $tgl_isolir = Carbon::create($tgl_pasang)->addDay(1)->toDateString();
        $periode = Carbon::create($tgl_pasang)->toDateString() . ' - ' . Carbon::create($tgl_pasang)->addMonth(1)->toDateString();

        Session::flash('reg_username', $request->reg_username);
        Session::flash('reg_password', $request->reg_password);
        Session::flash('reg_mrek', $request->reg_mrek);
        Session::flash('reg_kelengkapan', $request->reg_kelengkapan);
        Session::flash('reg_sn', $request->reg_sn);
        Session::flash('reg_kabel', $request->reg_kabel);
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
        $data['reg_tgl_pasang'] = $tgl_pasang;
        $data['reg_status'] = '3';
        $data['reg_kelengkapan'] = $request->reg_kelengkapan;

        Pelanggan::where('reg_idpel', $request->reg_idpel)->update($data);

        $inv['inv_id'] = $no_inv;
        $inv['inv_status'] = 'UNPAID';
        $inv['inv_idpel'] = $request->reg_idpel;
        $inv['inv_paket'] = $data_pelanggan->paket_nama;
        $inv['inv_mitra'] = $data_pelanggan->reg_sales;
        $inv['inv_tgl_tagih'] = $tgl_tagih;
        $inv['inv_tgl_jatuh_tempo'] = $tgl_jatuh_tempo;
        $inv['inv_tgl_isolir'] = $tgl_isolir;
        $inv['inv_fee_sales'] = $data_pelanggan->reg_fee_sales;
        $inv['inv_periode'] = $periode;
        $inv['inv_diskon'] = '0';
        $inv['inv_total'] = $data_pelanggan->reg_fee_sales + $data_pelanggan->reg_harga;
        Invoice::create($inv);

        $sub_inv['subinvoice_id'] = $no_inv;
        $sub_inv['subinvoice_deskripsi'] = $data_pelanggan->paket_nama . ' ' . $periode;
        $sub_inv['subinvoice_qty'] = '1';
        $sub_inv['subinvoice_harga'] = $data_pelanggan->reg_fee_sales + $data_pelanggan->reg_harga;
        $sub_inv['subinvoice_ppn'] = '0';
        $sub_inv['subinvoice_total'] =  ($data_pelanggan->reg_fee_sales + $data_pelanggan->reg_harga) * 1;

        SubInvoice::create($sub_inv);


        $teknisi['teknisi_end_date'] = date('Y-m-d H:m:s', strtotime($tanggal));
        TeknisiTeknisi::where('teknisi_idpel', $request->reg_idpel)
            ->where('teknisi_userid', $admin_id)
            ->where('teknisi_job', 'PSB')
            ->update($teknisi);
        // dd($teknisi);

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
Alamat : ' . $data_pelanggan->reg_wilayah .
            '
Panjang Kabel : ' . $request->total . '
Biaya Kabel : ' . $request->addons . '
Perlengkapan : ' . $request->reg_kelengkapan . '

Waktu Selesai : ' . date('d-m-Y H:m:s', strtotime(Carbon::now())) . '
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
