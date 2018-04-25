<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <title> @yield('htmlheader_title', 'Your title here') </title>
        <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
        {{-- <link href="{{ mix('/css/all.css') }}" rel="stylesheet" type="text/css" /> --}}
        <link href='/css/offline-print.css' rel='stylesheet' class="gaidys">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token()]); ?></script>
        <style>
            body{
                background-color: transparent;
            }
        </style>
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
        <script src='/js/html2pdf.js'></script>
        <script src="/js/app.js" type="text/javascript"></script>
        <script src="/js/from_html.js" type="text/javascript"></script>
        <script src="/js/split_text_to_size.js" type="text/javascript"></script>
        <script src="/js/standard_fonts_metrics.js" type="text/javascript"></script>
    </body>
</html>
