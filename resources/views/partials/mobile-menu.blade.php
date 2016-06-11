<nav class="mobile-menu">
    <form action="{{url('search')}}">
        <input type="text" name="s" placeholder="Search Postize">
        <span class="magnifier mobile-search"><svg><use xlink:href="#svg-search"></use></svg></span>
    </form>
    <nav class="nav nav--more cats">
        <a href="{{ url('/') }}" class="home">Home</a>
        <a href="{{ url('/category/funny') }}" class="funny @if ( $current_category == 'funny') active @endif">Funny</a>
        <a href="{{ url('/category/animals') }}" class="animals @if ( $current_category == 'animals') active @endif">Animals</a>
        <a href="{{ url('/category/news') }}" class="news @if ( $current_category == 'news') active @endif">News</a>
        <a href="{{ url('/category/food') }}" class="food @if ( $current_category == 'food') active @endif">Food</a>
        <a href="{{ url('/category/creepy') }}" class="creepy @if ( $current_category == 'creepy') active @endif">Creepy</a>
        <a href="{{ url('/category/interesting') }}" class="interesting @if ( $current_category == 'interesting') active @endif">Interesting</a>
        <a href="{{ url('/category/trending') }}" class="trending @if ( $current_category == 'trending') active @endif">Trending</a>
        <a href="{{ url('/category/feels') }}" class="feels @if ( $current_category == 'feels') active @endif">Feels</a>
        <a href="{{ url('/category/gaming') }}" class="gaming @if ( $current_category == 'gaming') active @endif">Gaming</a>
        {{--<a href="{{ url('/submit') }}" class="btn post">Submit post</a>--}}
    </nav>
    <nav class="nav nav--more">
        <a href="{{ url('/terms') }}" @if ( $current_page == 'terms') class="active" @endif>Terms &amp; Conditions</a>
        <a href="{{ url('/privacy') }}" @if ( $current_page == 'privacy') class="active" @endif>Privacy Policy</a>
        <a href="{{ url('/copyright') }}" @if ( $current_page == 'copyright') class="active" @endif>DMCA Removal</a>
        <a href="{{ url('/contact') }}" @if ( $current_page == 'contact') class="active" @endif>Contact us</a>
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