@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.driversStatistics') }}
@endsection

@section('main-content')
	<div class="container spark-screen">
		<div class="row">
			<div class="col-md-12">
				<!-- Default box -->
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title"><i class="fa fa-truck" aria-hidden="true"></i> {{ trans('adminlte_lang::message.driversStatistics') }}</h3>
					</div>
					<div class="box-body">
		              <div class="dataTables_wrapper form-inline dt-bootstrap">
					    <div class="row">
					        <div class="col-xs-12 date-filter">
					        	<a href="#" class="margin-bottom" data-toggle="modal" data-target="#modal-default">{{ trans('adminlte_lang::message.chooseDriverAndDate') }}</a>
					        	@if(!empty(Request::get('date')))
					        		<a href="{{ url('drivers-statistics') }}" class="text-red">{{ trans('adminlte_lang::message.clear')}}</a>
					        		@if( strtotime(Request::get('date')) !== false)
						        		<p>
						        			<strong>Pasirinkta data:</strong> {{ \Carbon\Carbon::parse(Request::get('date'))->format('Y-m-d') }}
						        		</p>
						        	@endif
						        	@if( Request::get('driver') && Request::get('driver') != '')
						        		<p>
						        			<strong>Pasirinktas vairuotojas:</strong> {{ App\Driver::findOrFail(Request::get('driver'))->name }}
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
					                        <th>Adresas</th>
					                        <th>Galvijų sk.</th>
					                    </tr>
					                </thead>
					                <tbody>
					                	@php ($totalAn = 0)
					                	@foreach($routes as $route)
						                	<tr role="row">
						                		@php ($driver = $route->driver()->first())
						                		@php ($totalAn += $route->total_animals)
						                		<td>{{ \Carbon\Carbon::parse($route->pick_up_time)->format('Y-m-d') }}</td>
						                		<td>{{ $driver->name }}</td>
						                		<td>{{ $driver->plate }}</td>
						                		<td>{{ $route->seller_address }}</td>
						                		<td class="no-padding-td">{{ $route->total_animals }}</td>
						                	</tr>
						                @endforeach
						                @if( $totalAn != 0 && (Request::get('driver') || Request::get('date')))
						                	<tr role="row" class="hidden-xs hidden-sm">
						                		<td align="right" colspan="4"><strong>VISO:</strong></td>
						                		<td>{{ $totalAn }}</td>
						                	</tr>
						                @endif
					                </tbody>
					            </table>
					            @if( $totalAn != 0 && (Request::get('driver') || Request::get('date')))
				                	<p class="visible-xs visible-sm">
				                		<strong>Viso galvijų:</strong> {{ $totalAn }}
				                	</p>
				                @endif
					        </div>
					    </div>
					    <div class="row">
					        <div class="col-xs-12 text-center">
					            <div class="dataTables_paginate paging_simple_numbers">
					            	{{-- {{ $routes->links() }} --}}
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
	<div class="modal fade in" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">{{ trans('adminlte_lang::message.concreteDate') }}</h4>
          </div>
          <form action="{{ url('drivers-statistics') }}" method="GET">
			<div class="modal-body">
				<div class="form-group">
					<label>{{ trans('adminlte_lang::message.chooseDriver') }}</label>
					<select name="driver" class="form-control">
						<option value="">Visi</option>
						@foreach($drivers as $driver)
							<option value="{{ $driver->id }}">{{ $driver->name }}</option>
						@endforeach
					</select>
				</div>
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
			content: 'Adresas';
		}
		.table-responsive-row td:nth-of-type(5):before {
			content: 'Galvijų sk.';
		}
	}
@endsection
