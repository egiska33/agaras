@extends('adminlte::layouts.app-offline')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.documents') }}
@endsection

@section('main-content')
	<documents-index></documents-index>
@endsection

@section('custom-css')
	.sellerIdInput:checked ~ input{
		display: block !important;
	}

	@media all and (min-width: 991px){
		.forceHiddenDesktop{
			display: none;
		}
	}

	@media all and (max-width: 991px) {
		.dataTable{
			width: 100%;
		}

		.printSelectedBtn{
			white-space: pre-wrap;
		}

		.dataTable tbody tr{
			display: flex;
			flex-wrap: wrap;
		}

		.dataTable tbody td:nth-child(odd)
		{
			text-align: right !important;
		}

		.dataTable tbody td{
			display: inline-block !important;
			padding: 8px !important;
			width: 50% !important;
			text-overflow: unset;
		}
	}
@endsection
