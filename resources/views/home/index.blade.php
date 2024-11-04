@extends('layout.main')
@section('content')

<div class="content">
  <div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
      <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
        <div>
          <h2 class="text-white pb-2 fw-bold">{{Session::get('app_nama')}}</h2>
          <h5 class="text-white op-7 mb-2">{{Session::get('app_brand')}}</h5>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

<script>
  	Circles.create({
			id:'circles-1',
			radius:45,
			value:60,
			maxValue:100,
			width:7,
			text: 5,
			colors:['#f1f1f1', '#FF9E27'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})
</script>