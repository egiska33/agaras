@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.drivers') }}
@endsection

@section('main-content')
	<div class="container spark-screen">
		<div class="row">
			<div class="col-md-12">

				<!-- Default box -->
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title"><i class="fa fa-truck" aria-hidden="true"></i> {{ trans('adminlte_lang::message.drivers') }}</h3>
					</div>
					<div class="box-body">
		              <div class="dataTables_wrapper form-inline dt-bootstrap">
					    <div class="row">
					    	<div class="col-xs-12 col-sm-5 col-md-6">
						    	<a href="{{ url('drivers/create') }}" class="btn btn-primary btn-sm margin-bottom"><i class='fa fa-plus'></i> {{ trans('adminlte_lang::message.add_new')}}</a>
					    	</div>
					    </div>
					    <div class="row">
					        <div class="col-sm-12">
					            <table class="table table-bordered dataTable table-striped table-responsive-row" role="grid">
					                <thead>
					                    <tr role="row">
					                        <th>Vardas, Pavardė</th>
					                        <th>El. paštas</th>
					                        <th>Pareigos</th>
					                        <th>Mob. nr.</th>
					                        <th>Automobilio valst. nr.</th>
					                        <th>Veiksmai</th>
					                    </tr>
					                </thead>
					                <tbody>
					                	@foreach($drivers as $driver)
					                		<tr role="row">
					                			<td>{{ $driver->name }}</td>
					                			<td>{{ $driver->email }}</td>
					                			<td>{{ $driver->position }}</td>
					                			<td>{{ $driver->phone }}</td>
					                			<td>{{ $driver->plate }}</td>
					                			<td>
					                				<a href="{{ url('drivers/'. $driver->id .'/edit') }}" class="btn btn-sm btn-primary">Redaguoti</a>
						                			<a href="{{ url('drivers/'. $driver->id) }}" data-id="{{ $driver->id }}" class="btn btn-sm btn-danger button-delete">Ištrinti</a>
					                			</td>
					                		</tr>
					                	@endforeach
					                </tbody>
					            </table>
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
@endsection

@section('custom-css')
	@media all and (max-width: 991px) {
		.table-responsive-row td:nth-of-type(1):before {
			content: 'Vardas, Pavardė';
		}
		.table-responsive-row td:nth-of-type(2):before {
			content: 'Pareigos';
		}
		.table-responsive-row td:nth-of-type(3):before {
			content: 'El. paštas';
		}
		.table-responsive-row td:nth-of-type(4):before {
			content: 'Mob. Nr.';
		}
		.table-responsive-row td:nth-of-type(5):before {
			content: 'Automobilio valst. nr.';
		}
	}
@endsection
