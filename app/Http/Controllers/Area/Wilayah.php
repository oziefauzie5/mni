<?php

namespace App\Http\Controllers\Area;

use App\Http\Controllers\Controller;
use App\Models\Area\Wilayah as AreaWilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Wilayah extends Controller
{
    public function index()
    {
        $data['data_wilayah'] = AreaWilayah::all();
        return view('Area/index', $data);
    }


    public function store(Request $request)
    {
        Session::flash('wil_id', $request->paket_harga);
        Session::flash('wil_desa', $request->paket_harga);
        Session::flash('wil_kecamatan', $request->paket_harga);
        Session::flash('wil_kota', $request->paket_harga);
        $request->validate([
            'wil_desa' => 'unique:wilayahs',
        ], [
            'wil_desa.unique' => 'Desa sudah terdaftar',
        ]);
        $data['wil_id'] = $request->wil_id;
        $data['wil_desa'] = $request->wil_desa;
        $data['wil_kecamatan'] = $request->wil_kecamatan;
        $data['wil_kota'] = $request->wil_kota;
        $data['paket_status'] = 'Enable';
        AreaWilayah::create($data);

        $notifikasi = array(
            'pesan' => 'Berhasil menambhkan Wilayah',
            'alert' => 'success',
        );
        return redirect()->route('admin.wil.index')->with($notifikasi);
    }

    public function update(Request $request, $id)
    {


        $data['wil_id'] = $request->wil_id;
        $data['wil_desa'] = $request->wil_desa;
        $data['wil_kecamatan'] = $request->wil_kecamatan;
        $data['wil_kota'] = $request->wil_kota;

        // AreaWilayah::update($data);
        AreaWilayah::where('wil_id', $id)->update($data);

        $notifikasi = array(
            'pesan' => 'Berhasil Update Wilayah',
            'alert' => 'success',
        );
        return redirect()->route('admin.wil.index')->with($notifikasi);
    }
}
