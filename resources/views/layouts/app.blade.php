<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name='csrf-token' content='{{ csrf_token() }}'>

    <title>Agenda @yield('title')</title>

    {{-- Neumorphism Library --}}
    <link rel="stylesheet" href="{{ asset('plugins/softui/neumorphism-ui.css') }}">
    {{-- Fontawesome Library --}}
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app.css') }}">
</head>
<body class="{{ $_COOKIE['theme'] ?? 'light-mode' }}">
    <button id="theme-btn" class="sul-btn top-btn">
        <i class="fas fa-adjust"></i>
    </button>
    @yield('content')

    <script src="{{ asset('plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('app.js') }}"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
    </script>
    @if (session('success'))
    <script>
        Toast.fire({
            icon: 'success',
            title: '{{ session('success') }}'
        })
    </script>
    @endif
    @if (session('error'))
        <script>
            Toast.fire({
                icon: 'error',
                title: '{{ session('error') }}'
            })
        </script>
    @endif
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                Toast.fire({
                    icon: 'error',
                    title: '{{ $error }}'
                })
            </script>
        @endforeach
    @endif

    @yield('scripts')
</body>
</html>
