<header class="header header--post">
	<div class="wrapper">
		<section>
			<a href="{{url('/')}}" class="logo">
				<img src="assets/front/svg/postize-logo-letter.svg" alt="">
			</a>
			<h2 class="resize-post-header">{{ $post->title }}</h2>
		</section>

		<aside>
			<div class="share">
				<div class="row share-buttons small">
					<a href="https://www.facebook.com/sharer/sharer.php?u={{url($post->slug)}}" target="_blank" class="row facebook">
						<div>
							<svg><use xlink:href="#svg-facebook"></use></svg>
						</div>
						<span>Share</span>
					</a>
					<a href="https://twitter.com/intent/tweet?text=Take%20a%20look%20at%20this&amp;url={{url($post->slug)}}" class="row twitter">
						<div>
							<svg><use xlink:href="#svg-twitter"></use></svg>
						</div>
						<span>Tweet</span>
					</a>
				</div>
			</div>

			<span class="magnifier show-search"><svg><use xlink:href="#svg-search"></use></svg></span>

			<button class="hamburger hamburger--spring toggle-nav" type="button">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</button>

			{{--<div class="search">
				<form action="{{url('search')}}">
					<input type="text" placeholder="Search Postize">
				</form>
			</div>--}}
		</aside>
	</div>
</header>