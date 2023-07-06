<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="HandheldFriendly" content="true">

        <title inertia></title>
        <style>

        </style>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Vazirmatn&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Lalezar&display=swap" rel="stylesheet" />
        <link rel="icon" href="/img/azar.png" type="image/gif" sizes="16x16">

        <script src="https://kit.fontawesome.com/77d157578f.js" crossorigin="anonymous"></script>
        <style>
            * {
                font-family: Vazirmatn;
            }
        </style>
        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased" id="body">
        @inertia
    </body>
</html>
