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

@endsection