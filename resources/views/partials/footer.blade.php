<footer class="site-footer">
    <div class="wrapper text">
        <section>
            <a href="{{url('/')}}" class="logo">
                <img src="{!! asset('assets/front/svg/postize-logo-footer.svg') !!}" alt="">
            </a>
            <p>Postize, a platform for people who like to read, write, and be up to date on trending information around the globe.</p>
        </section>
        <aside>
            <nav class="nav nav--footer">
                <a href="{{ url('/terms') }}" class="active">Terms &amp; Conditions</a>
                <a href="{{ url('/privacy') }}" >Privacy Policy</a>
                <a href="{{ url('/copyright') }}" >DMCA Removal</a>
                <a href="{{ url('/contact') }}" >Contact us</a>
            </nav>
            <div class="social">
                <a href="https://facebook.com/Postize" class="facebook"><svg><use xlink:href="#svg-facebook"></use></svg></a>
                <a href="https://twitter.com/PostizeMedia" class="twitter"><svg><use xlink:href="#svg-twitter"></use></svg></a>
                <a href="https://instagram.com/Postize" class="instagram"><svg><use xlink:href="#svg-instagram"></use></svg></a>
                {{--<a href="" class="youtube"><svg><use xlink:href="#svg-youtube"></use></svg></a>--}}
            </div>
        </aside>
    </div>
    <div class="copyright">
        <div class="wrapper">&copy; <?php echo date('Y') ?> Methodize Media Pty. Ltd. - All Rights Reserved</div>
    </div>
</footer>