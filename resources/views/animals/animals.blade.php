@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.animals') }}
@endsection

@section('main-content')
	<div class="container spark-screen">
		<div class="row">
			<div class="col-md-12">

				<!-- Default box -->
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title"><i class="fa fa-github-alt" aria-hidden="true"></i> {{ trans('adminlte_lang::message.animals') }}</h3>
					</div>
					<div class="box-body">
		              <div class="dataTables_wrapper form-inline dt-bootstrap">
					    <div class="row">
					    	<div class="col-xs-12 col-sm-5 col-md-6">
						    	<a href="{{ url('animals/create-by-id') }}" class="btn btn-primary btn-sm margin-bottom"><i class='fa fa-plus'></i> {{ trans('adminlte_lang::message.add_by_id')}}</a>
						    	<a href="{{ url('animals/create') }}" class="btn btn-primary btn-sm margin-bottom"><i class='fa fa-plus'></i> {{ trans('adminlte_lang::message.add_new')}}</a>
					    	</div>
					        <div class="search-block col-xs-12 col-sm-7 col-md-6 text-right">
					            <form action="{{ url('animals') }}" method="GET">
					                <label>{{ trans('adminlte_lang::message.search')}}:
						                <input name="search" type="text" class="form-control input-sm" @if(!empty(Request::get('search')))value="{{ Request::get('search') }}"@endif />
					                </label>
					                <button type="submit" class="btn btn-primary btn-sm">{{ trans('adminlte_lang::message.search')}}</button>
					                @if(!empty(Request::get('search')))
					                	<a href="{{ url('animals') }}" class="btn btn-danger btn-sm">{{ trans('adminlte_lang::message.clear')}}</a>
					                @endif
					            </form>
					        </div>
					        <div class="col-xs-12 date-filter">
					        	<a href="{{ url('animals?date=' . \Carbon\Carbon::now()->format('Y-m-d')) }}" class="margin-bottom">{{ trans('adminlte_lang::message.today') }}</a>
					        	<a href="{{ url('animals?date=' . \Carbon\Carbon::yesterday()->format('Y-m-d')) }}" class="margin-bottom">{{ trans('adminlte_lang::message.yesterday') }}</a>
					        	<a href="{{ url('animals?date=' . \Carbon\Carbon::now()->startOfWeek()->format('Y-m-d') . '&week=true') }}" class="margin-bottom">{{ trans('adminlte_lang::message.thisWeek') }}</a>
					        	<a href="#" class="margin-bottom" data-toggle="modal" data-target="#modal-default">{{ trans('adminlte_lang::message.concreteDate') }}</a>
					        	@if(!empty(Request::get('date')))
					        		<a href="{{ url('animals') }}" class="text-red">{{ trans('adminlte_lang::message.clear')}}</a>
					        		@if( strtotime(Request::get('date')) !== false)
						        		<p><strong>Pasirinkta data:</strong> {{ \Carbon\Carbon::parse(Request::get('date'))->format('Y-m-d') }}</p>
						        	@endif
					        	@endif
					        </div>
					    </div>
					    <div class="row">
					        <div class="col-sm-12">
					            <table class="table table-bordered dataTable table-striped table-responsive-row" role="grid">
					                <thead>
					                    <tr role="row">
					                        <th>ID Nr.</th>
					                        <th>Paso Nr.</th>
					                        <th>Rūšis</th>
					                        <th>Veislė</th>
					                        <th>Gimimo data</th>
					                        <th>Gimimo šalis</th>
					                        <th>Įmitimas</th>
					                        <th>Gyvas svoris</th>
					                        <th>Įskait. svoris</th>
					                        <th>EUR/kg</th>
					                        <th>Pardavėjas</th>
					                        <th>Veiksmai</th>
					                    </tr>
					                </thead>
					                <tbody>
					                	@foreach($animals as $animal)
						                	<tr role="row">
						                		<td>{{ $animal->animal_id }}</td>
						                		<td>@if($animal->passport_id){{ $animal->passport_id }}@else <span>-</span>@endif</td>
						                		<td>@if($animal->sex){{ $animal->sex }}@else <span>-</span>@endif</td>
						                		<td>{{ $animal->breed }}</td>
						                		<td>{{ $animal->dob }}</td>
						                		<td>{{ $animal->cob }}</td>
						                		<td>
						                			@if($animal->inclination == 0)
						                				{{ trans('adminlte_lang::message.inclinationByCarcase') }}
						                			@else
						                				{{ $animal->inclination }}
						                			@endif
						                		</td>
						                		<td>{{ $animal->real_weight }}</td>
						                		<td>{{ $animal->includable_weight }}</td>
						                		<td>{{ $animal->price_kg }} @if(!empty($animal->price_kg))€@endif</td>
						                		<td>{{ $animal->seller()->first()->name }}</td>
						                		<td>
						                			<a href="{{ url('animals/'. $animal->id .'/edit') }}" class="btn btn-sm btn-primary">Redaguoti</a>
						                			<a href="{{ url('animals/'. $animal->id) }}" data-id="{{ $animal->id }}" class="btn btn-sm btn-danger button-delete">Ištrinti</a>
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
					            	{{ $animals->links() }}
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
          <form action="{{ url('animals') }}" method="GET">
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
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
@endsection

@section('custom-css')
	@media all and (max-width: 991px) {
		.table-responsive-row td:nth-of-type(1):before {
			content: 'ID Nr.';
		}
		.table-responsive-row td:nth-of-type(2):before {
			content: 'Paso Nr.';
		}
		.table-responsive-row td:nth-of-type(3):before {
			content: 'Rūšis';
		}
		.table-responsive-row td:nth-of-type(4):before {
			content: 'Veislė';
		}
		.table-responsive-row td:nth-of-type(5):before {
			content: 'Gimimo data';
		}
		.table-responsive-row td:nth-of-type(6):before {
			content: 'Gimimo šalis';
		}
		.table-responsive-row td:nth-of-type(7):before {
			content: 'Įmitimas';
		}
		.table-responsive-row td:nth-of-type(8):before {
			content: 'Gyvas svoris';
		}
		.table-responsive-row td:nth-of-type(9):before {
			content: 'Įskait. svoris';
		}
		.table-responsive-row td:nth-of-type(10):before {
			content: 'Eur/kg';
		}
		.table-responsive-row td:nth-of-type(11):before {
			content: 'Pardavėjas';
		}
	}
@endsection
