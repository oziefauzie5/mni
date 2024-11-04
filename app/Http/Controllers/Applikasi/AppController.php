<?php

namespace App\Http\Controllers\Applikasi;

use App\Http\Controllers\Controller;
use App\Models\Applikasi\SettingAplikasi;
use App\Models\Applikasi\SettingWhatsapp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AppController extends Controller
{
    public function index()
    {

        $SettingAplikasi = SettingAplikasi::first();

        if (isset($SettingAplikasi) == NULL) {
            $data['app_nama'] = " ";
            $data['app_brand'] = " ";
            $data['app_alamat'] = " ";
            $data['app_logo'] = "";
            $data['app_favicon'] = "";
        } else {
            $data['app_nama'] = $SettingAplikasi->app_nama;
            $data['app_brand'] = $SettingAplikasi->app_brand;
            $data['app_alamat'] = $SettingAplikasi->app_alamat;
            $data['app_logo'] = $SettingAplikasi->app_logo;
            $data['app_favicon'] = $SettingAplikasi->app_favicon;
        }

        $SettingWhatsapp = SettingWhatsapp::first();
        if (isset($SettingWhatsapp) == NULL) {
            $data['wa_nama'] = " ";
            $data['wa_key'] = " ";
            $data['wa_url'] = " ";
            $data['wa_groupid'] = " ";
            $data['wa_group_regist'] = " ";
            $data['wa_status'] = "";
        } else {
            $data['wa_nama'] = $SettingWhatsapp->wa_nama;
            $data['wa_key'] = $SettingWhatsapp->wa_key;
            $data['wa_url'] = $SettingWhatsapp->wa_url;
            $data['wa_groupid'] = $SettingWhatsapp->wa_groupid;
            $data['wa_group_regist'] = $SettingWhatsapp->wa_group_regist;
            $data['wa_status'] = $SettingWhatsapp->wa_status;
        }

        return view('Applikasi/index', $data);
    }


    // ===============================================END TRIPAY=================================================

    public function aplikasi_store(Request $request)
    {

        $request->validate([
            'app_logo' => 'mimes:png|max:1028',
            'app_favicon' => 'mimes:png|max:1028',
        ], [
            'app_logo.mimes' => 'Upload dengan format png',
            'app_logo.max' => 'File terlalu besar. Max upload 1Mb',
            'app_favicon.mimes' => 'Upload dengan format png',
            'app_favicon.max' => 'File terlalu besar. Max upload 1Mb',

        ]);

        if ($request->file('app_logo')) {

            $photo = $request->file('app_logo');
            $filename1 = $photo->getClientOriginalName();
            $path = 'img/' . $filename1;
            Storage::disk('public')->put($path, file_get_contents($photo));
        } else {
            $filename1 = '';
        }
        if ($request->file('app_favicon')) {
            $app_favicon = $request->file('app_favicon');
            $filename2 = $app_favicon->getClientOriginalName();
            $path = 'img/' . $filename2;
            Storage::disk('public')->put($path, file_get_contents($app_favicon));
        } else {
            $filename2 = '';
        }

        // dd($filename2);.
        $cek = SettingAplikasi::count();
        if ($cek == 0) {

            SettingAplikasi::create(
                [
                    'id' => '1',
                    'app_nama' => $request->app_nama,
                    'app_brand' => $request->app_brand,
                    'app_alamat' => $request->app_alamat,
                    'app_logo' => $filename1,
                    'app_favicon' => $filename2,
                ]
            );
        } else {
            SettingAplikasi::whereId('1')->update(
                [
                    'app_nama' => $request->app_nama,
                    'app_brand' => $request->app_brand,
                    'app_alamat' => $request->app_alamat,
                    'app_logo' => $filename1,
                    'app_favicon' => $filename2,
                ]
            );
        }
        $notifikasi = array(
            'pesan' => 'Menambah pengaturan Berhasil',
            'alert' => 'success',
        );
        return redirect()->route('admin.app.index')->with($notifikasi);
    }


    // ==============================================END APLIKASI==============================================



    public function whatsapp_store(Request $request)
    {
        // dd($request->wa_status);
        $cek = SettingWhatsapp::count();
        if ($cek == 0) {
            SettingWhatsapp::create(
                [
                    'id' => '1',
                    'wa_nama' => $request->wa_nama,
                    'wa_key' => $request->wa_key,
                    'wa_url' => $request->wa_url,
                    'wa_groupid' => $request->wa_groupid,
                    'wa_group_regist' => $request->wa_group_regist,
                    'wa_status' => 'Enable',
                ]
            );
        } else {
            SettingWhatsapp::whereId('1')->update(
                [
                    'wa_nama' => $request->wa_nama,
                    'wa_key' => $request->wa_key,
                    'wa_url' => $request->wa_url,
                    'wa_groupid' => $request->wa_groupid,
                    'wa_group_regist' => $request->wa_group_regist,
                    'wa_status' => $request->wa_status,
                ]
            );
        }
        $notifikasi = array(
            'pesan' => 'Menambah Akun Berhasil',
            'alert' => 'success',
        );
        return redirect()->route('admin.app.index')->with($notifikasi);
    }
}
