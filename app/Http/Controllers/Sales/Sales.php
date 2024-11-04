<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Global\GlobalController;
use App\Models\Global\ConvertNoHp;
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
        // $m = Carbon::now();
        $user = (new GlobalController)->user_admin();
        $user_id = $user['user_id'];
        $role = (new globalController)->data_user($user_id);
        $data['role'] = $role->name;
        $m = date('m', strtotime(new Carbon()));

        $query = Pelanggan::select('pakets.id', 'pakets.paket_nama', 'pelanggans.*')
            ->join('pakets', 'pakets.id', '=', 'pelanggans.reg_paket')
            ->where('reg_sales', '=', $user_id);

        $data['registrasi'] = $query->get();
        $data['penjualan'] = $query->whereMonth('pelanggans.created_at', '=', $m)->count();

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

        return view('Sales/input', $data);
    }

    public function getPaket(Request $request, $id)
    {
        $data = Paket::whereId($id)->get();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $idpel = (new GlobalController)->idpel();
        $user = (new GlobalController)->user_admin();
        $nomorhp1 = (new ConvertNoHp())->convert_nohp($request->reg_hp1);
        $nomorhp2 = (new ConvertNoHp())->convert_nohp($request->reg_hp2);
        $admin_id = $user['user_id'];
        $admin = $user['user_nama'];
        $tgl_lahir = date('Y-m-d', strtotime($request->reg_tgl_lahir));
        Session::flash('reg_nama', $request->reg_nama);
        Session::flash('reg_identistas', $request->reg_identistas);
        Session::flash('reg_tgl_lahir', $tgl_lahir);
        Session::flash('reg_hp1', $nomorhp1);
        Session::flash('reg_hp2', $nomorhp2);
        Session::flash('reg_email', $request->reg_email);
        Session::flash('reg_subseles', $request->reg_subseles);
        Session::flash('reg_alamat_pasang', $request->reg_alamat_pasang);
        Session::flash('reg_alamat_tagih', $request->reg_alamat_tagih);
        Session::flash('reg_paket', $request->reg_paket);
        Session::flash('paket_harga', $request->paket_harga);
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
            'paket_harga' => 'required',
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
            'paket_harga.required' => 'Harga Paket tidak boleh kosong',
            'reg_wilayah.required' => 'Wilayah tidak boleh kosong',
        ]);


        $data['reg_idpel'] = $idpel;
        $data['reg_nama'] = $request->reg_nama;
        $data['reg_identistas'] = $request->reg_identistas;
        $data['reg_tgl_lahir'] = $tgl_lahir;
        $data['reg_hp1'] = $nomorhp1;
        $data['reg_hp2'] = $nomorhp2;
        $data['reg_email'] = $request->reg_email;
        $data['reg_sales'] = $admin_id;
        $data['reg_subseles'] = $request->reg_subseles;
        $data['reg_alamat_pasang'] = $request->reg_alamat_pasang;
        $data['reg_alamat_tagih'] = $request->reg_alamat_tagih;
        $data['reg_paket'] = $request->reg_paket;
        $data['reg_harga'] = $request->paket_harga;
        $data['reg_catatan'] = $request->reg_catatan;
        $data['reg_wilayah'] = $request->reg_wilayah;
        $data['reg_status'] = '0';

        // dd($data);
        RegistrasiPelanggan::create($data);
        // dd($data);
        $paket = Paket::whereId($request->reg_paket)->first();

        $status = (new GlobalController)->whatsapp_status();
        // dd($status->wa_group_regist);

        if ($status) {
            if ($status->wa_status == 'Enable') {
                $pesan_pelanggan['status'] = '0';
                $pesan_group['status'] = '0';
            } else {
                $pesan_pelanggan['status'] = '10';
                $pesan_group['status'] = '10';
            }
        }

        $pesan_pelanggan['ket'] = 'registrasi';
        $pesan_pelanggan['target'] = $request->reg_hp1;
        $pesan_pelanggan['nama'] = $request->reg_nama;
        $pesan_pelanggan['pesan'] = 'Pelanggan Yth, 
Registrasi layanan internet berhasil, berikut data yang sudah terdaftar pada sistem kami :

Id.Pelanggan : *' . $idpel . '*
Nama : *' . $request->reg_nama . '*
Alamat pasang : ' . $request->reg_alamat_pasang . '
Paket : *' . $paket->paket_nama . '*
Iuran /bulan : Rp.  ' . number_format($request->paket_harga) . '

--------------------
Pesan ini bersifat informasi dan tidak perlu dibalas
*' . Session::get('app_brand') . '*
';
        Pesan::create($pesan_pelanggan);
        // dd($pesan_pelanggan);

        $pesan_group['ket'] = 'registrasi';
        $pesan_group['target'] = $status->wa_group_regist;
        $pesan_group['nama'] = $request->reg_nama;
        $pesan_group['pesan'] = '               -- REGISTRASI --

Id Pelanggan : *' . $idpel . '*
Nama : ' . $request->reg_nama . '
Alamat : ' . $request->reg_alamat_pasang .
            '
Paket : *' . $paket->paket_nama . '*
Iuran /bulan : Rp. ' . number_format($request->paket_harga) . '

Catatan : 
' . $request->reg_catatan . '

Sub Sales : *' . $request->reg_subseles . '*
Diregistrasi Oleh : *' . $admin . '*
';
        Pesan::create($pesan_group);


        // dd($pesan_group);

        $notifikasi = array(
            'pesan' => 'Berhasil menambahkan pelanggan',
            'alert' => 'success',
        );
        return redirect()->route('admin.sales.index')->with($notifikasi);
    }
}
