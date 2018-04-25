<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <title> @yield('htmlheader_title', 'Your title here') </title>
        <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
        <link href="{{ mix('/css/all.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/print.css')}}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token()]); ?></script>
    </head>

    <body>
        <div id='app'>
            <div id="page-wrap">
                <div id='main-content'>
                    @yield('main-content')
                </div>
            </div>
        </div>
        <!-- ./page-wrap -->

        <script src="/js/app.js" type="text/javascript"></script>
    </body>
</html>
