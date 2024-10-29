<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Global\GlobalController;
use App\Models\Area\Wilayah;
use App\Models\Paket\Paket;
use App\Models\Pesan\Pesan;
use App\Models\Registrasi\Pelanggan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Registrasi\Pelanggan as RegistrasiPelanggan;

class Sales extends Controller
{
    public function index()
    {
        $user = (new GlobalController)->user_admin();
        $user_id = $user['user_id'];
        $role = (new globalController)->data_user($user_id);
        $data['role'] = $role->name;
        $m = date('m', strtotime(new Carbon()));

        $query = Pelanggan::select('pakets.id', 'pakets.paket_nama', 'pelanggans.*')
            ->join('pakets', 'pakets.id', '=', 'pelanggans.reg_paket')
            ->where('reg_sales', '=', $user_id);



        $data['registrasi'] = $query->get();
        $data['penjualan'] = $query->count();

        $query1 = Pelanggan::where('reg_sales', '=', $user_id);
        $data['total_penjualan'] = $query1->count();

        // dd($data['pelanggan']);

        return view('Sales/index', $data);
    }

    public function input()
    {
        $data['data_wilayah'] = Wilayah::all();

        $data['data_paket'] = Paket::all();
        // $data['data_user'] = User::all();
        $user = (new GlobalController)->user_admin();
        $user_id = $user['user_id'];
        $role = (new globalController)->data_user($user_id);
        $data['role'] = $role->name;
        $data['admin_user'] = (new GlobalController)->user_admin();

        return view('sales/input', $data);
    }

    public function store(Request $request)
    {
        $data['idpel'] = (new GlobalController)->idpel();
        $user = (new GlobalController)->user_admin();
        $admin_id = $user['user_id'];
        $admin = $user['user_nama'];
        Session::flash('reg_nama', $request->reg_nama);
        Session::flash('reg_identistas', $request->reg_identistas);
        Session::flash('reg_tgl_lahir', $request->reg_tgl_lahir);
        Session::flash('reg_hp1', $request->reg_hp1);
        Session::flash('reg_hp2', $request->reg_hp2);
        Session::flash('reg_email', $request->reg_email);
        Session::flash('reg_subseles', $request->reg_subseles);
        Session::flash('reg_alamat_pasang', $request->reg_alamat_pasang);
        Session::flash('reg_alamat_tagih', $request->reg_alamat_tagih);
        Session::flash('reg_paket', $request->reg_paket);
        Session::flash('reg_catatan', $request->reg_catatan);
        Session::flash('reg_wilayah', $request->reg_wilayah);



        $request->validate([
            'reg_idpel' => 'unique:pelanggans,reg_idpel',
            'reg_nama' => 'required',
            'reg_identistas' => 'unique:pelanggans,reg_identistas',
            'reg_tgl_lahir' => 'required',
            'reg_hp1' => 'unique:pelanggans,reg_hp1',
            'reg_hp2' => 'unique:pelanggans,reg_hp2',
            'reg_subseles' => 'required',
            'reg_alamat_pasang' => 'required',
            'reg_alamat_tagih' => 'required',
            'reg_paket' => 'required',
            'reg_wilayah' => 'required',


        ], [
            'reg_idpel.unique' => 'Refres terlebih dahulu',
            'reg_nama.required' => 'Nama tidak boleh kosong',
            'reg_identistas.unique' => 'No Identitas sudah ada, Ulangi Kembali',
            'reg_tgl_lahir.required' => 'Tanggal Lahir tidak boleh kosong',
            'reg_hp1.unique' => 'No HP utama sudah terdaftar',
            'reg_hp2.unique' => 'No HP alternatif sudah terdaftar',
            'reg_subseles.required' => 'Sub Sales tidak boleh kosong',
            'reg_alamat_pasang.required' => 'Alamat Pemasangan tidak boleh kosong',
            'reg_alamat_tagih.required' => 'Alamat Penagihan tidak boleh kosong',
            'reg_paket.required' => 'Paket Internet tidak boleh kosong',
            'reg_wilayah.required' => 'Wilayah tidak boleh kosong',
        ]);


        $data['reg_idpel'] = $data['idpel'];
        $data['reg_nama'] = $request->reg_nama;
        $data['reg_identistas'] = $request->reg_identistas;
        $data['reg_tgl_lahir'] = $request->reg_tgl_lahir;
        $data['reg_hp1'] = $request->reg_hp1;
        $data['reg_hp2'] = $request->reg_hp2;
        $data['reg_email'] = $request->reg_email;
        $data['reg_sales'] = $admin_id;
        $data['reg_subseles'] = $request->reg_subseles;
        $data['reg_alamat_pasang'] = $request->reg_alamat_pasang;
        $data['reg_alamat_tagih'] = $request->reg_subseles;
        $data['reg_paket'] = $request->reg_paket;
        $data['reg_catatan'] = $request->reg_catatan;
        $data['reg_wilayah'] = $request->reg_wilayah;
        $data['reg_status'] = '0';

        // dd($data);
        RegistrasiPelanggan::create($data);
        $profile = Paket::whereId($request->reg_paket)->first();

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
        $pesan_group['pesan'] = '               -- LIST PEMASANGAN --

Antrian pemasangan tanggal ' . date('d-m-Y', strtotime($request->reg_tgl_pasang)) . ' 

No Pelanggan : *' . $request->reg_idpel . '*
Nama : ' . $request->reg_nama . '
Alamat : ' . $request->reg_alamat_pasang .
            '
Paket : *' . $profile->paket_nama . '*
Iuran /bulan : ' . number_format($request->reg_harga) . '
Biaya Kabel : ' . number_format($request->addons) . '

Diregistrasi Oleh : *' . $admin . '*
';
        // dd($pesan_group);

        Pesan::create($pesan_group);
        $notifikasi = array(
            'pesan' => 'Berhasil menambahkan pelanggan',
            'alert' => 'success',
        );
        return redirect()->route('admin.sales.index')->with($notifikasi);
    }
}
