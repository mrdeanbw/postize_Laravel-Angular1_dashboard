<header class="header header--main">
    <div class="wrapper">
        <section>
            <a href="" class="logo">
                <img src="{!! asset('assets/front/svg/postize-logo.svg') !!}" alt="">                    
            </a>
            <nav class="nav nav--main resize">
                <a href="{{ url('/') }}" class="funny active">Funny</a>
                <a href="{{ url('/') }}" class="animals">Animals</a>
                <a href="{{ url('/') }}" class="news">News</a>
                <a href="{{ url('/') }}" class="food">Food</a>
                <a href="{{ url('/') }}" class="creepy">Creepy</a>
                <a href="{{ url('/') }}" class="feels">Feels</a>
                <span class="more">More <span class="arrow"><svg><use xlink:href="#svg-arrow"></use></svg></span></span>
            </nav>
            <div class="modal">
                <nav class="nav nav--more cats">
                    <a href="{{ url('/') }}" class="home">Home</a>
                    <a href="{{ url('/') }}" class="trending">Trending</a>
                    <a href="{{ url('/') }}" class="gaming">Gaming</a>
                    <a href="{{ url('/') }}" class="nostalgia">Nostalgia</a>
                </nav>
                <nav class="nav nav--more landing">
                    <a href="{{ url('/') }}" class="active">Terms &amp; Conditions</a>
                    <a href="{{ url('/') }}" >Privacy Policy</a>
                    <a href="{{ url('/') }}" >DMCA Removal</a>
                    <a href="{{ url('/') }}" >Contact us</a>
                </nav>
                <div class="nav-footer">
                    <a href="" class="btn post">Submit post</a>
                    <div class="social">
                        <a href="" class="facebook"><svg><use xlink:href="#svg-facebook"></use></svg></a>
                        <a href="" class="twitter"><svg><use xlink:href="#svg-twitter"></use></svg></a>
                        <a href="" class="instagram"><svg><use xlink:href="#svg-instagram"></use></svg></a>
                        <a href="" class="youtube"><svg><use xlink:href="#svg-youtube"></use></svg></a>
                    </div>
                </div>
            </div>
        </section>

        <aside>
            <div class="share">
                <div class="fb-like" data-href="http://postize.com/" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
                <a class="twitter-follow-button" href="https://twitter.com/TwitterDev" data-show-screen-name="false">Follow</a>
            </div>

            <span class="magnifier show-search"><svg><use xlink:href="#svg-search"></use></svg></span>

            <button class="hamburger hamburger--spring toggle-nav" type="button">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>

            <div class="search">
                <form action="">
                    <input type="text" placeholder="Search Postize">
                </form>
            </div>
        </aside>
    </div>
</header>