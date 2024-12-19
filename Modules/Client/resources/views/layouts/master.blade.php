<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description"
        content="Kenne is a stunning html template for an expansion eCommerce site that suitable for any kind of fashion store. It will make your online store look more impressive and attractive to viewers. ">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('theme/client/images/favicon.png') }}">

    @include('client::assets.links.css-links')
</head>

<body class="template-color-1">

    <div class="main-wrapper">

        <!-- Begin Main Header Area -->
        @include('client::layouts.header-main')
        <!-- Main Header Area End Here -->

        {{-- MAIN CONTENTS --}}
        @yield('contents')
        {{-- END MAIN CONTENTS --}}

        <!-- Begin Kenne's Footer Area -->
        @include('client::layouts.footer')
        <!-- Kenne's Footer Area End Here -->
        <!-- Scroll To Top Start -->
        <a class="scroll-to-top" href="#"><i class="ion-chevron-up"></i></a>
        <!-- Scroll To Top End -->

    </div>

    @include('client::assets.links.js-links')
</body>

</html>
