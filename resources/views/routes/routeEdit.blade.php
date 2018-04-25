@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.editRoute') }}
@endsection

@section('main-content')
	<div class="container spark-screen">
		<div class="row">
			<div class="col-xs-12 col-md-6 col-md-offset-3">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">{{ trans('adminlte_lang::message.editRoute') }}</h3>
					</div>
					<form action="{{ url('routes/'. $route->id) }}" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						{{ method_field('PUT') }}
						<div class="box-body">
							<div class="form-group">
								<label>{{ trans('adminlte_lang::message.driver') }} <sup>*</sup></label>
								<select class="form-control" name="user_id">
									<option value="-">-</option>
									@foreach($drivers as $driver)
										<option value="{{ $driver->id }}" @if($driver->id == $route->user_id)selected="selected"@endif>{{ $driver->name }}</option>
									@endforeach
								</select>
			                </div>
			                <div class="form-group">
								<label>{{ trans('adminlte_lang::message.pickUpTime') }} <sup>*</sup></label>
								<input type="text" class="form-control datepicker" name="pick_up_time" value="{{ \Carbon\Carbon::parse($route->pick_up_time)->format('Y-m-d') }}">
			                </div>
			                <div class="form-group">
								<label>{{ trans('adminlte_lang::message.seller') }} <sup>*</sup></label>
								<input type="text" class="form-control" name="name" value="{{ $route->name }}">
			                </div>
			                <div class="form-group">
								<label>{{ trans('adminlte_lang::message.sellerAddress') }} <sup>*</sup></label>
								<input type="text" class="form-control" name="seller_address" value="{{ $route->seller_address }}">
			                </div>
			                <div class="form-group">
								<label>{{ trans('adminlte_lang::message.sellerNumber') }} <sup>*</sup></label>
								<input type="text" class="form-control" name="phone" value="{{ $route->phone }}">
			                </div>
			                <div class="form-group">
								<label>{{ trans('adminlte_lang::message.animalsNumber') }} <sup>*</sup></label>
								<input type="text" class="form-control" name="total_animals" value="{{ $route->total_animals }}">
			                </div>
			                <div class="form-group">
								<label>{{ trans('adminlte_lang::message.comment') }} </label>
								<textarea class="form-control" rows="3" name="comment">{{ $route->comment }}</textarea>
			                </div>
			                <div class="form-group">
								<label>{{ trans('adminlte_lang::message.addFile') }}</label>
								<input type="file" name="file">
			                </div>
						</div>
						<!-- /.box-body -->
						<div class="box-footer">
							<button type="submit" class="btn btn-block btn-primary">{{ trans('adminlte_lang::message.save') }}</button>
						</div>
						<!-- /.box-footer -->
					</form>
				</div>
				<!-- /.box -->

			</div>
		</div>
	</div>
@endsection
