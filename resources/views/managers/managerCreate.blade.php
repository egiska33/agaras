@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.createManager') }}
@endsection

@section('main-content')
	<div class="container spark-screen">
		<div class="row">
			<div class="col-xs-12 col-md-6 col-md-offset-3">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">{{ trans('adminlte_lang::message.createManager') }}</h3>
					</div>
					<form action="{{ url('/managers') }}" method="POST">
						<input type="hidden" name="_token" value="{{ csrf_token() }}" />
						<input type="hidden" class="form-control" name="plate" value="AAA000" />
						<div class="box-body">
							<div class="form-group">
								<label>{{ trans('adminlte_lang::message.email') }} <sup>*</sup></label>
		                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" />
		                    </div>
		                    <div class="form-group">
		                    	<label>{{ trans('adminlte_lang::message.password') }} <sup>*</sup></label>
		                        <input type="password" class="form-control" name="password" />
		                    </div>
		                    <div class="form-group">
		                    	<label>{{ trans('adminlte_lang::message.retypepassword') }} <sup>*</sup></label>
		                        <input type="password" class="form-control" name="password_confirmation" />
		                    </div>
							<div class="form-group">
								<label>{{ trans('adminlte_lang::message.managerName') }} <sup>*</sup></label>
								<input type="text" class="form-control" name="name" value="{{ old('name') }}" />
			                </div>
			                <div class="form-group">
								<label>{{ trans('adminlte_lang::message.driverPosition') }} <sup>*</sup></label>
								<input type="text" class="form-control" name="position" value="{{ old('position') }}" />
			                </div>
			                <div class="form-group">
								<label>{{ trans('adminlte_lang::message.driverPhone') }} <sup>*</sup></label>
								<input type="text" class="form-control" name="phone" value="{{ old('phone') }}" />
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
