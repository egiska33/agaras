@extends('adminlte::layouts.app-offline')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.createSeller') }}
@endsection

@section('main-content')
	<sellers-create></sellers-create>
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
