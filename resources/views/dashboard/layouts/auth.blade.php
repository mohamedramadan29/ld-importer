<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="@if (Config::get('app.locale') == 'ar') rtl @else ltr @endif">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content=" Ld Importer  ">
    <meta name="keywords" content=" Ld Importer ">
    <meta name="author" content="Mohamed Ramadan +201011642731">
    <title> الرئيسية | @yield('title')
    </title>
    <link rel="apple-touch-icon" href="{{ asset('assets/dashboard') }}/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/dashboard') }}/images/ico/favicon.ico">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
        rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/css-rtl/vendors.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/vendors/css/forms/icheck/custom.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/css-rtl/app.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/css-rtl/custom-rtl.css">
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/dashboard') }}/css-rtl/core/menu/menu-types/vertical-menu-modern.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/css-rtl/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/css-rtl/pages/login-register.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/style-rtl.css">
    <!-- END Custom CSS-->
    <script>
        // الحل الجذري: الحفاظ على الجلسة نشطة ومنع ظهور 419

        // 1. تحديث الجلسة كل 5 دقائق لمنع انتهاء الصلاحية أثناء اللعب
        setInterval(() => {
            fetch('/up').catch(() => {});
        }, 300000); // 5 دقائق

        // 2. معالجة خطأ 419 في طلبات Livewire
        document.addEventListener('livewire:init', () => {
            Livewire.hook('request', ({ fail }) => {
                fail(({ status, preventDefault }) => {
                    if (status === 419) {
                        location.reload();
                        preventDefault();
                    }
                });
            });
        });

        // 3. معالجة خطأ 419 في طلبات Fetch العادية
        const { fetch: originalFetch } = window;
        window.fetch = async (...args) => {
            let response = await originalFetch(...args);
            if (response.status === 419) {
                location.reload();
            }
            return response;
        };
    </script>
</head>

<body class="vertical-layout vertical-menu-modern 1-column bg-cyan bg-lighten-2 menu-expanded fixed-navbar"
    data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    <!-- fixed-top-->
    <nav
        class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-dark navbar-shadow">
        <div class="navbar-wrapper">
            <div class="navbar-header">
                <ul class="flex-row nav navbar-nav">
                    <li class="mr-auto nav-item mobile-menu d-md-none"><a
                            class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                                class="ft-menu font-large-1"></i></a></li>
                    <li class="nav-item">
                        <a class="navbar-brand" href="#">

                            <h3 class="brand-text">  Ld Importer  </h3>
                        </a>
                    </li>
                    <li class="nav-item d-md-none">
                        <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i
                                class="la la-ellipsis-v"></i></a>
                    </li>
                </ul>
            </div>
            <div class="navbar-container">
                <div class="collapse navbar-collapse justify-content-end" id="navbar-mobile">
                    <ul class="nav navbar-nav">

                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    @yield('content')

    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <footer class="footer fixed-bottom footer-dark navbar-border navbar-shadow">
        <p class="clearfix px-2 mb-0 blue-grey lighten-2 text-sm-center">
            <span class="float-md-left d-block d-md-inline-block">جميع الحقوق محفوظة &copy; {{ date("Y") }} <a
                    class="text-bold-800 grey darken-2" href="#" target="_blank"> </span>
        </p>
    </footer>
    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset('assets/dashboard') }}/vendors/js/vendors.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{ asset('assets/dashboard') }}/vendors/js/forms/validation/jqBootstrapValidation.js" type="text/javascript">
    </script>
    <script src="{{ asset('assets/dashboard') }}/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN MODERN JS-->
    <script src="{{ asset('assets/dashboard') }}/js/core/app-menu.js" type="text/javascript"></script>
    <script src="{{ asset('assets/dashboard') }}/js/core/app.js" type="text/javascript"></script>
    <script src="{{ asset('assets/dashboard') }}/js/scripts/customizer.js" type="text/javascript"></script>
    <!-- END MODERN JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ asset('assets/dashboard') }}/js/scripts/forms/form-login-register.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
    {!! NoCaptcha::renderJs() !!}
</body>

</html>
