<!DOCTYPE html>
<html lang="en">

<head>
    <title> @yield('meta_title', $title ?? '') | {{ config('app.name') }} </title>

    <meta charset="UTF-8" />
    <meta name="author" content="Box Store">
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0">
    <meta name="description" content="@yield('description', $description ?? '')">
    <title>{{ $title ?? '' }} | {{ config('app.name') }}</title>

    @include('frontend.layouts.css')
    {{ $links ?? '' }}

</head>

<body class="font-sans antialiased">

    <div class="min-h-screen bg-gray-100">
        <x-frontend.components.nav-bar />

        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{ $preJs ?? '' }}

    <x-notify-component />
    @include('frontend.layouts.js')
</body>

</html>
