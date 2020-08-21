<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script type="text/javascript">
            window.Laravel = { csrfToken: '{{ csrf_token() }}' }
        </script>

        <title>Blog Test</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,500,700,400italic|Material+Icons">

        <link href="/css/app.css" rel="stylesheet" type="text/css">

        <!-- Styles -->
    </head>
    <body>
     <div class="content" id="app">
         <app></app>

     </div>

    <script type="text/javascript" src="/js/app.js"></script>
    </body>
</html>
