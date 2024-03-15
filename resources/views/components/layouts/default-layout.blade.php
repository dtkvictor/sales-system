<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta name='author' content='Victor Lucas Rodrigues'>
        <meta name='description' content='Sales system with laravel'>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
              rel="stylesheet" 
              integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
              crossorigin="anonymous"
        >
        <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
        <link href="{{asset('assets/material-icons/iconfont/material-icons.css')}}" rel="stylesheet">
        <title>{{ $title }}</title>
    </head>

    <body translate="no">
        <x-layouts.partials.header></x-layouts.partials.header>
        <x-layouts.partials.container>
            {{ $slot }}
        </x-layouts.partials.container>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
                integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" 
                crossorigin="anonymous">
        </script>
        <script type="module" src="{{asset('assets/js/main.js')}}"></script>
        @stack('scripts')
    </body>
</html>