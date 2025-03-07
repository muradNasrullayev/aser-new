<!DOCTYPE html>
<html lang="{{App::getLocale()}}">
<head>
    @include('web.includes.meta')
    @include('web.includes.styles')
    @yield('styles1')
    @yield('styles')
    @yield('styles2')
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
@include('web.includes.header')
{{--@include('web.includes.navbar')--}}

@yield('content')
@include('web.includes.footer')
@include('web.includes.scripts')
@yield('scripts')
@yield('scripts1')
</body>
</html>
