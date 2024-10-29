<?php

namespace App\Http\Controllers\Paket;

use App\Http\Controllers\Controller;
use App\Models\Applikasi\SettingBiaya;
use App\Models\Paket\Paket as PaketPaket;
use App\Models\Registrasi\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Paket extends Controller
{
    public function paket()
    {
        $data['tittle'] = 'PAKET INTERNET';
        $data['data_paket'] = PaketPaket::all();
        return view('paket/index', $data);
    }


    public function store(Request $request)
    {
        Session::flash('paket_nama', $request->paket_nama);
        Session::flash('paket_harga', $request->paket_harga);
        $request->validate([
            'paket_nama' => 'unique:pakets',
        ], [
            'paket_nama.unique' => 'Nama Paket tidak boleh sama',
        ]);
        $data['paket_nama'] = $request->paket_nama;
        $data['paket_harga'] = $request->paket_harga;
        $data['paket_status'] = 'Enable';
        PaketPaket::create($data);

        $notifikasi = array(
            'pesan' => 'Berhasil menambhkan paket',
            'alert' => 'success',
        );
        return redirect()->route('admin.app.paket')->with($notifikasi);
    }

    public function update(Request $request, $id)
    {


        $sbiaya = SettingBiaya::first();
        $data['paket_nama'] = $request->paket_nama;
        $data['paket_harga'] = $request->paket_harga;
        $data['paket_status'] = 'Enable';

        $update['reg_harga'] = $request->paket_harga;
        Pelanggan::where('reg_paket', $id)->update($update);
        PaketPaket::whereId($id)->update($data);

        $notifikasi = array(
            'pesan' => 'Berhasil merubah paket',
            'alert' => 'success',
        );
        return redirect()->route('admin.app.paket')->with($notifikasi);
    }
}
