
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        #customers {
          font-family: Arial, Helvetica, sans-serif;
          /* border-collapse: collapse; */
          width: 100%;
        }
        #customers td, #customers th {
            /* border: 1px solid #5b5b5b; */
            padding: 3px;
            font-size: 9pt;
        }
        #box {
            border: 1px solid #5b5b5b;
            width:17%;
        }
        #kop {
          font-family: Arial, Helvetica, sans-serif;
          border-collapse: collapse;
          width: 100%;
          text-align: left;
          font-size: 10pt;
        }
        #ttd {
          font-family: Arial, Helvetica, sans-serif;
          border-collapse: collapse;
          width: 100%;
          
        }
        #ttd td, #ttd th {
          padding: 3px;
          font-size: 9pt;
          height: 80px;

        }
        #customers .rupiah{
            text-align: right;
        }
        #sk {
            font-size: 10pt;
            color:red;
        }

        #customers th {
          text-align: left;
          font-size: 10pt;

        }
        #invoice {
        float: right;
        text-align: right;
        }
        #client {
        float: left;
        }
        hr {
        margin-top: -10px;
        margin-bottom: 1px
        }

        </style>
</head>
<body>

    <table id="kop">
        <tr>
            <th width="60%"  style=" text-align: left;"><img src="{{ asset('storage/img/'.$profile_perusahaan->app_logo)}}" style="width: 40%;" alt=""></th>
            <td width="40%"><strong>{{$profile_perusahaan->app_nama}}</strong> <br><span>{{$profile_perusahaan->app_brand}}</span><br><span>{{$profile_perusahaan->app_alamat}}</span></td>
        </tr>
    </table>
    <br>
 <hr>
<center> <h3>FORMULIR PENDAFTARAN INTERNET</h3></center>
 <table>
    <tr>
        <th>DATA PELANGGAN - Costumer Data</th>
    </tr>
 </table>
    <table id="customers">
            <tr>
                <td width="25%">Id Pelanggan</td>
                <td>:</td>
                <td width="75%">{{$berita_acara->reg_idpel}}</td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>{{$berita_acara->reg_nama}}</td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td>:</td>
                <td>{{$berita_acara->reg_tgl_lahir}}</td>
            </tr>
            <tr>
                <td>Nomor untuk dihubungi</td>
                <td>:</td>
                <td>{{$berita_acara->reg_hp1 .' / '.$berita_acara->reg_hp2}}</td>
            </tr>
            <tr>
                <td>Paket Internet</td>
                <td>:</td>
                <td>{{$berita_acara->paket_nama}}</td>
            </tr>
            <tr>
                <td>Tagihan</td>
                <td>:</td>
                <td>Rp. {{number_format( $berita_acara->reg_harga)}}</td>
            </tr>
            <tr>
                <td>Sales</td>
                <td>:</td>
                <td>{{$berita_acara->name}}</td>
            </tr>
            <tr>
                <td>Sub Sales</td>
                <td>:</td>
                <td>{{$berita_acara->input_subseles}}</td>
            </tr>
            
            <tr>
                <td>Alamat Pemasangan</td>
                <td>:</td>
                <td>{{$berita_acara->reg_alamat_pasang}}</td>
            </tr>
            <tr>
                <td>Alamat Penagihan</td>
                <td>:</td>
                <td>{{$berita_acara->reg_alamat_tagih}}</td>
            </tr>

            <tr>
                <td width="15%">Tanggal Registrasi</td>
                <td>:</td>
                <td width="85%">{{ date('d-m-Y', strtotime( $berita_acara->created_at)) }}</td>
            </tr>
            <tr>
                <td>Tanggal Pemasangan</td>
                <td>:</td>
                @if($berita_acara->reg_tgl_pasang)
                <td>{{ date('d-m-Y', strtotime( $berita_acara->reg_tgl_pasang)) }}</td>
                @else
                <td></td>
                @endif
            </tr>
    </table>
    <br>
    <hr>
<table>
   
    <tr>
        <th>DATA PERANGKAT - Device Data</th>
    </tr>
</table>
    <table id="customers">
    <tr>
        <td width="23%">Merek & Tipe Perangkat</td>
        <td>:</td>
        <td></td>
        <td></td>
        <td width="23%">Nomor Seri Perangkat (SN)</td>
        <td>:</td>
        <td></td>
        <td></td>
        </tr>
        <tr>
        <td>Kebutuhan Kabel</td>
        <td>:</td>
        <td></td>
        <td></td>
        <td>Mac Address</td>
        <td>:</td>
        <td>{{$berita_acara->reg_mac}}</td>
        </tr>
    </table>
    <br>
    <hr>
    <span>Syarat dan Ketentuan berlaku</span>
    <ul id="sk">KEWAJIBAN PELANGGAN
        <li>Membayar biaya pemasangan sambungan layanan (Pasang Baru).</li>
        <li>Memberi Izin melakukan proses installasi, pemeliharaan, dan perbaikan kendala jaringan di alamat PELANGGAN.</li>
        <li>Membayar tagihan biaya jaringan/jasa layanan tepat pada waktunya.</li>
    </ul>
    <ul id="sk">TANGGUNG JAWAB PELANGGAN
      <li>PELANGGAN bertanggung jawab sepenuhnya atas penggunaan layanan IDT oleh siapapun di alamat pelanggan, termasuk penggunaan oleh keluarga, pegawai, atau pihak ke tiga lainnya.</li>
      <li>PELANGGAN turut menjaga perangkat CPE milik IDT yang terinstallasi di alamat PELANGGAN guna kelangsungan layanan tetap berjalan dengan baik.</li>
    </ul>
    <ul id="sk"> LARANGAN BAGI PELANGGAN
    <li>PELANGGAN di larang melakukan pemindahan atau perubahan apapun terhadap perangkat layanan.</li>
    <li>PELANGGAN dilarang melakukan penjualan kembali layanan internet dalam bentuk apapun tanpa seizin {{$profile_perusahaan->app_brand}}</li>
    <li>PELANGGAN dilarang menggunakan layanan IDT yang dapat merugikan pihak lain.</li>
</ul>
    <ul id="sk"> PENGAKHIRAN KONTRAK LANGGANAN
    <li>PELANGGAN Memberitahukan kepada IDT apabila bermaksud berhenti berlangganan layanan untuk sementara atau memutuskan kontrak berlangganan.</li>
    <li>IDT secara sepihak dapat mengakhiri kontrak berlangganan karena PELANGGAN melanggar ketentuan kontrak berlangganan atau karena IDT tidak mampu lagi menyediakan layanan.</li>
    <li>PELANGGAN dapat mengakhiri kontrak berlangganan secara sepihak dengan memberitahukan kepada IDT terlebih dahulu selambat-lambatnya 14 (empat belas) hari kerja, dengan ketentuan
    aspelanggan tetap harus melunasi pembayaran tunggakannya.</li>
</ul>
    <ul id="sk"> KETENTUAN LAIN
    <li>PELANGGAN melakukan Deposit Saldo diawal sesuai Paket yang di pilih.</li>
    <li>Minimal berlangganan adalah 3 bulan, dan tidak diperbolehkan melakukan downgrade pada masa minimum berlangganan.</li>
    <li>Apabila pelanggan memiliki tunggakan, maka saldo deposit tidak dapat diambil kembali dan dinyatakan hangus.</li>
    Dengan ini menyatakan bahwa semua keterangan yang diisi diatas adalah benar, serta menerima dan bersedia untuk terikat oleh seluruh KETENTUAN berlang</li>
</ul>
    <table id="ttd">
        <tr>
            <th width="25%" higth="20px">Admin</th>
            <th width="25%">Sales</th>
            <th width="25%">Teknisi</th>
            <th width="25%">Pelanggan</th>
        </tr>
        <tr>
            <th width="25%" higth="20px">{{ $nama_admin }}</th>
            <th width="25%">{{$berita_acara->input_subseles}}</th>
            <th width="25%">...................................</th>
            <th width="25%">{{$berita_acara->input_nama}}</th>
        </tr>
    </table>
    
</body>
</html>
