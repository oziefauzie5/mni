<?php

namespace App\Http\Controllers\Whatsapp;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Global\GlobalController;
use App\Models\Pesan\Pesan;
use App\Models\Registrasi\Pelanggan;
use Illuminate\Http\Request;

class WhatsappController extends Controller
{
    public function index(Request $request)
    {
        $data['q'] = $request->query('q');
        $query = Pesan::orderBy('created_at', 'DESC')
            ->where(function ($query) use ($data) {
                $query->where('nama', 'like', '%' . $data['q'] . '%');
                $query->orWhere('target', 'like', '%' . $data['q'] . '%');
                $query->orWhere('pesan', 'like', '%' . $data['q'] . '%');
                $query->orWhere('status', 'like', '%' . $data['q'] . '%');
                $query->orWhere('ket', 'like', '%' . $data['q'] . '%');
            });

        $data['whatsapp'] = $query->paginate(15);
        return view('whatsapp/index', $data);
    }

    public function delete_pesan($id)
    {
        // dd($id);
        $pesan = Pesan::whereId($id)->first();
        if ($pesan) {
            $pesan->delete();
        }
        $notifikasi = [
            'pesan' => 'Berhasil Hapus Pesan',
            'alert' => 'success',
        ];
        return redirect()->route('admin.wa.index')->with($notifikasi);
    }
}
