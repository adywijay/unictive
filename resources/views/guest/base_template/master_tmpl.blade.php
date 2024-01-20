<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet"
        type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <script src="{{ asset('static/js/jquery-1.11.2.min.js') }}"></script>
    @include('guest.slice_layout.load_css')
    <title>{{ $capt }}</title>
</head>

<body class="theme-red">
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Loading page ...</p>
        </div>
    </div>
    <div class="overlay"></div>
    <nav class="navbar">
        <div class="container-fluid">
            @include('guest/slice_layout/top_nav')
            @yield('top_nav')
        </div>
    </nav>
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <div class="user-info">
                @include('guest/slice_layout/detail_user')
                @yield('detail_user')
            </div>
            <div class="menu">
                @include('guest/slice_layout/list_menu')
                @yield('list_menu')
            </div>
            <div class="legal">
                @include('guest/slice_layout/footer')
                @yield('footer')
            </div>
        </aside>
        <aside id="rightsidebar" class="right-sidebar">
            <!-- Optionals -->
        </aside>
    </section>

    <section class="content">
        <div class="container-fluid">
            @yield('content_list')
        </div>
    </section>
    @include('guest.slice_layout.load_js')
</body>

</html>
