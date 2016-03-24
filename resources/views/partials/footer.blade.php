<footer class="site-footer">
    <div class="wrapper content">
        <section>
            <a href="" class="logo">
                <img src="{!! asset('assets/front/svg/postize-logo-footer.svg') !!}" alt="">
            </a>
            <p>Postize, a platform for people who like to read, write, and be up to date on trending information around the globe.</p>
        </section>
        <aside>
            <nav class="nav nav--footer">
                <a href="{{ url('/') }}" class="active">Terms &amp; Conditions</a>
                <a href="{{ url('/') }}" >Privacy Policy</a>
                <a href="{{ url('/') }}" >DMCA Removal</a>
                <a href="{{ url('/') }}" >Contact us</a>
            </nav>
            <div class="social">
                <a href="" class="facebook"><svg><use xlink:href="#svg-facebook"></use></svg></a>
                <a href="" class="twitter"><svg><use xlink:href="#svg-twitter"></use></svg></a>
                <a href="" class="instagram"><svg><use xlink:href="#svg-instagram"></use></svg></a>
                <a href="" class="youtube"><svg><use xlink:href="#svg-youtube"></use></svg></a>
            </div>
        </aside>
    </div>
    <div class="copyright">
        <div class="wrapper">&copy; <?php echo date('Y') ?> Methodize Media - All Rights Reserved</div>
    </div>
</footer>