@extends('adminlte::layouts.app-offline')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.faq') }}
@endsection

@section('main-content')
	<documents-faq></documents-faq>
@endsection
