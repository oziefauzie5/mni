@extends('layout.main')
@section('content')

<div class="content">
  <div class="page-inner">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header bg-primary">
            <div class="d-flex align-items-center">
              <h4 class="card-title text-bold">PAKET INTERNET</h4>
            </div>
          </div>
          <div class="card-body">
            <button class="btn  btn-sm ml-auto m-1 btn-primary " data-toggle="modal" data-target="#addpaket">
              <i class="fa fa-plus"></i>
              TAMBAH PAKET</button><hr>
              
            <div class="modal fade" id="addpaket" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                  <div class="modal-header no-bd bg-primary">
                    <h5 class="modal-title">
                      <span class="fw-mediumbold">
                      TAMBAH PAKET</span> 
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="{{route('admin.app.paket.store')}}" method="POST">
                      @csrf
                      @method('POST')
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>NAMA PAKET</label>
                            <input type="text" class="form-control" name="paket_nama" value="{{ Session::get('paket_nama') }}" required>
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>HPP</label>
                            <input type="number" class="form-control" value="{{ Session::get('paket_harga') }}" name="paket_harga" required>
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
              <table id="input_data" class="display table table-striped table-hover text-nowrap" >
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nama Paket</th>
                    <th>HPP</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Nama Paket</th>
                    <th>HPP</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
                  @foreach ($data_paket as $d)
                  <tr>
                    <td>{{$d->id}}</td>
                    <td data-toggle="modal" data-target="#modal_edit{{$d->id}}">{{$d->paket_nama}}</td>
                    <td data-toggle="modal" data-target="#modal_edit{{$d->id}}">Rp. {{ number_format( $d->paket_harga)}}</td>
                    <td>{{$d->paket_status}}</td>
                    <td>
                      <div class="form-button-action">
                        <button type="button" data-toggle="modal" data-target="#modal_hapus{{$d->id}}" class="btn btn-link btn-danger">
                          <i class="fa fa-times"></i>
                        </button>
                      </div>
                    </td>
                  
                      </tr>
                        <!-- Modal Edit -->
                        <div class="modal fade" id="modal_edit{{$d->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header no-bd">
                                <h5 class="modal-title">
                                  <span class="fw-mediumbold">
                                  EDIT PAKET</span> 
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form action="{{route('admin.app.paket.update',['id'=>$d->id])}}" method="POST">
                                  @csrf
                                  @method('PUT')
                                  <div class="row">
                                    <div class="col-sm-12">
                                      <div class="form-group">
                                        <label>NAMA PAKET</label>
                                        <input type="text" class="form-control" name="paket_nama" value="{{ $d->paket_nama }}" required>
                                      </div>
                                    </div>
                                    <div class="col-sm-12">
                                      <div class="form-group">
                                        <label>HPP</label>
                                        <input type="number" class="form-control" value="{{ $d->paket_harga }}" name="paket_harga" required>
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
                        <!-- End Modal Edit -->
                      @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection