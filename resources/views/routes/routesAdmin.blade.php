@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.routes') }}
@endsection

@section('main-content')
	<div class="container spark-screen">
		<div class="row">
			<div class="col-md-12">

				<!-- Default box -->
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title"><i class="fa fa-globe" aria-hidden="true"></i> {{ trans('adminlte_lang::message.routes') }}</h3>
					</div>
					<div class="box-body">
		              <div class="dataTables_wrapper form-inline dt-bootstrap">
					    <div class="row">
					    	<div class="col-xs-12 col-sm-5 col-md-6">
						    	<a href="{{ url('routes/create') }}" class="btn btn-primary btn-sm margin-bottom"><i class='fa fa-plus'></i> {{ trans('adminlte_lang::message.add_new')}}</a>
					    	</div>
					        <div class="search-block col-xs-12 col-sm-7 col-md-6 text-right">
					            <form action="{{ url('routes') }}" method="GET">
					                <label>{{ trans('adminlte_lang::message.search')}}:
						                <input name="search" type="text" class="form-control input-sm" @if(!empty(Request::get('search')))value="{{ Request::get('search') }}"@endif />
					                </label>
					                <button type="submit" class="btn btn-primary btn-sm">{{ trans('adminlte_lang::message.search')}}</button>
					                @if(!empty(Request::get('search')))
					                	<a href="{{ url('routes') }}" class="btn btn-danger btn-sm">{{ trans('adminlte_lang::message.clear')}}</a>
					                @endif
					            </form>
					        </div>
					        <div class="col-xs-12 date-filter">
					        	<a href="{{ url('routes?date=' . \Carbon\Carbon::now()->format('Y-m-d')) }}" class="margin-bottom">{{ trans('adminlte_lang::message.today') }}</a>
					        	<a href="{{ url('routes?date=' . \Carbon\Carbon::tomorrow()->format('Y-m-d')) }}" class="margin-bottom">{{ trans('adminlte_lang::message.tomorrow') }}</a>
					        	<a href="{{ url('routes?date=' . \Carbon\Carbon::now()->startOfWeek()->format('Y-m-d') . '&week=true') }}" class="margin-bottom">{{ trans('adminlte_lang::message.thisWeek') }}</a>
					        	<a href="#" class="margin-bottom" data-toggle="modal" data-target="#modal-default">{{ trans('adminlte_lang::message.concreteDate') }}</a>
					        	@if(!empty(Request::get('date')))
					        		<a href="{{ url('routes') }}" class="text-red">{{ trans('adminlte_lang::message.clear')}}</a>
					        		@if( strtotime(Request::get('date')) !== false)
						        		<p>
						        			<strong>Pasirinkta data:</strong>
						        			@if(Request::get('week'))
						        				{{\Carbon\Carbon::now()->startOfWeek()->format('Y-m-d')}} - {{\Carbon\Carbon::now()->endOfWeek()->format('Y-m-d')}}
						        			@else
						        				{{ \Carbon\Carbon::parse(Request::get('date'))->format('Y-m-d') }}
						        			@endif
						        		</p>
						        	@endif
					        	@endif
					        </div>
					    </div>
					    <div class="row">
					        <div class="col-sm-12">
					            <table class="table table-bordered dataTable table-striped table-responsive-row" role="grid">
					                <thead>
					                    <tr role="row">
					                        <th>Išvykimo data</th>
					                        <th>Vairuotojas</th>
					                        <th>Valst. nr.</th>
					                        <th>Pavadinimas</th>
					                        <th>Adresas</th>
					                        <th>Mob. nr.</th>
					                        <th>Galvijų sk.</th>
					                        <th>Dokumentas</th>
					                        <th>Komentaras</th>
					                        <th>Veiksmai</th>
					                    </tr>
					                </thead>
					                <tbody>
					                	@foreach($routes as $route)
						                	<tr role="row">
						                		@php ($driver = $route->driver()->first())
						                		<td>{{ \Carbon\Carbon::parse($route->pick_up_time)->format('Y-m-d') }}</td>
						                		<td>{{ $driver->name }}</td>
						                		<td>{{ $driver->plate }}</td>
						                		<td>{{ $route->name }}</td>
						                		<td>{{ $route->seller_address }}</td>
						                		<td>{{ $route->phone }}</td>
						                		<td>{{ $route->total_animals }}</td>
						                		<td @if(!$route->file()->exists())class="hidden-xs"@endif><a href="uploads/{{ $route->file()->value('filename') }}" target="_blank">{{ $route->file()->value('filename') }}</a></td>
						                		<td @if(empty($route->comment))class="hidden-xs"@endif>{{ $route->comment }}</td>
						                		<td>
						                			<a href="{{ url('routes/'. $route->id .'/edit') }}" class="btn btn-sm btn-primary">Redaguoti</a>
						                			<a href="{{ url('routes/'. $route->id) }}" data-id="{{ $route->id }}" class="btn btn-sm btn-danger button-delete">Ištrinti</a>
						                		</td>
						                	</tr>
						                @endforeach
					                </tbody>
					            </table>
					        </div>
					    </div>
					    <div class="row">
					        <div class="col-xs-12 text-center">
					            <div class="dataTables_paginate paging_simple_numbers">
					            	{{ $routes->links() }}
					            </div>
					        </div>
					    </div>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->

			</div>
		</div>
	</div>
	<form id="delete_record" class="hidden" method="POST">
		{{ csrf_field() }}
		{{ method_field('delete') }}
	</form>
	<div class="modal fade in" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">{{ trans('adminlte_lang::message.concreteDate') }}</h4>
          </div>
          <form action="{{ url('routes') }}" method="GET">
			<div class="modal-body">
				<div class="form-group">
					<label>{{ trans('adminlte_lang::message.concreteDate') }}</label>
					<input class="datepicker form-control" type="text" name="date" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" />
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{ trans('adminlte_lang::message.close') }}</button>
				<button type="submit" class="btn btn-primary">{{ trans('adminlte_lang::message.doFiltering') }}</button>
			</div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
@endsection

@section('custom-css')
	@media all and (max-width: 991px) {
		.table-responsive-row td:nth-of-type(1):before {
			content: 'Išvykimo data';
		}
		.table-responsive-row td:nth-of-type(2):before {
			content: 'Vairuotojas';
		}
		.table-responsive-row td:nth-of-type(3):before {
			content: 'Valst. nr.';
		}
		.table-responsive-row td:nth-of-type(4):before {
			content: 'Pavadinimas';
		}
		.table-responsive-row td:nth-of-type(5):before {
			content: 'Adresas';
		}
		.table-responsive-row td:nth-of-type(6):before {
			content: 'Mob. nr.';
		}
		.table-responsive-row td:nth-of-type(7):before {
			content: 'Galvijų sk.';
		}
		.table-responsive-row td:nth-of-type(8):before {
			content: 'Dokumentas';
		}
		.table-responsive-row td:nth-of-type(9):before {
			content: 'Komentaras';
		}
	}
@endsection
