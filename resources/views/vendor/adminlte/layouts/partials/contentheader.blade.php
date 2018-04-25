<!-- Content Header (Page header) -->
<section class="container content-header">

	@include('adminlte::layouts.partials.flash')
	
    <h1>
        @yield('contentheader_title', '')
        <small>@yield('contentheader_description')</small>
    </h1>
</section>