<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    @include('includes.style')
</head>
<body class="g-sidenav-show  bg-gray-100">
    @include('includes.sidebar')

    {{-- @include('includes.navbar') --}}
    
    @yield('content')

    @include('includes.script')
    

</body>
</html>
