@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.route') }}
@endsection

@section('main-content')
	{{-- <routes-index></routes-index> --}}

	<div class="container spark-screen">
		<div class="row">
			<div class="col-md-12">
				<!-- Default box -->
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title"><i class="fa fa-globe" aria-hidden="true"></i> Vadybininkas Vad ({{ Auth::user()->plate }}) {{ trans('adminlte_lang::message.route') }}</h3>
					</div>
					<div class="box-body">
		              <div class="dataTables_wrapper form-inline dt-bootstrap">
					    <div class="row">
					        <div class="col-sm-12">
					            <table class="table table-bordered dataTable table-striped table-responsive-row" role="grid">
					                <thead>
					                    <tr role="row">
					                        <th>Išvykimo data</th>
					                        <th>Pavadinimas</th>
					                        <th>Adresas</th>
					                        <th>Mob. nr.</th>
					                        <th>Galvijų sk.</th>
					                        <th>Byla</th>
					                        <th>Komentaras</th>
					                        <th>Veiksmai</th>
					                    </tr>
					                </thead>
					                <tbody>
					                	@foreach($routes as $route)
						                	<tr role="row">
						                		<td>{{ \Carbon\Carbon::parse($route->pick_up_time)->format('Y-m-d') }}</td>
						                		<td>{{ $route->name }}</td>
						                		<td>{{ $route->seller_address }}</td>
						                		<td>{{ $route->phone }}</td>
						                		<td>{{ $route->total_animals }}</td>
						                		<td @if(!$route->file()->exists())class="hidden-xs"@endif><a href="uploads/{{ $route->file()->value('filename') }}" target="_blank">{{ $route->file()->value('filename') }}</a></td>
						                		<td class="comment-{{ $route->id }} @if(empty($route->comment)) hidden-xs @endif ">{{ $route->comment }}</td>
						                		<td>
						                			<a href="#" class="toggle-modal" data-id="{{ $route->id }}" data-toggle="modal" data-target="#modal-default">Pridėti komentarą</a>
						                		</td>
						                	</tr>
						                @endforeach
					                </tbody>
					            </table>
					        </div>
					    </div>
					</div>
					<!-- /.box-body -->
					<div class="box-header with-border">
						<h3 class="box-title">{{ trans('adminlte_lang::message.map') }}</h3>
					</div>
					<div class="box-body">
						<div id="DriverMap" style="width: 100%; height: 800px;"></div>
					</div>
				</div>
				<!-- /.box -->
			</div>
		</div>
	</div>
	<div class="modal fade in" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">{{ trans('adminlte_lang::message.add_comment') }}</h4>
          </div>
          <form action="{{ url('routes/updateComment') }}" method="POST">
          	{{ csrf_field() }}
          	{{ method_field('PUT') }}
          	<input id="row-id" type="hidden" name="id">
			<div class="modal-body">
				<div class="form-group">
					<label>{{ trans('adminlte_lang::message.comment') }}</label>
					<textarea class="form-control textarea" rows="3" name="comment"></textarea>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{ trans('adminlte_lang::message.close') }}</button>
				<button type="submit" class="btn btn-primary">{{ trans('adminlte_lang::message.save') }}</button>
			</div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
@endsection


@section('custom_js')
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
	<script type="text/javascript">
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
	<script src="http://maps.google.com/maps/api/js?key=AIzaSyBCEnBFUYhcQ8Ntint6QIGLmafq9FavCwQ&callback=initMap"></script>
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
