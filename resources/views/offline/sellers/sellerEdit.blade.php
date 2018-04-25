@extends('adminlte::layouts.app-offline')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.editSeller') }}
@endsection

@section('main-content')
	<sellers-edit></sellers-edit>
@endsection

@section('custom_js')
	<script type="text/javascript">
		$(document).ready(function() {

			if($('.other-input').val() != '') {
				$('#other-checkbox').val($('.other-input').val());
			}

			$('input[name=isSameAddress]').click(function() {
				if($(this).is(':checked')) {
					$('input[name=pick_up_address]').val($('input[name=address]').val());
				} else {
					$('input[name=pick_up_address]').val('');
				}
			});

			$('.other-input').keyup(function() {
				if($(this).val() != '') {
					$('#other-checkbox').attr('checked', true).val($(this).val());
				} else {
					$('#other-checkbox').attr('checked', false).val('');
				}
			});
		});
	</script>
@endsection
