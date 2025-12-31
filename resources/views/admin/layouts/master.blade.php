<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>
            @yield('title') | Tree Bank | Admin Panel
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link rel="shortcut icon" href="{{asset('admin/assets/images/favicon.ico') }}">
        <link href="{{asset('admin/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style"/>
        <link href="{{asset('admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <script src="{{asset('admin/assets/js/head.js') }}"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        @stack('styles')
    </head>
    <body data-layout-mode="default" data-theme="light" data-topbar-color="dark" data-menu-position="fixed" data-leftbar-color="light" data-leftbar-size='default' data-sidebar-user='false'>
        <div id="wrapper">
            @include('admin.layouts.topNavBar')
            @include('admin.layouts.leftBar')
            <main>
                @yield('content')
            </main>
            @include('admin.layouts.footer')
        </div>
        @include('admin.layouts.rightBar')
        <div class="rightbar-overlay"></div>
        <script src="{{asset('admin/assets/js/vendor.min.js') }}"></script>
        <script src="{{asset('admin/assets/libs/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
        <script src="{{asset('admin/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
        <script src="{{asset('admin/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js') }}"></script>
        <script src="{{asset('admin/assets/js/pages/dashboard-2.init.js') }}"></script>
        <script src="{{asset('admin/assets/js/app.min.js') }}"></script>
        @stack('scripts')
    </body>
</html>