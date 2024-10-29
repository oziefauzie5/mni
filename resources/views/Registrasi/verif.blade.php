@extends('layout.main')
@section('content')

<style>
  hr{
    border: none;
  height: 1px;
  /* Set the hr color */
  color: #161616;  /* old IE */
  background-color: #959292;  /* Modern Browsers */
  }
  span{
    font-size: 11px;
    color:rgb(255, 0, 0);
  }
  ul{
    font-size: 12px;
    color:rgb(255, 0, 0);
  }
</style>

<div class="content">
    <div class="col-md-12 mt-3">
      <div class="card">
        <div class="card-body">
          @if ($errors->any())
          <div class="alert alert-danger">
            <div class="alert-title"><h4>Gagal!!</h4></div>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
          </div> 
          @endif
           <form class="form-horizontal"action="{{route('admin.pel.store')}}" method="POST">
             @csrf

             <h3 class="mt-3 text-bolt">FORM REGISTRASI LAYANAN INTERNET</h3><hr>
             
              <div class="form-group row">
                  <label class="col-sm-2 col-form-label" >ID Pelanggan</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="reg_idpel" value="{{ $data_reg->reg_idpel }}" name="reg_idpel" readonly >
                    <span>Notes : 2 Digit pertama Tahun registrasi, 2 Digit berikutnya Bulan Registrasi 4 Digit berikutnya No Urut</span>
                  </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Pelanggan</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="reg_nama" value="{{ $data_reg->reg_nama }}" name="reg_nama" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label" >No Identitas</label>
              <div class="col-sm-4">
                <input class="form-control" value="{{ $data_reg->reg_identistas }}" name="reg_identistas" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "16" >
              </div>
                <label class=" col-sm-2 col-form-label">Tgl Lahir</label>
              <div class="col-sm-4">
                <input type="text" name="reg_tgl_lahir"  class="form-control datepicker" value="{{ $data_reg->reg_tgl_lahir }}">
              </div>
            </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label" >No HP Utama</label>
              <div class="col-sm-4">
                <input type="number" class="form-control" value="{{ $data_reg->reg_hp1 }}" name="reg_hp1" >
              </div>
                <label class=" col-sm-2 col-form-label">No HP Alternatif</label>
              <div class="col-sm-4">
                <input type="number" name="reg_hp2" class="form-control" value="{{ $data_reg->reg_hp2 }}">
              </div>
            </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label" >Email</label>
              <div class="col-sm-4">
                <input type="email" class="form-control" id="" value="{{ $data_reg->reg_email }}" name="reg_email">
              </div>
                <label class="col-sm-2 col-form-label" >Wilayah</label>
              <div class="col-sm-4">
                <select class="form-control" name="reg_wilayah" id="">
                  <option value="">{{ $data_reg->reg_wilayah }}</option>
                 </select> 
              </div>
            </div>
            @role('admin|Noc')
              <div class="form-group row">
                <label class=" col-sm-2 col-form-label">Sales</label>
              <div class="col-sm-4">
                <select class="form-control" name="reg_sales" id="">
                  <option value="">{{ $data_reg->reg_nama }}</option>
                 </select>              
              </div>
              <label class="col-sm-2 col-form-label" >Sub Seles</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="" value="{{ Session::get('reg_subseles') }}" name="reg_subseles">
              </div>
            </div>
            @endrole
              <div class="form-group row">
                  <label for="alamat_pasang" class="col-sm-2 col-form-label">Alamat Pemasangan</label>
                  <div class="col-sm-10">
                    <textarea  name="reg_alamat_pasang" class="form-control" rows="3">{{ $data_reg->reg_alamat_pasang }}</textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="alamat_pasang" class="col-sm-2 col-form-label">Alamat Penagihan</label>
                  <div class="col-sm-10">
                    <textarea  name="reg_alamat_tagih" class="form-control" rows="3">{{ $data_reg->reg_alamat_tagih }}</textarea>
                  </div>
              </div>

              <h3 class="mt-3">BILLING</h3><hr>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label" >Tanggal Pemasangan*</label>
                <div class="col-sm-4">
                <input type="text" class="form-control datepicker"  name="reg_tgl_pasang" value="{{Session::get('reg_tgl_pasang')}}">
                </div>
                <label for="paket" class="col-sm-2 col-form-label">Paket Internet *</label>
                <div class="col-sm-4">
                  <select class="form-control" id="paket" name="reg_paket" >
                    <option value="">Pilih</option>
                    @foreach($data_paket as $p)
                    <option value="{{$p->id}}">{{$p->paket_nama}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Harga prorata</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" id="harga" name="reg_harga" value="{{Session::get('reg_harga')}}" readonly >
                </div>
                <label class="col-sm-2 col-form-label">Biaya Kabel</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" id="addons" name="addons" value="0" readonly>
                </div>
              </div>


@role('admin|Noc')
              <h3 class="mt-3 text-bolt">INTERNET & HADHWARE</h3><hr>
           
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Username internet *</label>
              <div class="col-sm-4">
                <input type="text" id="reg_username" name="reg_username" class="form-control hotspot" value="{{ Session::get('reg_username') }}" >
              </div>
                <label class=" col-sm-2 col-form-label" >Passwd internet *</label>
              <div class="col-sm-4">
                <input type="text" class="form-control pwhotspot" name="reg_password" value="1234567"  >
              </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Merek & Tipe Perangkat</label>
                <div class="col-sm-4">
                  <input type="text" name="reg_mrek" id="reg_mrek" class="form-control ont" value="{{ Session::get('reg_mrek') }}" >
                </div>
                <label class=" col-sm-2 col-form-label" >SN Perangkat</label>
              <div class="col-sm-4">
                <input type="text" name="reg_sn" id="reg_sn" class="form-control ont" value="{{ Session::get('reg_sn') }}" >
              </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kebutuhan Kabel /Meter</label>
                <div class="col-sm-4">
                  <input type="number" name="reg_kabel" id="reg_kabel" class="form-control ont" value="0"  >
                  <span id="text">Gratis kabel 100 Meter</span>
                </div>
                <label class=" col-sm-2 col-form-label" >Biaya kabel/meter</label>
              <div class="col-sm-4">
                <input type="text" name="" id="biaya_kabel" class="form-control ont" value="1000" >
              </div>
             
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kelengkapan Lainnya</label>
                <div class="col-sm-10">
                  <textarea name="reg_kelengkapan" class="form-control ont" cols="7" rows="7">{{ Session::get('reg_kelengkapan') }}</textarea>
                </div>
              </div>

@endrole
              
            
            <h3 class="mt-3 text-bolt">CATATAN</h3><hr>
            <div class="form-group row">
              <label for="router" class="col-sm-2 col-form-label">Catatan</label>
              <div class="col-sm-10">
              <textarea class="form-control is-invalid" id="validationTextarea" name="reg_catatan">{{Session::get('reg_catatan')}}
              </textarea>
              </div>
          </div>
            
         <div class="card-footer">
           <button type="button" class="btn  ">Batal</button>
           <button type="submit" class="btn btn-primary float-right">Simpan</button>
         </div>
       </form>
      </div>
    </div>
  </div>

@endsection
