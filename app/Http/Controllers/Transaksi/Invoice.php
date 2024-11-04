<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Global\GlobalController;
use App\Models\Transaksi\Invoice as TransaksiInvoice;
use Illuminate\Http\Request;

class Invoice extends Controller
{
    public function unpaid(Request $request)
    {
        $tanggal = (new GlobalController)->tanggal();
        $pasang_bulan_ini = $tanggal->addMonth(-0)->format('Y-m-d');
        $pasang_bulan_lalu = $tanggal->addMonth(-1)->format('Y-m-d');
        $pasang_3_bulan_lalu = $tanggal->addMonth(-2)->format('Y-m-d');
        // dd($pasang_3_bulan_lalu);
        $month = $tanggal->format('m');
        $data['data_bulan'] = $request->query('data_bulan');
        $data['bulan'] = $request->query('bulan');
        // dd($data['bulan']);
        $data['data_inv'] = $request->query('data_inv');
        $data['q'] = $request->query('q');
        // dd($data['data_bulan']);

        $query = TransaksiInvoice::select('pelanggans.reg_idpel', 'pelanggans.reg_nama', 'invoices.*')
            ->join('pelanggans', 'pelanggans.reg_idpel', '=', 'invoices.inv_idpel')
            ->where('inv_status', '!=', 'PAID')
            ->orderBy('inv_id', 'ASC')
            // ->orderBy('inv_tgl_jatuh_tempo', 'DESC')
            ->where(function ($query) use ($data) {
                $query->where('invoices.inv_id', 'like', '%' . $data['q'] . '%');
                $query->orWhere('invoices.inv_idpel', 'like', '%' . $data['q'] . '%');
                $query->orWhere('pelanggans.reg_nama', 'like', '%' . $data['q'] . '%');
                $query->orWhere('invoices.inv_tgl_jatuh_tempo', 'like', '%' . $data['q'] . '%');
            });

        if ($data['bulan'])
            $query->whereMonth('inv_tgl_jatuh_tempo', date('m', strtotime($data['bulan'])))->whereYear('inv_tgl_jatuh_tempo', date('Y', strtotime($data['bulan'])));

        if ($data['data_inv'])
            $query->where('inv_status', '=', $data['data_inv']);


        $data['data_invoice'] = $query->paginate(20);
        $data['inv_count_belum_terbayar'] = TransaksiInvoice::where('inv_status', '!=', 'PAID')->count() + TransaksiInvoice::where('inv_status', '=', 'PAID')->whereMonth('inv_tgl_jatuh_tempo', '=', $month)->count();
        $data['inv_count_total'] = TransaksiInvoice::whereMonth('inv_tgl_jatuh_tempo', '=', $month)->count();
        $data['inv_count_unpaid'] = TransaksiInvoice::where('inv_status', '=', 'UNPAID')->count();
        $data['inv_count_lunas'] = TransaksiInvoice::where('inv_status', '=', 'PAID')->whereMonth('inv_tgl_jatuh_tempo', '=', $month)->count();
        $data['inv_belum_lunas'] = TransaksiInvoice::where('inv_status', '!=', 'PAID')->sum('inv_total');
        $data['inv_lunas'] = TransaksiInvoice::where('inv_status', '=', 'PAID')->whereMonth('inv_tgl_jatuh_tempo', '=', $month)->sum('inv_total');
        $data['inv_count_suspend'] = TransaksiInvoice::where('inv_status', '=', 'SUSPEND')->count();
        return view('Transaksi/unpaid', $data);
    }

    public function delete_inv($id)
    {
        dd($id);
    }
}
