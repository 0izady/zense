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
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Vazirmatn&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Lalezar&display=swap" rel="stylesheet" />
        <link rel="icon" href="/img/azar.png" type="image/gif" sizes="16x16">
        <style>
            body, div,input,p,h1,h2,h3,h4,h5,h6,head,header,template,nav,i{
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
