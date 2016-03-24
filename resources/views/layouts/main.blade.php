<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="_token" content="{!! csrf_token() !!}"/>

    <title>Postize</title>

    <link href="{{ asset('assets/front/css/style.css') }}" rel="stylesheet" type="text/css">
    <script>window.twttr = (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0],
        t = window.twttr || {};
        if (d.getElementById(id)) return t;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://platform.twitter.com/widgets.js";
        fjs.parentNode.insertBefore(js, fjs);

        t._e = [];
        t.ready = function(f) {
            t._e.push(f);
        };

        return t;
    }(document, "script", "twitter-wjs"));</script>
</head>

<body>
    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.5&appId=204647506244821";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

    <?php $f = 'assets/front/svg/shapes.svg'; if (file_exists($f)) { include($f); } ?>
    
    @include('partials.header')

    @if ( $page == 'post' )

    @include('partials.header-post')

    @endif

    @include('partials.mobile-menu')
    
    <main class="site">
        <div class="container wrapper">

            @yield('content')

        </div>

        @include('partials.footer')
    </main>

    <div class="go-top"><svg><use xlink:href="#svg-arrow"></use></svg></span></div>

    <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="{{ asset('assets/front/js/scripts.js') }}"></script>
</body>
</html>