<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>{{Session::get('app_brand')}}</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{ asset('storage/img/'.Session::get('app_favicon')) }}" type="image/x-icon"/>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js')}}"></script>  
	<script src="{{asset('atlantis/assets/js/plugin/webfont/webfont.min.js')}}"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ["{{asset('atlantis/assets/css/fonts.min.css')}}"]},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="{{asset('atlantis/assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('atlantis/assets/css/atlantis.min.css')}}">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="{{asset('atlantis/assets/css/demo.css')}}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css">

	<style>
		.img{
  width: 20px;
  /* border-style:solid; */
	border-width: 20px;
    border-color: rgb(255, 255, 255);
    width: 10px;
    border-radius: 3px;

	}
	.card_custom{
		border-radius: 20px; height:100%; background: linear-gradient(to right, #5d69be, #C89FEB);
	}
	.card_custom1{
		border-radius: 20px;;
	}
	
    
	</style>
</head>
<body>
	<div class="wrapper overlay-sidebar">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="blue">
				
				<a href="{{route('admin.sales.index')}}" class="logo">
				<img src="{{ asset('storage/img/'.Session::get('app_logo')) }}" style="width: 90%;" alt="navbar brand" class="navbar-brand">
				</a>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
			
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
				
				<div class="container-fluid">
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link dropdown-toggle" href="{{ route('logout') }}" >
							<i class="fas fa-sign-out-alt"> </i> LOGOUT
							</a>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="{{route('admin.sales.index')}}" aria-expanded="false">
								<div class="avatar-sm">
								<img src="@if(Auth::user()->photo) {{ asset('storage/photo-user/'.Auth::user()->photo) }} @else {{ asset('atlantis/assets/img/user.png') }}@endif" alt=".." class="avatar-img rounded-circle"> 
								</div>
							</a>
						</li>
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>

		<!-- End Sidebar -->

		<div class="main-panel">
            @yield('content')
			
			</div>
		
	<!--   Core JS Files   -->
	<script src="{{asset('atlantis/assets/js/core/jquery.3.2.1.min.js')}}"></script>
	<script src="{{asset('atlantis/assets/js/core/popper.min.js')}}"></script>
	<script src="{{asset('atlantis/assets/js/core/bootstrap.min.js')}}"></script>

	<!-- jQuery UI -->
	<script src="{{asset('atlantis/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
	<script src="{{asset('atlantis/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')}}"></script>

	<!-- jQuery Scrollbar -->
	<script src="{{asset('atlantis/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>


	<!-- Chart JS -->
	<script src="{{asset('atlantis/assets/js/plugin/chart.js/chart.min.js')}}"></script>

	<!-- jQuery Sparkline -->
	<script src="{{asset('atlantis/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js')}}"></script>

	<!-- Chart Circle -->
	<script src="{{asset('atlantis/assets/js/plugin/chart-circle/circles.min.js')}}"></script>

	<!-- Datatables -->
	<script src="{{asset('atlantis/assets/js/plugin/datatables/datatables.min.js')}}"></script>

	<!-- Bootstrap Notify -->
	<script src="{{asset('atlantis/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>

	<!-- jQuery Vector Maps -->
	<script src="{{asset('atlantis/assets/js/plugin/jqvmap/jquery.vmap.min.js')}}"></script>
	<script src="{{asset('atlantis/assets/js/plugin/jqvmap/maps/jquery.vmap.world.js')}}"></script>

	<!-- Sweet Alert -->
	<script src="{{asset('atlantis/assets/js/plugin/sweetalert/sweetalert.min.js')}}"></script>

	<!-- Atlantis JS -->
	<script src="{{asset('atlantis/assets/js/atlantis.min.js')}}"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

	<!-- Atlantis DEMO methods, don't include it in your project! -->


	<!-- <script src="{{asset('atlantis/assets/js/setting-demo.js')}}"></script>
	<script src="{{asset('atlantis/assets/js/demo.js')}}"></script> -->

	<script>

			$(function () {
			$('.datepicker').datepicker({
				language: "es",
				autoclose: true,
				format: "dd-mm-yyyy",
			});
			});

// 			$(document).ready(function() {
//             $("#before, #after").keyup(function() {
//                 var after  = $("#after").val();
//                 var before = $("#before").val();
    
//                 var total = parseInt(before) - parseInt(after);
//                 if (isNaN(total)) {
//                     total = '';
//                     }
//                 $("#total").val(total);
//             });


//             $("#before_dropcore, #after_dropcore").keyup(function() {
// 				var after_dropcore  = $("#after_dropcore").val();
//                 var before_dropcore = $("#before_dropcore").val();
    
//                 var total_dropcore = parseInt(before_dropcore) - parseInt(after_dropcore);
//                 if (isNaN(total_dropcore)) {
//                     total_dropcore = '';
//                     }
//                 $("#total_dropcore").val(total_dropcore);
//             });


//             });
// 			$("#fat_opm, #home_opm").keyup(function() {
//                 var home_opm  = $("#home_opm").val();
//                 var fat_opm = $("#fat_opm").val();
//                 var num1 = "1";
//                 var total_lost = Number((fat_opm-home_opm).toFixed(2)); // 1 instead of 1.01;
//                 $("#los_opm").val(total_lost);
//             });

// MEMBUAT USERNAME
$(document).ready(function() {
	var id = $('#reg_idpel').val();
	var v = $('#reg_nama').val();
	value = v.replace(/[.,+'-]/g, '');
	fix = value.replace(/\s/g, '_');
                $('#reg_username').val(id+'@'+fix.toUpperCase());
    // console.log(v);
});
		
//HITUNG KABEL
$(document).ready(function() {
            $("#reg_kabel").keyup(function() {
                var kabel  = $("#reg_kabel").val();
				var biaya_kabel = $("#biaya_kabel").val();
				var total = parseInt(biaya_kabel) * parseInt(kabel);
				if (isNaN(total)) {
					total = '';
				}
				let rupiahFormat1 = new Intl.NumberFormat('id-ID', {
                              style: 'currency',minimumFractionDigits: 0,
                              currency: 'IDR',
                            }).format(biaya_kabel);
				let rupiahFormat2 = new Intl.NumberFormat('id-ID', {
                              style: 'currency',minimumFractionDigits: 0,
                              currency: 'IDR',
                            }).format(total);
				if(kabel <=100){
					$("#text").html('Gratis biaya kabel');
					$("#total").val(0);
				}else {
					$("#text").html('Dikenakan biaya kabel '+kabel+' meter x '+ rupiahFormat1 +' = '+rupiahFormat2);
					$("#total").val(total);
				}
            });
            });

			$('#paket').on('change', function() {
				var kode_paket = $(this).val();
                var url = '{{ route("admin.sales.getPaket", ":id") }}';
				url = url.replace(':id', kode_paket);
                if (kode_paket) {
                    $.ajax({
                        url: url,
                        type: 'GET',
                        data: {
                            '_token': '{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        success: function(data) {
                            // console.log(data[0]['paket_harga']);
                            if (data) {
								var harga = data[0]['paket_harga'];
								$("#paket_harga").val(harga);

                            } else {
                                $('#paket_harga').empty();
                            }
                        }
                    });
                } else {
                    $('#paket_harga').empty();
                }
        });
      
// END AMBIL HARGA PAKET #REGISTRASI

		@if (Session::has('pesan'))
swal("{{Session::get('alert')}}!", "{{Session::get('pesan')}}", {
						icon : "{{Session::get('alert')}}",
						buttons: {        			
							confirm: {
								className : 'btn btn-success'
							}
						},
					});
@endif

		function comingson() {
			swal('Comingsoon');
		}
		$(document).ready(function() {
	
			
		$('#table').DataTable({
			"pageLength": 5,
			
		});
		$('#get_invoice').DataTable({
			"pageLength": 5,
			
		});
		});


	</script>
	
</body>
</html>