<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description"
        content=" بصمة الاهتمام للاتصالات  ">
    <meta name="keywords"
        content=" بصمة الاهتمام للاتصالات ">
    <meta name="author" content="Mohamed Ramadan +201011642731">
    <title> @yield('title')
    </title>
    <link rel="apple-touch-icon" href="{{ asset('assets/dashboard/') }}/images/logo_mobile.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/dashboard/') }}/images/logo_mobile.png">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
        rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/') }}/css-rtl/vendors.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/') }}/css-rtl/app.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/') }}/css-rtl/custom-rtl.css">
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/dashboard/') }}/css-rtl/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/') }}/css-rtl/core/colors/palette-gradient.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style-rtl.css">
   @yield('css')
    @toastifyCss
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

        // 3. معالجة خطأ 419 في طلبات Fetch العادية (مثل الألعاب)
        const { fetch: originalFetch } = window;
        window.fetch = async (...args) => {
            let response = await originalFetch(...args);
            if (response.status === 419) {
                // إذا حدث خطأ 419، نقوم بتحديث الصفحة فوراً
                location.reload();
            }
            return response;
        };
    </script>
</head>
<body class="vertical-layout vertical-menu 2-columns menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu" data-col="2-columns">
  <!-- fixed-top-->
