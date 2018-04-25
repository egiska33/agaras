<!DOCTYPE html>
<html lang="lt">

    @section('htmlheader')
        @include('adminlte::layouts.partials.htmlheader')
    @show

    <body class="skin-blue layout-top-nav">
        <div id="app">
            <div class="wrapper">
                <div class='syncingScreen'><span class='glyphicon glyphicon-repeat rotating'></span></div>
                @include('adminlte::layouts.partials.offline-mainheader')

                <div class="content-wrapper">
                    @include('adminlte::layouts.partials.contentheader')

                    <section class="content" id='main-content'>
                        <div id="syncError"></div>

                        @yield('main-content')
                    </section>
                </div>

                @include('adminlte::layouts.partials.offline-footer')

            </div>
        </div>
        @section('scripts')
            @include('adminlte::layouts.partials.scripts')
        @show

    </body>
</html>
