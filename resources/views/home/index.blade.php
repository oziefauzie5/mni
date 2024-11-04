@extends('layout.main')
@section('content')

<div class="content">
  <div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
      <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
        <div>
          <h2 class="text-white pb-2 fw-bold">{{Session::get('app_nama')}}</h2>
          <img src="{{ asset('storage/img/'.Session::get('app_logo')) }}" style="width: 90%;" alt="Logo Brand" class="navbar-brand">
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
