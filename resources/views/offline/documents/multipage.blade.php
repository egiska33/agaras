<!DOCTYPE html>
<html>

    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
        <link href="{{ mix('/css/all.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/print.css')}}">
    </head>

    <body>
    	@foreach($pages as $page)
			<div style="page-break-after: always; page-break-inside: avoid;">
			    {!! $page !!}
			</div>
		@endforeach
        <!-- ./page-wrap -->

    </body>
</html>