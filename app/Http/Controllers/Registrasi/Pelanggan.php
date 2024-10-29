<?php

namespace App\Http\Controllers\Registrasi;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Global\GlobalController;
use App\Models\Applikasi\SettingAplikasi;
use App\Models\Paket\Paket;
use App\Models\Pesan\Pesan;
use App\Models\Registrasi\Pelanggan as RegistrasiPelanggan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class Pelanggan extends Controller
{
    public function index(Request $request)
    {
        $data['paket'] = $request->query('paket');
        $data['data'] = $request->query('data');
        $data['q'] = $request->query('q');
        $query = RegistrasiPelanggan::orderBy('created_at', 'DESC')
            ->where(function ($query) use ($data) {
                $query->where('reg_nama', 'like', '%' . $data['q'] . '%');
                $query->orWhere('reg_idpel', 'like', '%' . $data['q'] . '%');
                $query->orWhere('reg_hp1', 'like', '%' . $data['q'] . '%');
                $query->orWhere('reg_hp2', 'like', '%' . $data['q'] . '%');
                $query->orWhere('reg_alamat_tagih', 'like', '%' . $data['q'] . '%');
            });

        if ($data['data'] == "Active")
            $query->where('reg_status', '=', $data['data']);
        elseif ($data['data'] == "Non Active")
            $query->where('reg_status', '=', $data['data']);

        $data['pelanggan'] = $query->paginate(10);
        $data['count_Active'] = $query->where('reg_status', 'Active')->count();
        $query2 = RegistrasiPelanggan::orderBy('created_at', 'DESC');

        if ($data['data'] == "Non Active")
            $query2->where('reg_status', '=', $data['data']);

        $data['count_NonActive'] = $query2->where('reg_status', 'Non Active')->count();
        $data['count_reg'] = RegistrasiPelanggan::count();

        $data['data_user'] = User::all();
        $data['data_paket'] = Paket::all();
        return view('Registrasi/list', $data);
    }
    public function registrasi()
    {
        $data['idpel'] = (new GlobalController)->idpel();
        $data['data_paket'] = Paket::all();
        $data['data_user'] = User::all();
        return view('Registrasi/registrasi', $data);
    }

    public function getPaket(Request $request, $id)
    {
        $data = Paket::whereId($id)->get();
        return response()->json($data);
    }

    public function status(Request $request, $id)
    {
        RegistrasiPelanggan::where('reg_idpel', $id)->update(['reg_status' => $request->reg_status]);
        $notifikasi = array(
            'pesan' => 'Update Status Berhasil',
            'alert' => 'success',
        );
        return redirect()->route('admin.pel.index')->with($notifikasi);
    }
    public function print(Request $request, $id)
    {
        // RegistrasiPelanggan::where('reg_idpel', $id)->update(['reg_status' => $request->reg_status]);
        // $notifikasi = array(
        //     'pesan' => 'Update Status Berhasil',
        //     'alert' => 'success',
        // );
        // return redirect()->route('admin.pel.index')->with($notifikasi);

        $data['profile_perusahaan'] = SettingAplikasi::first();
        $user = (new GlobalController)->user_admin();
        $data['nama_admin'] = $user['user_nama'];
        $data['berita_acara'] =  RegistrasiPelanggan::select('pelanggans.*', 'pakets.id', 'pakets.paket_nama', 'users.name', 'users.id')
            ->join('pakets', 'pakets.id', '=', 'pelanggans.reg_paket')
            ->join('users', 'users.id', '=', 'pelanggans.reg_sales')
            ->where('reg_idpel', $id)
            ->first();
        return view('Registrasi/print_berita_acara', $data);
        // dd($data);

        $pdf = App::make('dompdf.wrapper');
        $html = view('Registrasi/print_berita_acara', $data)->render();
        $pdf->loadHTML($html);
        $pdf->setPaper('legal', 'potraid');
        return $pdf->download('form-' . $data['berita_acara']->reg_nama . '.pdf');
    }
    public function store(Request $request)
    {
        $user = (new GlobalController)->user_admin();
        $admin = $user['user_nama'];


        Session::flash('reg_idpel', $request->reg_idpel);
        Session::flash('reg_nama', $request->reg_nama);
        Session::flash('reg_identistas', $request->reg_identistas);
        Session::flash('reg_tgl_lahir', $request->reg_tgl_lahir);
        Session::flash('reg_hp1', $request->reg_hp1);
        Session::flash('reg_hp2', $request->reg_hp2);
        Session::flash('reg_email', $request->reg_email);
        Session::flash('reg_sales', $request->reg_sales);
        Session::flash('reg_subseles', $request->reg_subseles);
        Session::flash('reg_alamat_pasang', $request->reg_alamat_pasang);
        Session::flash('reg_alamat_tagih', $request->reg_alamat_tagih);
        Session::flash('reg_username', $request->reg_username);
        Session::flash('reg_mrek', $request->reg_mrek);
        Session::flash('reg_kelengkapan', $request->reg_kelengkapan);
        Session::flash('reg_sn', $request->reg_sn);
        Session::flash('reg_kabel', $request->reg_kabel);
        Session::flash('reg_tgl_pasang', $request->reg_tgl_pasang);
        Session::flash('reg_paket', $request->reg_paket);
        Session::flash('reg_harga', $request->reg_harga);
        Session::flash('addons', $request->addons);
        Session::flash('reg_catatan', $request->reg_catatan);



        $request->validate([
            'reg_idpel' => 'unique:pelanggans,reg_idpel',
            'reg_nama' => 'required',
            'reg_identistas' => 'unique:pelanggans,reg_identistas',
            'reg_tgl_lahir' => 'required',
            'reg_hp1' => 'unique:pelanggans,reg_hp1',
            'reg_hp2' => 'unique:pelanggans,reg_hp2',
            'reg_sales' => 'required',
            'reg_subseles' => 'required',
            'reg_alamat_pasang' => 'required',
            'reg_alamat_tagih' => 'required',
            'reg_username' => 'required',
            'reg_mrek' => 'required',
            'reg_kelengkapan' => 'required',
            'reg_sn' => 'required',
            'reg_kabel' => 'required',
            'reg_tgl_pasang' => 'required',
            'reg_paket' => 'required',
            'reg_harga' => 'required',
            'addons' => 'required',


        ], [
            'reg_idpel.unique' => 'Refres terlebih dahulu',
            'reg_nama.required' => 'Nama tidak boleh kosong',
            'reg_identistas.unique' => 'No Identitas sudah ada, Ulangi Kembali',
            'reg_tgl_lahir.required' => 'Tanggal Lahir tidak boleh kosong',
            'reg_hp1.unique' => 'No HP utama sudah terdaftar',
            'reg_hp2.unique' => 'No HP alternatif sudah terdaftar',
            'reg_sales.required' => 'Sales tidak boleh kosong',
            'reg_subseles.required' => 'Sub Sales tidak boleh kosong',
            'reg_alamat_pasang.required' => 'Alamat Pemasangan tidak boleh kosong',
            'reg_alamat_tagih.required' => 'Alamat Penagihan tidak boleh kosong',
            'reg_username.required' => 'Username tidak boleh kosong',
            'reg_mrek.required' => 'Merek Perangkat tidak boleh kosong',
            'reg_kelengkapan.required' => 'Kelengkapan Lainnya tidak boleh kosong',
            'reg_sn.required' => 'Serial Number Perangkat tidak boleh kosong',
            'reg_kabel.required' => 'Penggunaan kabel tidak boleh kosong',
            'reg_tgl_pasang.required' => 'Tanggal Pemasangan tidak boleh kosong',
            'reg_paket.required' => 'Paket Internet tidak boleh kosong',
            'reg_harga.required' => 'Harga tidak boleh kosong',
            'addons.required' => 'Biaya Kabel tidak boleh kosong',
        ]);


        $data['reg_idpel'] = $request->reg_idpel;
        $data['reg_nama'] = $request->reg_nama;
        $data['reg_identistas'] = $request->reg_identistas;
        $data['reg_tgl_lahir'] = $request->reg_tgl_lahir;
        $data['reg_hp1'] = $request->reg_hp1;
        $data['reg_hp2'] = $request->reg_hp2;
        $data['reg_email'] = $request->reg_email;
        $data['reg_sales'] = $request->reg_sales;
        $data['reg_subseles'] = $request->reg_subseles;
        $data['reg_alamat_pasang'] = $request->reg_alamat_pasang;
        $data['reg_alamat_tagih'] = $request->reg_subseles;
        $data['reg_mrek'] = $request->reg_mrek;
        $data['reg_kelengkapan'] = $request->reg_kelengkapan;
        $data['reg_username'] = $request->reg_username;
        $data['reg_password'] = $request->reg_password;
        $data['reg_sn'] = $request->reg_sn;
        $data['reg_kabel'] = $request->reg_kabel;
        $data['reg_tgl_pasang'] = $request->reg_tgl_pasang;
        $data['reg_paket'] = $request->reg_paket;
        $data['reg_harga'] = $request->reg_harga;
        $data['reg_addons'] = $request->addons;
        $data['reg_catatan'] = $request->reg_catatan;
        $data['reg_status'] = 'Registrasi';

        // Pelanggan::create($data);
        RegistrasiPelanggan::create($data);
        // dd($data);


        $profile = Paket::whereId($request->reg_paket)->first();

        $status = (new GlobalController)->whatsapp_status();


        if ($status->wa_status == 'Enable') {
            $pesan_pelanggan['status'] = '0';
            $pesan_group['status'] = '0';
        } else {
            $pesan_pelanggan['status'] = '10';
            $pesan_group['status'] = '10';
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
        return redirect()->route('admin.pel.index')->with($notifikasi);
    }
}
