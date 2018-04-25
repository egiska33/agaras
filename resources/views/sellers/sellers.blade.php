@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.sellers') }}
@endsection

@section('main-content')
	<div class="container spark-screen">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title"><i class="fa fa-handshake-o" aria-hidden="true"></i> {{ trans('adminlte_lang::message.sellers') }}</h3>
					</div>
					<div class="box-body">
		              <div class="dataTables_wrapper form-inline dt-bootstrap">
					    <div class="row">
					    	<div class="col-xs-12 col-sm-5 col-md-6">
						    	<a href="{{ url('sellers?date=' . \Carbon\Carbon::now()->format('Y-m-d')) }}" class="margin-bottom">{{ trans('adminlte_lang::message.today') }}</a>
					        	<a href="{{ url('sellers?date=' . \Carbon\Carbon::yesterday()->format('Y-m-d')) }}" class="margin-bottom">{{ trans('adminlte_lang::message.yesterday') }}</a>
					        	<a href="{{ url('sellers?date=' . \Carbon\Carbon::now()->startOfWeek()->format('Y-m-d') . '&week=true') }}" class="margin-bottom">{{ trans('adminlte_lang::message.thisWeek') }}</a>
					        	<a href="#" class="margin-bottom" data-toggle="modal" data-target="#modal-default">{{ trans('adminlte_lang::message.concreteDate') }}</a>
					        	@if(!empty(Request::get('date')))
					        		<a href="{{ url('sellers') }}" class="text-red">{{ trans('adminlte_lang::message.clear')}}</a>
					        		@if( strtotime(Request::get('date')) !== false)
						        		<p><strong>Pasirinkta data:</strong> {{ \Carbon\Carbon::parse(Request::get('date'))->format('Y-m-d') }}</p>
						        	@endif
					        	@endif
					    	</div>
					        <div class="search-block col-xs-12 col-sm-7 col-md-6 text-right">
					            <form action="{{ url('sellers') }}" method="GET">
					                <label>{{ trans('adminlte_lang::message.search')}}:
						                <input name="search" type="text" class="form-control input-sm" @if(!empty(Request::get('search')))value="{{ Request::get('search') }}"@endif />
					                </label>
					                <button type="submit" class="btn btn-primary btn-sm">{{ trans('adminlte_lang::message.search')}}</button>
					                @if(!empty(Request::get('search')))
					                	<a href="{{ url('sellers') }}" class="btn btn-danger btn-sm">{{ trans('adminlte_lang::message.clear')}}</a>
					                @endif
					            </form>
					        </div>
					    </div>
					    <div class="row">
					        <div class="col-sm-12">
					            <table class="table table-bordered table-striped table-responsive-row" role="grid">
					                <thead class="hidden-xs">
					                    <tr role="row">
					                        <th>Pavadinimas</th>
					                        <th>Kodas</th>
					                        <th>Adresas</th>
					                        <th>PVM kodas</th>
					                        <th>Mob. nr.</th>
					                        <th>PVM tarifas</th>
					                        <th>Paimti gyv.</th>
					                        <th>Veiksmai</th>
					                    </tr>
					                </thead>
					                <tbody>
					                	@foreach($sellers as $seller)
						                	<tr role="row">
						                		<td>{{ $seller->name }}</td>
						                		<td>{{ $seller->code }}</td>
						                		<td>{{ $seller->address }}</td>
						                		<td>@if(empty($seller->pvm_code)){{ trans('adminlte_lang::message.noPvm') }}@else{{ $seller->pvm_code }}@endif</td>
						                		<td>@if(!empty($seller->phone))+3706{{ $seller->phone }}@else <span>-</span>@endif</td>
						                		<td>{{ $seller->pvm_rate }}</td>
						                		<td>{{ $seller->animals()->count() }}</td>
						                		<td>
						                			<a href="{{ url('sellers/'. $seller->id .'/edit') }}" class="btn btn-sm btn-primary">Redaguoti</a>
						                			<a href="{{ url('sellers/'. $seller->id) }}" data-id="{{ $seller->id }}" class="btn btn-sm btn-danger button-delete">Ištrinti</a>
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
					            	{{ $sellers->links() }}
					            </div>
					        </div>
					    </div>
					</div>
				</div>
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
          <form action="{{ url('sellers') }}" method="GET">
			<div class="modal-body">
				<div class="form-group">
					<label>{{ trans('adminlte_lang::message.concreteDate') }}</label>
					<input type="text" name="date" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="datepicker" />
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{ trans('adminlte_lang::message.close') }}</button>
				<button type="submit" class="btn btn-primary">{{ trans('adminlte_lang::message.doFiltering') }}</button>
			</div>
          </form>
        </div>
      </div>
    </div>
@endsection

@section('custom-css')
	@media all and (max-width: 991px) {
		.table-responsive-row td:nth-of-type(1):before {
			content: 'Pavadinimas';
		}
		.table-responsive-row td:nth-of-type(2):before {
			content: 'Kodas';
		}
		.table-responsive-row td:nth-of-type(3):before {
			content: 'Adresas';
		}
		.table-responsive-row td:nth-of-type(4):before {
			content: 'PVM kodas';
		}
		.table-responsive-row td:nth-of-type(5):before {
			content: 'Mob. nr.';
		}
		.table-responsive-row td:nth-of-type(6):before {
			content: 'PVM tarifas';
		}
		.table-responsive-row td:nth-of-type(7):before {
			content: 'Paimti gyv.';
		}
	}
@endsection
