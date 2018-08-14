<!-- Stored in resources/views/layouts/ehs.blade.php -->

<html>
    <head>
        <title>EHS - @yield('title')</title>
    </head>
    <body>
        @foreach ($notifies as $notify)
            <div class="notify_{{ $notify->type }}">
                {{ $notify->message }}
            </div>
        @endforeach

        <div class="container">
            @yield('content')
        </div>
    </body>
</html>
