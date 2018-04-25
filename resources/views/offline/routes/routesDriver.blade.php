@extends('adminlte::layouts.app-offline')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.route') }}
@endsection

@section('main-content')
	<routes-index></routes-index>
@endsection


@section('custom_js')
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
	{{-- <script type="text/javascript">
		$('.toggle-modal').click(function() {
			var id = $(this).data('id');
			var comment = $('.comment-' + id).html();
			$('#row-id').val(id);
			$('.textarea').html(comment + ' ');
		});

		function initMap() {
			var map = new GMaps({
		      el: '#DriverMap',
		      lat: 55.108803,
		      lng: 24.119208,
		      zoom: 8
		    });

			// $.each( locations, function( index, value ){
			// 	$.get("https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyBCEnBFUYhcQ8Ntint6QIGLmafq9FavCwQ&address='"+value+"'",function(data) {
			// 	    map.addMarker({
			// 	      lat: data.results[0].geometry.location.lat,
			// 	      lng: data.results[0].geometry.location.lng,
			// 	    });
			// 	});
			// });
		}
    </script>
	<script src="https://maps.google.com/maps/api/js?key=AIzaSyBCEnBFUYhcQ8Ntint6QIGLmafq9FavCwQ&callback=initMap"></script> --}}
@endsection

@section('custom-css')
	@media all and (max-width: 991px) {
		.table-responsive-row td:nth-of-type(1):before {
			content: 'Išvykimo data';
		}
		.table-responsive-row td:nth-of-type(2):before {
			content: 'Pavadinimas';
		}
		.table-responsive-row td:nth-of-type(3):before {
			content: 'Adresas';
		}
		.table-responsive-row td:nth-of-type(4):before {
			content: 'Mob. nr.';
		}
		.table-responsive-row td:nth-of-type(5):before {
			content: 'Galvijų sk.';
		}
		.table-responsive-row td:nth-of-type(6):before {
			content: 'Byla';
		}
		.table-responsive-row td:nth-of-type(7):before {
			content: 'Komentaras';
		}
		#DriverMap {
			height: 500px;
		}
	}
	@media all and (maw-width: 768px) {
		#DriverMap {
			height: 300px;
		}
	}
	html { height: 100% }
	body { height: 100%; margin: 0px; padding: 0px }
	#DriverMap { height: 100% }
@endsection
