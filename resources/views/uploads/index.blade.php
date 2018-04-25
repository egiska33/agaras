@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.uploads') }}
@endsection

@section('main-content')
	<div class="container spark-screen">
		<div class="row">
			<div class="col-md-12">
				<!-- Default box -->
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title"><i class="fa fa-arrow-up" aria-hidden="true"></i> {{ trans('adminlte_lang::message.uploads') }}</h3>
					</div>
					<div class="box-body">
					    <div class="row">
					        <div class="col-xs-12 col-md-6">
					        	<form method="POST" enctype="multipart/form-data">
					        		{{ csrf_field() }}
					        		<div class="form-group">
										<label>{{ trans('adminlte_lang::message.addFile') }}</label>
										<input type="file" name="file" class="form-control">
					                </div>
					                <button type="submit" class="btn btn-block btn-primary">{{ trans('adminlte_lang::message.upload') }}</button>
					        	</form>
					        </div>
					    </div>
					    <div class="row">
					        <div class="col-xs-12 col-md-6" style="padding-top: 20px;">
					        	@if(File::exists(\App\File::GLOBAL_FILE_PATH))
					        		<a href="{{ url(\App\File::GLOBAL_FILE_PATH) }}">{{ trans('adminlte_lang::message.file') }}</a>
					        		<button 
					        			onclick="del();"
					        			class="btn btn-xs btn-danger"
					        		>
					        			<i class="fa fa-trash" aria-hidden="true"></i>
					        		</button>
					        	@else
					        		<p class="text-warning">{{ trans('adminlte_lang::message.doesntExist') }}</p>
					        	@endif
					        </div>
					    </div>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->

			</div>
		</div>
	</div>
	@if(File::exists(\App\File::GLOBAL_FILE_PATH))
		<script type="text/javascript">
			function del() {
				var link = "{{ url('uploads/files/delete') }}";
				var msg = "{{ trans('adminlte_lang::message.areYouSure') }}";
				if(confirm(msg)) {
					location.href = link;
				}
			}
		</script>
	@endif
@endsection
