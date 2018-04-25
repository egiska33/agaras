@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.createSeller') }}
@endsection

@section('main-content')
	{{-- <sellers-create></sellers-create> --}}

	<div class="container spark-screen">
		<div class="row">
			<div class="col-xs-12 col-md-6 col-md-offset-3">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">{{ trans('adminlte_lang::message.createSeller') }}</h3>
					</div>
					<form action="{{ url('sellers') }}" method="POST">
						<input type="hidden" name="_token" value="{{ csrf_token() }}" />
						<div class="box-body">
							<div class="form-group">
								<label>{{ trans('adminlte_lang::message.sellerName') }} <sup>*</sup></label>
								<input type="text" class="form-control" name="name" value="{{ old('name') }}">
			                </div>
			                <div class="form-group">
								<label>{{ trans('adminlte_lang::message.sellerCode') }} <sup>*</sup></label>
								<input type="text" class="form-control" name="code" value="{{ old('code') }}">
			                </div>
			                <div class="form-group">
								<label>{{ trans('adminlte_lang::message.sellerAddress') }} <sup>*</sup></label>
								<input type="text" class="form-control" name="address" value="{{ old('address') }}">
			                </div>
			                <div class="form-group">
								<label>
									{{ trans('adminlte_lang::message.sellerTakeAddress') }}
									<div class="checkbox inline">
					                  <label>
					                    <input type="checkbox" name="isSameAddress"> {{ trans('adminlte_lang::message.sellerSameAddress') }}
					                  </label>
					                </div>
								</label>
								<input type="text" class="form-control" name="pick_up_address" value="{{ old('pick_up_address') }}">
			                </div>
			                <div class="form-group">
								<label>{{ trans('adminlte_lang::message.vatNumber') }}</label>
								<input type="text" class="form-control" name="pvm_code" value="{{ old('pvm_code') }}">
			                </div>
			                <div class="form-group">
								<label>{{ trans('adminlte_lang::message.sellerPhone') }} <sup>*</sup></label>
			                	<div class="input-group">
									<div class="input-group-addon">
										+3706
									</div>
									<input type="text" class="form-control" name="phone" value="{{ old('phone') }}">
				                </div>
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

@section('custom_js')
	<script type="text/javascript">
		$(document).ready(function() {
			$('input[name="isSameAddress"]').click(function()
			{
				if($(this).is(':checked'))
				{
					$('input[name=pick_up_address]').val($('input[name="address"]').val());
				}
				else
				{
					$('input[name=pick_up_address]').val('');
				}
			});
		});
	</script>
@endsection
