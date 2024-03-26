<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts/header')
</head>
<body>
    selamat datang {{$nama}}
    <hr>
    @yield('konten')
    <hr>
    @include('layouts/footer')    
</body>
</html>