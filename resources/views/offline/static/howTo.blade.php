@extends('adminlte::layouts.app-offline')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.how_to_use') }}
@endsection

@section('main-content')
	<documents-how-to></documents-how-to>
@endsection
