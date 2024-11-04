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



        <div class="row mt--5">
            <div class="col-12 col-sm-12">
              <div class="card ">
                <div class="card-body p-3 text-center">
                  <div class="text-right text-danger">
                  </div>
                  <div class="h1 m-0">LIST AKTIVASI</div>
                  <div class="text-muted mb-3"><a href="{{route('admin.teknisi.index')}}"><button class="btn btn-danger btn-sm">Kembali</button></a></div>
                </div>
              </div>
            </div>
          </div>

            <section class="content mt-3">
                @foreach($pel as $job)
                <div class="col">
                    <div class="card card_custom1" @if ($job->teknisi_userid == $teknisi_id) onclick="location.href='{{route('admin.teknisi.aktivasi',['id'=>$job->reg_idpel])}}';" @endif>
                        <div class="card-body skew-shadow">
                            <div class="row">
                                <div class="col-12 pr-0">
                                    <h3 class="fw-bold mb-1">{{$job->reg_nama}}</h3>
                                    <div class="text-small text-uppercase fw-bold op-8">{{$job->reg_alamat_pasang}}</div>
                                </div>
                              
                            </div>
                            <div class="row">
                                <div class="col-12 pl-0 text-right">
                                    <div class="text-small text-uppercase fw-bold op-8">{{$job->teknisi_team}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </section>



            
    </div>
  </div>
  <script>
function copy1() {
  var copyText1 = document.getElementById("myInput1");
  copyText1.select();
  copyText1.setSelectionRange(0, 99999); // For mobile devices
  navigator.clipboard.writeText(copyText1.value);
  
    }
    function copy2() {
      var copyText2 = document.getElementById("myInput2");
            copyText2.select();
      copyText2.setSelectionRange(0, 99999); // For mobile devices
            navigator.clipboard.writeText(copyText2.value);

    }
    </script>
@endsection