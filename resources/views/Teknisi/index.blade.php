@extends('layout.user')
@section('content')

<div class="content">
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">

                
            </div>
        </div>
    </div>
    <div class="page-inner mt--5">
      {{-- <div class="h5 mt--5 text-light font-weight-bold ">MITRA : {{$nama}}</div><br> --}}
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
      <div class="row mt--1">
            <div class="col-6 col-sm-6">
              <div class="card ">
                <div class="card-body p-3 text-center">
                  <div class="text-right text-danger">
                  </div>
                  <div class="h5 m-0">{{$pemasangan}}</div>
                  <div class="h6 ">Pem. Bulan ini</div>
                </div>
              </div>
            </div>
            <div class="col-6 col-sm-6">
              <div class="card">
                <div class="card-body p-3 text-center">
                  <div class="text-right text-success">
                  </div>
                  <div class="h5 m-0">{{$total_pemasangan}}</div>
                  <div class="h6 ">Total Pemasangan</div>
                </div>
              </div>
            </div>
          </div>
          </div>

          <section class="content">
            <div class="card card-primary card_custom1 p-3">
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th>
                              <a href="" onclick="comingson()" class="card mb-2 card_custom1" style="width: 4rem;">
                                <img src="{{ asset('atlantis/assets/img/ticket.png') }}" class="card-img-center p-2" alt="...">
                                </a>
                                <div class="text-light mb-3 text-center">Tiket</div>
                            </th>
                            <th>
                              <a href="{{route('admin.teknisi.list_aktivasi')}}" class="card mb-2 card_custom1" style="width: 4rem;">
                                <img src="{{ asset('atlantis/assets/img/ceklis.png') }}" class="card-img-center p-2" alt="...">
                                </a>
                                <div class="text-light mb-3 text-center">Aktivasi</div>
                              </th>
                              <th>
                              <th>
                              <a href="{{ route('logout') }}" class="card mb-2 card_custom1" style="width: 4rem;">
                                <img src="{{ asset('atlantis/assets/img/shutdown.png') }}" class="card-img-center p-2" alt="...">
                                </a>
                                <div class="text-light mb-3 text-center">Logout</div>
                            </th>
                        </tr>
                    </table>
                </div>
            </div>
    </section>

        <section class="content mt-3">
          @foreach($job as $pel)
          <div class="col">
              <div class="card card_custom1" @if ($pel->reg_status==1)data-toggle="modal" data-target="#exampleModal{{$pel->reg_idpel}}" @endif>
                <div class="card-body skew-shadow">
                    <div class="row">
                        <div class="col-12 pr-0">
                            <h3 class="fw-bold mb-1">{{$pel->reg_nama}}</h3>
                            <div class="text-small text-uppercase fw-bold op-8">{{$pel->reg_alamat_pasang}}</div>
                        </div>
                        <div class="col-12 pr-0">
                            <div class="text-small text-uppercase fw-bold text-danger"> <span class="text-dark">Tanggal Registasi : </span>{{date('d M Y H:m:s',strtotime($pel->created_at))}}</div>
                        </div>
                        <div class="col-12 pl-0 text-right">
                            <div class="text-small text-uppercase fw-bold op-8">@if($pel->reg_status=='0') Registrasi @elseif($pel->reg_status =='1')Menunggu Teknisi @elseif($pel->reg_status =='2')Pemasangan @elseif($pel->reg_status =='3')Selesai @endif</div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
          {{-- modal lihat pel --}}
          <div class="modal fade" id="exampleModal{{$pel->reg_idpel}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">TERIMA JOB</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  
                  {{--  --}}
                  <label for="barang" class=" col-form-label">DATA LANGGANAN</label>
                  <ul class="list-group">
                   <li class="list-group-item">No. Layanan   : {{$pel->reg_idpel}}</li>
                   <li class="list-group-item">Nama   : {{$pel->reg_nama}}</li>
                   <li class="list-group-item">Alamat : {{$pel->reg_alamat_pasang}}</li>
                  </ul>
                  <hr>
                  <label for="barang" class=" col-form-label">TEAM TEKNISI</label>
          
                  <div class="content">
                  <form action="{{route('admin.teknisi.job',['id'=>$pel->reg_idpel])}}" method="POST">
                  @csrf
                  @method('POST')
                  <div class="form-group">
          
                                        <select class="form-control mb-3" id="teknisi" name="teknisi" required>
                                          <option value="">Pilih Teknisi</option>
                                          @foreach ($teknisi as $user)
                                          <option value="{{$user->id.'|'.$user->name.'|'.$user->hp}}">{{$user->name}}</option>
                                          @endforeach
                                        </select>
                                        <input type="text" class="form-control" name="sub_teknisi" required placeholder="Masukan Partner Kerja anda">
                                    </div>
                                    <label for="barang" class=" col-form-label">JENIS PEKERJAAN</label>
                  <div class="form-group">

                                        <input type="text" class="form-control" name="job" value="PSB" readonly>
                                    </div>
          
                  </div>
                  {{--  --}}


                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Terima Job</button>
                </div>
                </form>
              </div>
            </div>
          </div>
          <!-- Modal -->
          @endforeach
      </section>


    </div>
  </div>
@endsection