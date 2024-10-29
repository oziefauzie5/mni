<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Applikasi\SettingAplikasi;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login_proses(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $data = [
            'username' => $request->username,
            'password' => $request->password,
        ];
        if (Auth::guard('web')->attempt($data)) {
            $idi = Auth::guard('web')->user()->id;
            $app = SettingAplikasi::first();

            if ($app) {
                $request->session()->put('app_brand', $app->app_brand);
                $request->session()->put('app_nama', $app->app_nama);
                $request->session()->put('app_logo', $app->app_logo);
                $request->session()->put('app_favicon', $app->app_favicon);
                $request->session()->put('app_alamat', $app->app_alamat);
            } else {
                $request->session()->put('app_brand', 'APPBILL');
                $request->session()->put('app_nama', 'APPBILL');
                $request->session()->put('app_logo', 'APPBILL');
                $request->session()->put('app_favicon', 'APPBILL');
                $request->session()->put('app_alamat', 'Jl. Raya Bogor');
            }





            $datas =  DB::table('users')
                ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
                ->where('users.id', $idi)
                ->first();

            return redirect()->route('admin.home');
        }
    }

    public function logout()
    {
        session()->forget('app_brand');
        session()->forget('app_nama');
        session()->forget('app_alamat');
        session()->forget('app_logo');
        session()->forget('app_favicon');
        Auth::logout();
        return redirect()->route('/')->with('success', 'Kamu berhasil logout');
    }
}
