    @include('Layouts.admin.header')

    <body class="sb-nav-fixed">
        @include('Layouts.admin.nav')
        <div id="layoutSidenav">
            @include('Layouts.admin.sidebar')
            <div id="layoutSidenav_content">
               {{-- @include('Layouts.admin.body') --}}
                @yield('content')
                @include('Layouts.admin.footer')
            </div>
        </div>

    </body>

    </html>