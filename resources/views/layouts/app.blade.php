<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

				<link rel="icon" type="image/vnd.microsoft.icon" href="/shinsei2/public/img/favicon.ico">
				<title>{{ config('app.name', 'Laravel2') }}</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="/shinsei2/public/css/app.css">

        <!-- Scripts -->
        <script src="/shinsei2/public/js/app.js" defer></script>
        {{ $head }}

    </head>
    <body class="font-sans antialiased">
        <div id="wrap" class="{{$style}}">
            @include('layouts.nav')

            <!-- Page Heading -->
            <!-- <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">


                </div>
            </header>
            -->

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
