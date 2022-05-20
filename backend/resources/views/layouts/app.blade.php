<html lang="{{ config('app.locale') }}">
<head>
    <title>@yield('title')</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css"
          integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"
            integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"
                integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd"
                crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<body class="bg-grey">
<div class="container bg-white border-grey">
    <div class="sidebar full-height col-md-3">
        @include('components.sidebar')
    </div>
    <div class="content col-md-9">
        <h1>
            @yield('title')
            @yield('button')
        </h1>
        <div class="col-md-12 mt-20 pr-zero">
            @include('components.errors')
            @yield('content')
        </div>
    </div>
</div>
</body>
<script>
    $('.delete').click(function (e) {
        e.preventDefault()
        if (confirm('{{__('texts.confirm_delete')}}')) {
            $(e.target).closest('form').submit()
        }
    });

    $('.select2').select2();
</script>
</html>