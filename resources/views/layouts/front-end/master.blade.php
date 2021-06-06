<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.common.icon')
    <title>@yield('title')</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="syful.cse.bd@gmail.com" />


    @stack('styles')

    @livewireStyles

</head>

<body>
    {{-- <!-- ======= Header ======= --> --}}
    @include('layouts.front-end.navbar')
    {{-- <!-- End Header --> --}}


    @yield('content')

    {{-- <!-- ======= Footer ======= --> --}}
    @include('layouts.front-end.footer')

   
    {{-- Tostar + Sweetalert 2 --}}
    <script src="{{ asset('all-assets/common/sweet-alert-2/sw-alert.js') }}" type="text/javascript"></script>



    <script>
        //For active menu highlite
        $(function () {
            // this will get the full URL at the address bar
            var url = window.location.href;

            // passes on every "a" tag
            $(".nav-menu a").each(function () {
                // checks if its the same on the address bar
                if (url == (this.href)) {
                    $(this).closest("li").addClass("active");
                    //for making parent of submenu active
                    //$(this).closest("li").parent().parent().addClass("pcoded-trigger");
                    //$(this).closest("ul").show();
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
