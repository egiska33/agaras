@extends('adminlte::layouts.app-offline')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.createAnimal') }}
@endsection

@section('main-content')
	<animals-create></animals-create>
@endsection
