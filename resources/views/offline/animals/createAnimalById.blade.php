@extends('adminlte::layouts.app-offline')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.createAnimalById') }}
@endsection

@section('main-content')
	<animals-insert-id></animals-insert-id>
@endsection
