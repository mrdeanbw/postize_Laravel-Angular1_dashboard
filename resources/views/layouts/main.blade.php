<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    @if(!empty($post))
        <title>{{ $post->title }}</title>
        <meta property="og:title" content="{{ $post->title }}">
    @elseif(!empty($category))
        <title>{{ config('custom.app-name') }} - {{ $category->name }}</title>
        <meta property="og:title" content="{{ config('custom.app-name') }} - {{ $category->name }}">
    @else
        <title>{{ config('custom.app-name') }} - {{ config('custom.app-slogan') }}</title>
        <meta property="og:title" content="{{ config('custom.app-name') }}">
    @endif


    <meta property="fb:pages" content="{{ config('custom.facebook-page-id') }}" />
    <meta property="og:description" content="{{$post->description or config('custom.og-description-default') }}" />
    <meta property="og:image" content="{{ $post->image or ''}}" />
    <meta property="og:url" content="{{ !empty($post) ? url($post->slug) : Request::url() }}" />
    <meta property="og:site_name" content="{{ config('custom.app-name') }}" />
    <meta property="og:type" content="article" />
    <meta property="article:author" content="{{ config('custom.facebook-url') }}" />
    <meta property="article:publisher" content="{{ config('custom.facebook-url') }}" />
    <meta property="fb:app_id" content="{{ config('custom.facebook-app-id') }}" />

    <meta name="_token" content="{!! csrf_token() !!}"/>


    <link href="{{ asset('assets/front/css/style.css?v1.0.8') }}" rel="stylesheet" type="text/css">
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    {!! config('custom.adsense-enable-page-level-ads') !!}

    <script>window.twttr = (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0],
                    t = window.twttr || {};
            if (d.getElementById(id)) return t;
            js = d.createElement(s);
            js.id = id;
            js.src = "https://platform.twitter.com/widgets.js";
            fjs.parentNode.insertBefore(js, fjs);

            t._e = [];
            t.ready = function (f) {
                t._e.push(f);
            };

            return t;
        }(document, "script", "twitter-wjs"));</script>
    @yield('css')


    <script async='async' src='https://www.googletagservices.com/tag/js/gpt.js'></script>
    <script>
        var googletag = googletag || {};
        googletag.cmd = googletag.cmd || [];
    </script>

    <script>
        googletag.cmd.push(function() {
            googletag.defineSlot('/28112988/PT_RightSide_300x250_1', [300, 250], 'div-gpt-ad-1477597404543-0').addService(googletag.pubads());
            googletag.defineSlot('/28112988/PT_RightSide_300x250_2', [300, 250], 'div-gpt-ad-1477597404543-1').addService(googletag.pubads());
            googletag.defineSlot('/28112988/PT_RightSide_300x250_3', [300, 250], 'div-gpt-ad-1477597404543-2').addService(googletag.pubads());
            googletag.defineSlot('/28112988/PT_RightSide_300x600', [300, 600], 'div-gpt-ad-1477597404543-3').addService(googletag.pubads());
            googletag.pubads().enableSingleRequest();
            googletag.pubads().collapseEmptyDivs();
            googletag.enableServices();
        });
    </script>

    @yield('js-top')
</head>

<body>
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.5&appId={{ config('custom.facebook-app-id') }}";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<?php $f = 'assets/front/svg/shapes.svg'; if (file_exists($f)) {
    include($f);
} ?>

@include('partials.header')

@if ( $page == 'post' )

    @include('partials.header-post')

@endif

@include('partials.mobile-menu')

<main class="site">
    <div class="container wrapper" id="container">

        @yield('content')

    </div>

    <div class="wrapper">
        
        @if ( $page == 'page' )
            <h1 class="section-heading">You may also like:</h1>

            <div class="articles fill-content">
                @include('partials.you-may-like')
            </div>

            {{-- Load related posts of different categories
            <span href="" class="btn load" data-action="you-may-like" data-category="0">Load more</span>
            --}}
        @endif

        @if ( $page == 'post' )
            {{--<h1 class="section-heading">Related stories:</h1>

            <div class="articles fill-content">
                @include('partials.related')
            </div>--}}

                <div id="rcjsload_cf9af9"></div>
                <script type="text/javascript">
                    (function() {
                        var referer="";try{if(referer=document.referrer,"undefined"==typeof referer)throw"undefined"}catch(exception){referer=document.location.href,(""==referer||"undefined"==typeof referer)&&(referer=document.URL)}referer=referer.substr(0,700);
                        var rcel = document.createElement("script");
                        rcel.id = 'rc_' + Math.floor(Math.random() * 1000);
                        rcel.type = 'text/javascript';
                        rcel.src = "http://trends.revcontent.com/serve.js.php?w=48567&t="+rcel.id+"&c="+(new Date()).getTime()+"&width="+(window.outerWidth || document.documentElement.clientWidth)+"&referer="+referer;
                        rcel.async = true;
                        var rcds = document.getElementById("rcjsload_cf9af9"); rcds.appendChild(rcel);
                    })();
                </script>

            {{-- Load related posts of the same category
            <span href="" class="btn load" data-action="related" data-category="1">Load more</span>
            --}}
        @endif
        
    </div>

    @include('partials.footer')
</main>

<div class="go-top">
    <svg>
        <use xlink:href="#svg-arrow"></use>
    </svg>
</div>
<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
        a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', '{{ config('custom.google-analytics-view-id') }}', 'auto');
    ga('send', 'pageview');

</script>
<script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="{{ asset('assets/front/js/scripts.js?v1.0.1') }}"></script>
@yield('js-bottom')
</body>
</html>