
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <title inertia>{{ config('app.name', 'Laravel') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Scripts -->
        @routes
        @viteReactRefresh
        @vite(['resources/js/app(react).jsx'])
        <link rel="shortcut icon" href="{{asset('admin/assets/images/favicon.ico') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>
            window.flashSuccess = @json(session('success'));
        </script>
        {{-- @inertiaHead --}}
    </head>
    <body style="background-color: #f9fff9">
        <div id="root"></div>
    </body>
</html>
