@extends('adminlte::layouts.app-offline')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.createAnimal') }}
@endsection

@section('main-content')
	<animals-create-by-id></animals-create-by-id>
@endsection
