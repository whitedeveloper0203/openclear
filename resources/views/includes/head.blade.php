<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'OpenClear') }}</title>
<!-- <title>OpenClear</title> -->

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<!-- Main Font -->
<script src="{{ asset('js/libs/webfontloader.min.js') }}"></script>

<script>
    WebFont.load({
        google: {
            families: ['Roboto:300,400,500,700:latin']
        }
    });
</script>

<!-- Bootstrap CSS -->
<link rel="stylesheet" type="text/css" href="{{ asset('Bootstrap/dist/css/bootstrap-reboot.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('Bootstrap/dist/css/bootstrap.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('Bootstrap/dist/css/bootstrap-grid.css') }}">

<!-- Main Styles CSS -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/fonts.min.css') }}">

<script src="{{ asset('js/jQuery/jquery-3.4.1.js') }}"></script>
