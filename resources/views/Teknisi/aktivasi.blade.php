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
                    <h3 class="card-title">FORM AKTIVASI</h3>
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
           
              <form action="{{route('admin.teknisi.proses_aktivasi')}}" method="POST">
                @csrf
                @method('POST')
                <div class="row">

                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>ID Pelanggan </label>
                      <input type="text" id="reg_idpel" name="reg_idpel" class="form-control hotspot" value="{{$pel->reg_idpel}}" readonly >
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Nama Pelanggan </label>
                      <input type="text" id="reg_nama" name="reg_nama" class="form-control hotspot" value="{{$pel->reg_nama}}" readonly >
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Username internet * </label>
                      <input type="text" id="reg_username" name="reg_username" class="form-control hotspot" value="{{ Session::get('reg_mrek') }}" >
                    </div>
                  </div>
                  
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Passwd internet *</label>
                      <input type="text" class="form-control pwhotspot" name="reg_password" value="1234567"  >
                    </div>
                  </div>

                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Merek & Tipe Perangkat</label>
                      <input type="text" name="reg_mrek" id="reg_mrek" class="form-control ont" value="{{ Session::get('reg_mrek') }}" >
                    </div>
                  </div>

               

                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Serial Number Perangkat</label>
                      <input type="text" name="reg_sn" id="reg_sn" class="form-control ont" value="{{ Session::get('reg_sn') }}" >
                    </div>
                  </div>

                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Biaya Kabel /Meter</label>
                      <input type="number" name="addons" id="biaya_kabel" class="form-control ont" value="800"  >
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Kebutuhan Kabel /Meter</label>
                      <input type="number" name="reg_kabel" id="reg_kabel" class="form-control ont" value="0"  >
                      <span id="text">Free kabel 100 Meter</span>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Total</label>
                      <input type="number" name="total" id="total" class="form-control ont" value="0"  >
                    </div>
                  </div>

                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Kelengkapan Lainnya</label>
                      <textarea name="reg_kelengkapan" class="form-control ont" cols="7" rows="5">{{ Session::get('reg_kelengkapan') }}</textarea>
                    </div>
                </div>
                  
                 
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
                  <a href="{{route('admin.teknisi.index')}}"><button type="button" class="btn btn-primary">Kembali</button></a>
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