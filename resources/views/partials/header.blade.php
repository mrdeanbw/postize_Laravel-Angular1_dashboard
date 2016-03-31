<header class="header header--main">
    <div class="wrapper">
        <section>
            <a href="{{url('/')}}" class="logo">
                <img src="{!! asset('assets/front/svg/postize-logo.svg') !!}" alt="">                    
            </a>
            <nav class="nav nav--main resize">
                <a href="{{ url('/category/funny') }}" class="funny active">Funny</a>
                <a href="{{ url('/category/animals') }}" class="animals">Animals</a>
                <a href="{{ url('/category/news') }}" class="news">News</a>
                <a href="{{ url('/category/food') }}" class="food">Food</a>
                <a href="{{ url('/category/creepy') }}" class="creepy">Creepy</a>
                <a href="{{ url('/category/interesting') }}" class="nostalgia">Interesting</a>

                <span class="more">More <span class="arrow"><svg><use xlink:href="#svg-arrow"></use></svg></span></span>
            </nav>
            <div class="modal">
                <nav class="nav nav--more cats">
                    <a href="{{ url('/') }}" class="home">Home</a>
                    <a href="{{ url('/trending') }}" class="trending">Trending</a>
                    <a href="{{ url('/category/feels') }}" class="feels">Feels</a>
                    <a href="{{ url('/category/gaming') }}" class="gaming">Gaming</a>
                </nav>
                <nav class="nav nav--more landing">
                    <a href="{{ url('/terms') }}" class="active">Terms &amp; Conditions</a>
                    <a href="{{ url('/privacy') }}" >Privacy Policy</a>
                    <a href="{{ url('/copyright') }}" >DMCA Removal</a>
                    <a href="{{ url('/contact') }}" >Contact us</a>
                </nav>
                <div class="nav-footer">
                    {{--<a href="{{ url('/submit') }}" class="btn post">Submit post</a>--}}
                    <div class="social">
                        <a href="https://facebook.com/Postize" class="facebook"><svg><use xlink:href="#svg-facebook"></use></svg></a>
                        <a href="https://twitter.com/PostizeMedia" class="twitter"><svg><use xlink:href="#svg-twitter"></use></svg></a>
                        <a href="https://instagram.com/Postize" class="instagram"><svg><use xlink:href="#svg-instagram"></use></svg></a>
                        {{--<a href="" class="youtube"><svg><use xlink:href="#svg-youtube"></use></svg></a>--}}
                    </div>
                </div>
            </div>
        </section>

        <aside>
            <div class="share">
                <div class="fb-like" data-href="http://facebook.com/Postize" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
                <a class="twitter-follow-button" href="https://twitter.com/PostizeMedia" data-show-screen-name="false"></a>
            </div>

            <span class="magnifier show-search"><svg><use xlink:href="#svg-search"></use></svg></span>

            <button class="hamburger hamburger--spring toggle-nav" type="button">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>

            <div class="search">
                <form action="{{url('search')}}">
                    <input type="text" name="s" placeholder="Search Postize">
                </form>
            </div>
        </aside>
    </div>
</header>