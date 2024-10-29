@extends('layout.main')
@section('content')

<div class="content">
  <div class="page-inner">
  </div>
    <div class="col-md-12">
      <div class="card">
        <button class="btn  btn-sm ml-auto m-1 btn-primary " data-toggle="modal" data-target="#addpaket">
          <i class="fa fa-plus"></i>
          TAMBAH WILAYAH</button><hr>
          
        <div class="modal fade" id="addpaket" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
              <div class="modal-header no-bd bg-primary">
                <h5 class="modal-title">
                  <span class="fw-mediumbold">
                  TAMBAH WILAYAH</span> 
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="{{route('admin.wil.store')}}" method="POST">
                  @csrf
                  @method('POST')
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>KODE POS</label>
                        <input type="number" class="form-control" value="{{ Session::get('wil_id') }}" name="wil_id" required>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>DESA</label>
                        <input type="text" class="form-control" name="wil_desa" value="{{ Session::get('wil_desa') }}" required>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>KECAMATAN</label>
                        <input type="text" class="form-control" value="{{ Session::get('wil_kecamatan') }}" name="wil_kecamatan" required>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>KOTA/KAB</label>
                        <input type="text" class="form-control" value="{{ Session::get('wil_kota') }}" name="wil_kota" required>
                      </div>
                    </div>
                    
                  </div>
                </div>
                <div class="modal-footer no-bd">
                  <button type="button" class="btn" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        {{-- END MODAL BUAT PAKET PPP --}}
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
          <div class="table-responsive">
            <table id="input_data" class="display table table-striped table-hover" >
              <thead>
                <tr>
                  <th>KODEPOS</th>
                  <th>DESA</th>
                  <th>KECAMATAN</th>
                  <th>KOTA/KAB</th>
                  <th>STATUS</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data_wilayah as $d)
                <tr>
                      <td data-toggle="modal" data-target="#update_wilayah{{$d->wil_id}}">{{$d->wil_id}}</td>
                      <td data-toggle="modal" data-target="#update_wilayah{{$d->wil_id}}">{{$d->wil_desa}}</td>
                      <td data-toggle="modal" data-target="#update_wilayah{{$d->wil_id}}">{{$d->wil_kecamatan}}</td>
                      <td data-toggle="modal" data-target="#update_wilayah{{$d->wil_id}}">{{$d->wil_kota}}</td>
                      <td data-toggle="modal" data-target="#update_wilayah{{$d->wil_id}}">{{$d->wil_status}}</td>
                      <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="update_wilayah{{$d->wil_id}}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header no-bd bg-primary">
        <h5 class="modal-title">
          <span class="fw-mediumbold">
          UPDATE WILAYAH</span> 
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('admin.wil.update',['id'=>$d->wil_id])}}" method="POST">
          @csrf
          @method('PUT')
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label>KODE POS</label>
                <input type="number" class="form-control" value="{{  $d->wil_id}}" name="wil_id" required>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label>DESA</label>
                <input type="text" class="form-control" name="wil_desa" value="{{ $d->wil_desa }}" required>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label>KECAMATAN</label>
                <input type="text" class="form-control" value="{{ $d->wil_kecamatan }}" name="wil_kecamatan" required>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label>KOTA/KAB</label>
                <input type="text" class="form-control" value="{{ $d->wil_kota }}" name="wil_kota" required>
              </div>
            </div>
            
          </div>
        </div>
        <div class="modal-footer no-bd">
          <button type="button" class="btn" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
                    @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection



