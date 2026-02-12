<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8" />
    <title>Inforce Tracker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />

    @yield('style')
    @include('layouts.style')
    @include('layouts.sidestyle')

</head>

<body data-layout="detached" data-topbar="colored">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <div class="container-fluid">
        <div id="layout-wrapper">
            @include('layouts.header')


            <div class="main-content">

                <div class="page-content">
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="page-title mb-0 font-size-18">
                                    <a class="text-white" >Dashboard</a>
                                </h4>

                                <h4 class="page-title mb-0 font-size-18">
                                    <a class="text-white" >Master API</a>
                                </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item active">INFORCE TRACKER</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    @yield('content')
                </div>

                <footer class="footer">
                    @include('layouts.footer')
                </footer>
            </div>
        </div>
    </div>

    @include('layouts.script')
    @include('layouts.sidescript')
    @yield('script')

    @if ($message = Session::get('success'))
    @include('components.flashdatasuccess', ['message' => Session::get('success')])
    @endif

    @if ($message = Session::get('error'))
    @include('components.flashdatafailed', ['message' => Session::get('error')])
    @endif

</body>

</html>