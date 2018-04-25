@extends('adminlte::layouts.app-offline')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.editAnimal') }}
@endsection

@section('main-content')
	<animals-edit></animals-edit>
@endsection
