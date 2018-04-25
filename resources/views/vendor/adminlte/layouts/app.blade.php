<!DOCTYPE html>
<html lang="lt">

@section('htmlheader')
    @include('adminlte::layouts.partials.htmlheader')
@show

<body class="skin-blue layout-top-nav">
<div id="app">
    <div class="wrapper">
        @include('adminlte::layouts.partials.mainheader')
        
        <div class="content-wrapper">
            @include('adminlte::layouts.partials.contentheader')

            <section class="content">
                @yield('main-content')
            </section>
        </div>

        @include('adminlte::layouts.partials.footer')

    </div>
</div>
@section('scripts')
    @include('adminlte::layouts.partials.scripts')
@show

</body>
</html>
