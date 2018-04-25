@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.createAnimalById') }}
@endsection

@section('main-content')
	<div class="container spark-screen">
		<div class="row">
			<div class="col-xs-12 col-md-6 col-md-offset-3">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">{{ trans('adminlte_lang::message.createAnimalById') }}</h3>
					</div>
					<form>
						<div class="box-body">
			                <div class="form-group">
								<label>{{ trans('adminlte_lang::message.insertAnimalId') }} <sup>*</sup></label>
								<input type="text" class="form-control" name="animal_id">
			                </div>
						</div>
						<!-- /.box-body -->
						<div class="box-footer">
							<button type="submit" class="btn btn-primary">{{ trans('adminlte_lang::message.add') }}</button>
						</div>
						<!-- /.box-footer -->
					</form>
				</div>
				<!-- /.box -->

			</div>
		</div>
	</div>
@endsection
