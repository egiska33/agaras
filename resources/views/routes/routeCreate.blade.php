@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.createRoute') }}
@endsection

@section('main-content')
	<div class="container spark-screen">
		<div class="row">
			<div class="col-xs-12 col-md-6 col-md-offset-3">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">{{ trans('adminlte_lang::message.createRoute') }}</h3>
					</div>
					<form action="{{ url('routes') }}" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="box-body">
							<div class="form-group">
								<label>{{ trans('adminlte_lang::message.driver') }} <sup>*</sup></label>
								<select class="form-control" name="user_id">
									<option value="-">-</option>
									@foreach($drivers as $driver)
										<option value="{{ $driver->id }}" @if(old('driver')==$driver->id)selected="selected"@endif>{{ $driver->name }}</option>
									@endforeach
								</select>
			                </div>
			                <div class="form-group">
								<label>{{ trans('adminlte_lang::message.pickUpTime') }} <sup>*</sup></label>
								<input type="text" class="datepicker form-control" name="pick_up_time" value="{{ \Carbon\Carbon::parse(old('pick_up_time'))->format('Y-m-d') }}" data-date="{{ \Carbon\Carbon::parse(old('pick_up_time'))->format('Y-m-d') }}" />
			                </div>
			                <div class="form-group">
								<label>{{ trans('adminlte_lang::message.seller') }} <sup>*</sup></label>
								<input type="text" class="form-control" name="name" value="{{ old('name') }}">
			                </div>
			                <div class="form-group">
								<label>{{ trans('adminlte_lang::message.sellerAddress') }} <sup>*</sup></label>
								<input type="text" class="form-control" name="seller_address" value="{{ old('seller_address') }}">
			                </div>
			                <div class="form-group">
								<label>{{ trans('adminlte_lang::message.sellerNumber') }} <sup>*</sup></label>
								<input type="text" class="form-control" name="phone" value="{{ old('phone') }}">
			                </div>
			                <div class="form-group">
								<label>{{ trans('adminlte_lang::message.animalsNumber') }} <sup>*</sup></label>
								<input type="text" class="form-control" name="total_animals" value="{{ old('total_animals') }}">
			                </div>
			                <div class="form-group">
								<label>{{ trans('adminlte_lang::message.comment') }} </label>
								<textarea class="form-control" rows="3" name="comment">@if(old('total_animals') != NULL ){{ old('total_animals') }}@endif</textarea>
			                </div>
			                <div class="form-group">
								<label>{{ trans('adminlte_lang::message.addFile') }}</label>
								<input type="file" name="file">
			                </div>
						</div>
						<!-- /.box-body -->
						<div class="box-footer">
							<button type="submit" class="btn btn-block btn-primary">{{ trans('adminlte_lang::message.create') }}</button>
						</div>
						<!-- /.box-footer -->
					</form>
				</div>
				<!-- /.box -->

			</div>
		</div>
	</div>
@endsection
