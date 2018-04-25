@extends('adminlte::layouts.app-offline')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.sellers') }}
@endsection

@section('main-content')
	<sellers-index></sellers-index>
@endsection

@section('custom-css')
	@media all and (max-width: 991px) {
		.table-responsive-row td:nth-of-type(1):before {
			content: 'Pavadinimas';
		}
		.table-responsive-row td:nth-of-type(2):before {
			content: 'Kodas';
		}
		.table-responsive-row td:nth-of-type(3):before {
			content: 'Adresas';
		}
		.table-responsive-row td:nth-of-type(4):before {
			content: 'PVM kodas';
		}
		.table-responsive-row td:nth-of-type(5):before {
			content: 'Mob. nr.';
		}
		.table-responsive-row td:nth-of-type(6):before {
			content: 'PVM tarifas';
		}
		.table-responsive-row td:nth-of-type(7):before {
			content: 'Paimti gyv.';
		}
	}
@endsection
