@extends('adminlte::layouts.app-offline')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.docs_explanation') }}
@endsection

@section('main-content')
	<documents-explanation></documents-explanation>
@endsection
