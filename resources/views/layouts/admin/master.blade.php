<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.common.icon')
    <title>@yield('title')</title>
    {{-- <!-- Meta --> --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="syful.cse.bd@gmail.com" />

    {{-- <!-- fontawesome icon --> --}}
    <link rel="stylesheet" href="{{ asset('all-assets/common/fontawesom5.7/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('all-assets/admin/assets/plugins/animation/css/animate.min.css') }}">
    <link href="{{ asset('all-assets/common/bootstrap-4.5/css/bootstrap.min.css') }}" rel="stylesheet">
    {{-- <!-- vendor css --> --}}
    <link rel="stylesheet" href="{{ asset('all-assets/admin/assets/css/style-admin.css') }}">

    <style>
        .rotate {
            -webkit-transition: -webkit-transform .5s ease-in-out;
            transition: transform .5s ease-in-out;
        }
        .rotate:hover {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }

    </style>

    @stack('styles')

    @livewireStyles

</head>

<body>
    {{-- <!-- [ Pre-loader ] start --> --}}
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    {{-- <!-- [ Pre-loader ] End --> --}}

    {{-- <!-- [ navigation menu ] start --> --}}
    @include('layouts.admin.navbar')
    {{-- <!-- [ navigation menu ] end --> --}}

    {{-- <!-- [ Header ] start --> --}}
    <header class="navbar pcoded-header navbar-expand-lg navbar-light">
        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse1" href="#!"><span></span></a>
            <a href="{{ route('admin.index') }}" class="b-brand">
                <img src="{{ asset('all-assets/common/logo/cpb/cpb.png') }}" class="navbar-brand rotate" alt="CPB-Logo"
                    height="30">
                <span class="b-title">CPB-Admin</span>
            </a>
        </div>
        <a class="mobile-menu" id="mobile-header" href="#!">
            <i class="feather icon-more-horizontal"></i>
        </a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li><a href="#!" class="full-screen" onclick="javascript:toggleFullScreen()"><i
                            class="feather icon-maximize"></i></a></li>
            </ul>
            <ul class="navbar-nav">
                <h4 class="text-center">
                    <span class="badge badge-warning">
                        {{ Auth::user()->name }}
                    </span>
                </h4>
            </ul>

            <ul class="navbar-nav ml-auto">
                @auth
                <li>
                    <div class="dropdown drp-user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ asset('images/admin/small/'.Auth::user()->image) }}" height="30"
                                class="img-radius" alt="Profile-Image">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-notification">
                            <div class="pro-head">
                                <img src="{{ asset('images/admin/small/'.Auth::user()->image) }}" height="30"
                                    class="img-radius" alt="Profile-Image">
                                <span>{{ Auth::user()->name }}</span>
                                <a href="{{ route('logout') }}" class="dud-logout" title="Logout">
                                    <i class="feather icon-log-out"></i>
                                </a>
                            </div>
                            {{-- <ul class="pro-body">
                            <li><a href="#!" class="dropdown-item"><i class="feather icon-settings"></i> Settings</a></li>
                            <li><a href="#!" class="dropdown-item"><i class="feather icon-user"></i> Profile</a></li>
                            <li><a href="message.html" class="dropdown-item"><i class="feather icon-mail"></i> My Messages</a></li>
                            <li><a href="auth-signin.html" class="dropdown-item"><i class="feather icon-lock"></i> Lock Screen</a></li>
                            </ul> --}}
                        </div>
                    </div>
                </li>
                @endauth
            </ul>
        </div>
    </header>
    {{-- <!-- [ Header ] end --> --}}


    {{-- <!-- [ Main Content ] start --> --}}
    <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    {{-- <!-- [ breadcrumb ] start --> --}}

                    {{-- <!-- [ breadcrumb ] end --> --}}
                    <div class="main-body">
                        <div class="page-wrapper">
                            {{-- <!-- [ Main Content ] start --> --}}
                            <div class="row">
                                <div class="col-md-12">

                                    @yield('content')

                                </div>
                            </div>
                            {{-- <!-- [ Main Content ] end --> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <!-- [ Main Content ] end --> --}}



    {{-- <!-- Required Js --> --}}
    <script src="{{ asset('all-assets/admin/assets/js/vendor-all.js') }}" type="text/javascript"></script>
    <script src="{{ asset('all-assets/common/bootstrap-4.5/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('all-assets/admin/assets/js/pcoded.js') }}" type="text/javascript"></script>
    {{-- Tostar + Sweetalert 2 --}}
    <script src="{{ asset('all-assets/common/sweet-alert-2/sw-alert.js') }}" type="text/javascript"></script>


    <script>
        //For active menu highlite
        $(function () {
            // this will get the full URL at the address bar
            var url = window.location.href;

            // passes on every "a" tag
            $(".navbar-content a").each(function () {
                // checks if its the same on the address bar
                if (url == (this.href)) {
                    $(this).closest("li").addClass("active");
                    //for making parent of submenu active
                    $(this).closest("li").parent().parent().addClass("pcoded-trigger");
                    $(this).closest("ul").show();
                }
            });
        });

    </script>

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

        //Livewire toast
        window.addEventListener('toastMsg', event => {
            //console.log(event);
            Toast.fire({
                icon: event.detail.icon,
                title: event.detail.messege
            });
        });

    </script>





    @stack('scripts')


    @livewireScripts

</body>

</html>
