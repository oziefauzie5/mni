@extends('layout.main')
@section('content')

<div class="content">
  <div class="page-inner">
    <div class="row">
      <a href="{{route('admin.pel.registrasi')}}" class="col-6 col-sm-4 col-lg-4">
        <div class="card">
          <div class="card-body p-3 text-center">
            <div class="h1 m-0">{{$count_reg}}</div>
            <div class="text-muted mb-3">Registrasi</div>
          </div>
        </div>
      </a>
      <div class="col-6 col-sm-4 col-lg-4">
        <div class="card">
          <div class="card-body p-3 text-center">
            <div class="h1 m-0">{{$count_Active}}</div>
            <div class="text-muted mb-3">Active</div>
          </div>
        </div>
      </div>
      <div class="col-6 col-sm-4 col-lg-4">
        <div class="card">
          <div class="card-body p-3 text-center">
            <div class="h1 m-0">{{$count_NonActive}}</div>
            <div class="text-muted mb-3">Non Active</div>
          </div>
        </div>
      </div>

    </div>
  </div>
    <div class="col-md-12">
      <div class="card">
        <form >
          <div class="row m-1 mt-3">
            <div class="col-sm-3">
                <select name="data" class="custom-select custom-select-sm">
                  @if($data)
                  <option value="{{$data}}" selected>{{$data}}</option>
                  @endif
                  <option value="">ALL DATA</option>
                  <option value="Registrasi">Registrasi</option>
                  <option value="Active">Active</option>
                  <option value="Non Active">Non Active</option>
                </select>
            </div>
            <div class="col-sm-3">
                <select name="paket" class="custom-select custom-select-sm">
                  @if($paket)
                  <option value="{{$paket}}" selected>{{$p_nama}}</option>
                  @endif
                  <option value="">ALL PAKET</option>
                  @foreach($data_paket as $paket)
                  <option value="{{$paket->paket_id}}">{{$paket->paket_nama}}</option>
                  @endforeach
                </select>
            </div>
            <div class="col-sm-3">
              <input name="q" type="text" class="form-control form-control-sm" placeholder="Cari">
            </div>
            <div class="col-sm-3">
              <button type="submit" class="btn btn-block btn-dark btn-sm">Submit
            </div>
          </div>
          </form>
          <hr>
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
            <table class="display table table-striped table-hover" >
              <thead>
                <tr>
                  <th>Aksi</th>
                  <th>ID</th>
                  <th>NAMA</th>
                  <th>NO HP</th>
                  <th>ALAMAT TAGIH</th>
                  <th>SERIAL NUMBER</th>
                  <th>STATUS</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($pelanggan as $d)
                <tr>
                      <td><a href="{{route('admin.pel.print',['id'=>$d->reg_idpel])}}"><button class="btn btn-sm btn-danger">Print</button></a></td>
                      <td class="href" data-id="{{$d->reg_idpel}}">{{$d->reg_idpel}}</td>
                      <td class="href" data-id="{{$d->reg_idpel}}">{{$d->reg_nama}}</td>
                      <td class="href" data-id="{{$d->reg_idpel}}">{{$d->reg_hp1}}</td>
                      <td class="href" data-id="{{$d->reg_idpel}}">{{$d->reg_alamat_tagih}}</td>
                      <td class="href" data-id="{{$d->reg_idpel}}"> {{$d->reg_sn}}</td>
                      <td data-toggle="modal" data-target="#exampleModal{{$d->reg_idpel}}">@if($d->reg_status=='0') Registrasi @elseif($d->reg_status =='1')Menunggu Teknisi @elseif($d->reg_status =='2')Pemasangan @elseif($d->reg_status =='3')Menungg Aktivasi NOC @elseif($d->reg_status =='4')Active @endif</td>
                      <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModal{{$d->reg_idpel}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Status Pelanggan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('admin.pel.status',['id'=>$d->reg_idpel])}}" method="post">
          @csrf
          @method('PUT')
        <div class="col">
          <select name="reg_status" class="custom-select">
            <option value="{{$d->reg_status}}">{{$d->reg_status}}</option>
            <option value="Registrasi">Registrasi</option>
            <option value="Active">Active</option>
            <option value="Non Active">Non Active</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </form>
      </div>
    </div>
  </div>
</div>
                    @endforeach
              </tbody>
            </table>
            <div class="pull-left">
              Showing
              {{$pelanggan->firstItem()}}
              to
              {{$pelanggan->lastItem()}}
              of
              {{$pelanggan->total()}}
              entries
            </div>
            <div class="pull-right">
              {{ $pelanggan->withQueryString()->links('pagination::bootstrap-4') }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection



