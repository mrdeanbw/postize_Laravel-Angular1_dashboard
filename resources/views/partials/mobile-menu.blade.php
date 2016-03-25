<nav class="mobile-menu">
    <form action="">
        <input type="text" placeholder="Search Postize">
        <span class="magnifier mobile-search"><svg><use xlink:href="#svg-search"></use></svg></span>
    </form>
    <nav class="nav nav--more cats">
        <a href="{{ url('/') }}" class="home">Home</a>
        <a href="{{ url('/category/funny') }}" class="funny active">Funny</a>
        <a href="{{ url('/category/animals') }}" class="animals">Animals</a>
        <a href="{{ url('/category/news') }}" class="news">News</a>
        <a href="{{ url('/category/food') }}" class="food">Food</a>
        <a href="{{ url('/category/creepy') }}" class="creepy">Creepy</a>
        <a href="{{ url('/category/feels') }}" class="feels">Feels</a>
        <a href="{{ url('/trending') }}" class="trending">Trending</a>
        <a href="{{ url('/category/gaming') }}" class="gaming">Gaming</a>
        <a href="{{ url('/category/nostalgia') }}" class="nostalgia">Nostalgia</a>
        {{--<a href="{{ url('/submit') }}" class="btn post">Submit post</a>--}}
    </nav>
    <nav class="nav nav--more">
        <a href="{{ url('/terms') }}" class="active">Terms &amp; Conditions</a>
        <a href="{{ url('/privacy') }}" >Privacy Policy</a>
        <a href="{{ url('/copyright') }}" >DMCA Removal</a>
        <a href="{{ url('/contact') }}" >Contact us</a>
    </nav>
    <div class="nav-footer">
        <div class="social">
            <a href="https://facebook.com/Postize" class="facebook"><svg><use xlink:href="#svg-facebook"></use></svg></a>
            <a href="https://twitter.com/PostizeMedia" class="twitter"><svg><use xlink:href="#svg-twitter"></use></svg></a>
            <a href="https://instagram.com/Postize" class="instagram"><svg><use xlink:href="#svg-instagram"></use></svg></a>
            {{--<a href="" class="youtube"><svg><use xlink:href="#svg-youtube"></use></svg></a>--}}
        </div>
    </div>
</nav>