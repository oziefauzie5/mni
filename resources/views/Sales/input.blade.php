@extends('layout.user')
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
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">

                
            </div>
        </div>
    </div>
    <div class="page-inner mt--5">
      <div class="user mt--5">
        <div class="avatar-sm float-left mr-2">
          <img src="@if(Auth::user()->photo) {{ asset('storage/photo-user/'.Auth::user()->photo) }} @else {{ asset('atlantis/assets/img/user.png') }}@endif" alt=".." class="avatar-img rounded-circle"> 
        </div>
        <div class="info">
          <span> 
              <span class="user-level text-light font-weight-bold">{{strtoupper(Auth::user()->name)}}</span><br>
              <h6 class="user-level text-light ">{{$role}}</h6>
          <div class="clearfix"></div>
        </span>
        </div>

            <div class="row mt-1">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header text-center">
                    <h3 class="card-title">FORM REGISTRASI LAYANAN INTERNET</h3>
                  </div>
                  @if ($errors->any())
                  <div class="alert alert-danger" role="alert">
                     <ul>
                      @foreach ($errors->all() as $item)
                          <li>{{ $item }}</li>
                      @endforeach
                     </ul>
                    </div>
                  @endif


                    <div class="card-body ">
           
              <form action="{{route('admin.sales.store')}}" method="POST">
                @csrf
                @method('POST')
                <div class="row">

                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Nama Pelanggan</label>
                      <input type="text" class="form-control" id="reg_nama" value="{{ Session::get('reg_nama') }}" name="reg_nama">
                    </div>
                  </div>
                  
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>No Identitas</label>
                      <input class="form-control" value="{{ Session::get('reg_identistas') }}" name="reg_identistas" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "16" >
                    </div>
                  </div>

                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Tanggal Lahir</label>
                      <input type="text" name="reg_tgl_lahir"  class="form-control datepicker" value="{{ Session::get('reg_tgl_lahir') }}">
                    </div>
                  </div>

               

                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>No Hp Utama</label>
                      <input type="number" class="form-control" value="{{ Session::get('reg_hp1') }}" name="reg_hp1" >
                    </div>
                  </div>

                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>No Hp Alternatif</label>
                      <input type="number" name="reg_hp2" class="form-control" value="{{ Session::get('reg_hp2') }}">
                    </div>
                  </div>

                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" class="form-control" id="" value="{{ Session::get('reg_email') }}" name="reg_email">
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Wilayah</label>
                      <select class="form-control" name="reg_wilayah" id="">
                        <option value="">PILIH WILAYAH</option>
                        @foreach ($data_wilayah as $w)
                        <option value="{{$w->wil_id}}">{{$w->wil_desa}}</option>
                        @endforeach
                       </select> 
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Paket</label>
                      <select class="form-control" name="reg_paket" id="paket">
                        <option value="">PILIH PAKET</option>
                        @foreach ($data_paket as $w)
                        <option value="{{$w->id}}">{{$w->paket_nama}}</option>
                        @endforeach
                       </select> 
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Harga</label>
                      <input type="text" class="form-control" id="paket_harga" value="{{ Session::get('paket_harga') }}" name="paket_harga" readonly>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Sub Sales</label>
                      <input type="text" class="form-control" id="" value="{{ Session::get('reg_subseles') }}" name="reg_subseles">
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Alamat Pemasangan</label>
                      <textarea  name="reg_alamat_pasang" class="form-control" rows="3">{{ Session::get('reg_alamat_pasang') }}</textarea>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Alamat Penagihana</label>
                      <textarea  name="reg_alamat_tagih" class="form-control" rows="3">{{ Session::get('reg_alamat_tagih') }}</textarea>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Catatan</label>
                      <textarea  name="reg_catatan" class="form-control" rows="3">{{ Session::get('reg_catatan') }}</textarea>
                    </div>
                  </div>
                  
                 
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
                  <a href="{{route('admin.sales.index')}}"><button type="button" class="btn btn-primary">Kembali</button></a>
                  </div>
                </div>
              </div>
              </div>
              </div>
              </div>
            </div>
            {{-- </div>
 
    </section> --}}




            
    </div>
  </div>
@endsection