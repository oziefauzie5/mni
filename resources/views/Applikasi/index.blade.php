@extends('layout.main')
@section('content')
<style>
  .notice{
    font-size:11px;
    color:red;
    font-weight: bold;
  }
</style>
<div class="content">
  <div class="page-inner">
    <div class="row">
        {{-- <div class="col-md-7">
          <div class="card">

            <div class="card-body table-responsive -sm">
              @if ($errors->any())
                      <div class="alert alert-danger" role="alert">
                        <ul>
                          @foreach ($errors->all() as $item)
                              <li>{{ $item }}</li>
                          @endforeach
                        </ul>
                        </div>
              @endif
                <table class="table table-hover text-nowrap">
                
                    
                </table>
            </div>
          </div>
        </div> --}}
        <div class="col-md-8">
          <div class="card ">
            <div class="card-header">
              <ul class="nav nav-pills nav-primary" id="pills-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Tripay</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Aplikasi</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="pills-biaya-tab" data-toggle="pill" href="#pills-biaya" role="tab" aria-controls="pills-biaya" aria-selected="false">Biaya</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="pills-waktu-tab" data-toggle="pill" href="#pills-waktu" role="tab" aria-controls="pills-waktu" aria-selected="false">Jeda Waktu</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="pills-whatsapp-tab" data-toggle="pill" href="#pills-whatsapp" role="tab" aria-controls="pills-whatsapp" aria-selected="false">Whatsapp</a>
                </li>
              </ul>
            </div>
            {{-- AWAL --}}
            <div class="card-body">
              <div class="tab-pane fade show active" id="pills-app" role="tabpanel" aria-labelledby="pills-app-tab">
              </div>
              <div class="tab-content mt-2 mb-3" id="pills-tabContent">
                <div class="tab-pane fade show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                  <li>Fitur pelunasan otomatis dengan payment gateway Tripay</li>
                  <hr>
   
                
                  
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                  <form action="{{route('admin.app.aplikasi_store')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                <div class="form-group">
                  <label >Nama Perusahaan</label>
                  <input type="text" class="form-control" name="app_nama" value="{{$app_nama}}"  required>
                </div>
                <div class="form-group">
                  <label >Nama Brand</label>
                  <input type="text" class="form-control" name="app_brand" value="{{$app_brand}}"  required>
                </div>
                <div class="form-group">
                  <label >Alamat</label>
                  <input type="text" class="form-control"  name="app_alamat" id="" value="{{$app_alamat}}"   required>
                </div>
                <div class="form-group">
                  <label >Frefix Id Client</label>
                  <input type="text" class="form-control"  name="app_clientid" id="" value="">
                </div>
                <div class="form-group">
                  <label >Link Admin</label>
                  <input type="text" class="form-control"  name="app_link_admin" id="" value="{{$app_link_admin}}">
                </div>
                <img src="{{ asset('storage/img/'.$app_link_admin) }}" width="100" alt="" title=""></img>
                <div class="form-group">
                  <label for="">Upload Logo</label>
                  <input type="file" class="form-control-file" id="" name="app_logo">
                </div>
                <div class="form-group">
                  <label for="">Upload Favicon</label>
                  <input type="file" class="form-control-file" id="" name="app_favicon">
                </div>

                <button type="submit" class="btn btn-block btn-primary">Simpan</button>
                    </form>
                </div>
                <div class="tab-pane fade" id="pills-biaya" role="tabpanel" aria-labelledby="pills-biaya-tab">
                  <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="form-group">
                  <label >Biaya Pasang</label>
                  <input type="text" class="form-control" name="biaya_pasang" value=""  required>
                </div>
                <div class="form-group">
                  <label >Biaya PSB</label>
                  <input type="text" class="form-control" name="biaya_psb" value=""  required>
                </div>
                <div class="form-group">
                  <label >PPN %</label>
                  <input type="text" class="form-control" name="biaya_ppn" value=""  required>
                </div>
                
                <button type="submit" class="btn btn-block btn-primary">Simpan</button>
                    </form>
                </div>
                <div class="tab-pane fade" id="pills-waktu" role="tabpanel" aria-labelledby="pills-waktu-tab">
                  <form action="{{route('admin.app.waktu_store')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                <div class="form-group">
                  <label >Isolir</label>
                  <input type="text" class="form-control" name="wt_jeda_isolir_hari" value=""  required>
                  <span class="notice">Jeda waktu isolir setelah jatuh tempo </span>
                </div>
                <div class="form-group">
                  <label >Tagihan</label>
                  <input type="text" class="form-control" name="wt_jeda_tagihan_pertama" value=""  required>
                  <span class="notice">Jeda Waktu isolir tagihan pertama </span>
                </div>
            
                
                <button type="submit" class="btn btn-block btn-primary">Simpan</button>
                    </form>
                </div>
                <div class="tab-pane fade" id="pills-whatsapp" role="tabpanel" aria-labelledby="pills-whatsapp-tab">
                  <form action="{{route('admin.app.biaya_store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
              <div class="form-group">
                <label >Whatsapp Nama</label>
                <input type="text" class="form-control" name="wa_nama" value="{{$wa_nama}}"  required>
              </div>
              <div class="form-group">
                <label >Whatsapp Api</label>
                <input type="text" class="form-control" name="wa_key" value="{{$wa_key}}"  required>
              </div>
              <div class="form-group">
                <label >Whatsapp URL</label>
                <input type="text" class="form-control" name="wa_url" value="{{$wa_url}}"  required>
              </div>
              <div class="form-group">
                <label >Group ID Teknisi</label>
                <input type="text" class="form-control" name="wa_groupid" value="{{$wa_groupid}}"  required>
              </div>
              <div class="form-group">
                <label >Group ID Registrasi</label>
                <input type="text" class="form-control" name="wa_group_regist" value="{{$wa_group_regist}}"  required>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input class="form-check-input whatsapp" type="checkbox" name="wa_status" value="{{$wa_status}}" @if( $wa_status) checked @endif>
                  <span class="form-check-sign" id="wa" >@if($wa_status=='Enable') Enable @else Disable @endif</span>
                </label>
              </div>
              <button type="submit" class="btn btn-block btn-primary">Simpan</button>
                  </form>   
            </div>
          </div>
            {{-- AKHIR --}}
        </div>
    </div>
  </div>
</div>

@endsection

{{-- @extends('layout.main')
@section('content')
<style>
  .notice{
    font-size:11px;
    color:red;
    font-weight: bold;
  }
</style>
<div class="content">
  <div class="page-inner">
    <div class="row">
        <div class="col-md-6">
          <div class="card ">
              <div class="card-body">
                 <form action="{{route('admin.app.aplikasi_store')}}" method="POST" enctype="multipart/form-data">
                      @csrf
                  <div class="form-group">
                    <label >Nama Perusahaan</label>
                    <input type="text" class="form-control" name="app_nama" value="{{$app_nama}}"  required>
                  </div>
                  <div class="form-group">
                    <label >Nama Brand</label>
                    <input type="text" class="form-control" name="app_brand" value="{{$app_brand}}"  required>
                  </div>
                  <div class="form-group">
                    <label >Alamat</label>
                    <input type="text" class="form-control"  name="app_alamat" id="" value="{{$app_alamat}}"   required>
                  </div>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">Upload Logo</span>
                      </div>
                      <div class="custom-file">
                        <input type="file" name="app_logo" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">Pilih file</label>
                      </div>
                    </div>
  
                    <img src="{{ asset('storage/logo/'.$app_favicon) }}" class="img-fluid" alt="{{'a'.$app_favicon}}">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">Upload Favicon</span>
                      </div>
                      <div class="custom-file">
                        <input type="file" name="app_favicon" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">Pilih file</label>
                      </div>
                    </div>
                  <button type="submit" class="btn btn-block btn-primary">Simpan</button>
                      </form>
          </div>
        </div>
    </div>

    <div class="col-md-6">
      <div class="card ">
          <div class="card-body">
                <form action="{{route('admin.app.whatsapp_store')}}" method="POST" enctype="multipart/form-data">
                  @csrf
              <div class="form-group">
                <label >Whatsapp Nama</label>
                <input type="text" class="form-control" name="wa_nama" value="{{$wa_nama}}"  required>
              </div>
              <div class="form-group">
                <label >Whatsapp Api</label>
                <input type="text" class="form-control" name="wa_key" value="{{$wa_key}}"  required>
              </div>
              <div class="form-group">
                <label >Whatsapp URL</label>
                <input type="text" class="form-control" name="wa_url" value="{{$wa_url}}"  required>
              </div>
              <div class="form-group">
                <label >Group ID Teknisi</label>
                <input type="text" class="form-control" name="wa_groupid" value="{{$wa_groupid}}"  required>
              </div>
              <div class="form-group">
                <label >Group ID Registrasi</label>
                <input type="text" class="form-control" name="wa_group_regist" value="{{$wa_group_regist}}"  required>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input class="form-check-input whatsapp" type="checkbox" name="wa_status" value="{{$wa_status}}" @if( $wa_status) checked @endif>
                  <span class="form-check-sign" id="wa" >@if($wa_status=='Enable') Enable @else Disable @endif</span>
                </label>
              </div>
              <button type="submit" class="btn btn-block btn-primary">Simpan</button>
                  </form>                 
      </div>
    </div>
</div>
    </div>
  </div>
</div>

@endsection --}}