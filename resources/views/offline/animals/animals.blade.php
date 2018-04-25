@extends('adminlte::layouts.app-offline')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.animals') }}
@endsection

@section('main-content')
	<animals-index></animals-index>
@endsection

@section('custom-css')
	@media all and (max-width: 991px) {
		.table-responsive-row td:nth-of-type(1):before {
			content: 'ID Nr.';
		}
		.table-responsive-row td:nth-of-type(2):before {
			content: 'Paso Nr.';
		}
		.table-responsive-row td:nth-of-type(3):before {
			content: 'Rūšis';
		}
		.table-responsive-row td:nth-of-type(4):before {
			content: 'Veislė';
		}
		.table-responsive-row td:nth-of-type(5):before {
			content: 'Gimimo data';
		}
		.table-responsive-row td:nth-of-type(6):before {
			content: 'Gimimo šalis';
		}
		.table-responsive-row td:nth-of-type(7):before {
			content: 'Įmitimas';
		}
		.table-responsive-row td:nth-of-type(8):before {
			content: 'Gyvas svoris';
		}
		.table-responsive-row td:nth-of-type(9):before {
			content: 'Įskait. svoris';
		}
		.table-responsive-row td:nth-of-type(10):before {
			content: 'Eur/kg';
		}
		.table-responsive-row td:nth-of-type(11):before {
			content: 'Pardavėjas';
		}
	}
@endsection
