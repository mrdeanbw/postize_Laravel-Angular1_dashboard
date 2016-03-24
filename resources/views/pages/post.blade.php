@extends('layouts.main')

@section('content')
<div class="page">

	<section>
		<article class="item item--post news">

			<figure class="top-image">
				<img src="assets/front/img/slide.jpg" alt="">
			</figure>

			<div class="content">
				<h1>Lady Gaga Talks About How Her Aunt’s Sexual Assault Tormented Her Before She Died</h1>

				<div class="meta-holder">
					<div class="meta">
						<figure class="avatar">
							<img src="assets/front/img/avatar.jpg" alt="">
						</figure>
						<div>by <a href="" class="author">John Doe</a> on <span class="date">March 08, 2016</span></div>
					</div>
					<div class="row share-buttons small">
						<a href="https://www.facebook.com/sharer/sharer.php?u=postize.com" target="_blank" class="row facebook">
							<div>
								<svg><use xlink:href="#svg-facebook"></use></svg>
							</div>
							<span>Share</span>
						</a>
						<a href="https://twitter.com/intent/tweet?text=Take%20a%20look%20at%20this&amp;url=http://postize.com" class="row twitter">
							<div>
								<svg><use xlink:href="#svg-twitter"></use></svg>
							</div>
							<span>Tweet</span>
						</a>
					</div>
				</div>

				<div class="tags">
					<span>Topics</span>
					<a href="">Candy maker</a>
					<a href="">Confectioner</a>
					<a href="">Guinnes World Records</a>
					<a href="">Holocaust survivor</a>
					<a href="">Israel</a>
				</div>

				<p>The oldest living man in the world is currently 112 years old. His name? Israel Kristal, as announced by <a href="">Guinness World Records March 11</a>.</p>

				<p>He received his official certificate, which states that he is the  world’s oldest man at 112 years and 178 days in his home in Haifa, Israel.</p>

				<blockquote cite="http://www.worldwildlife.org/who/index.html">
					For 50 years, WWF has been protecting the future of nature. The world's leading conservation organization, WWF works in 100 countries and is supported by 1.2 million members in the United States and close to 5 million globally.
				</blockquote>

				<p>He received his official certificate, which states that he is the  world’s oldest man at 112 years and 178 days in his home in Haifa, Israel.</p>

				<h2>Check Out Peranakan Food</h2>

				<p>He received his official certificate, which states that he is the  world’s oldest man at 112 years and 178 days in his home in Haifa, Israel.</p>

				<p>
					<img src="assets/front/img/post-image.jpg" alt="">
					<span class="source">
						<span>source:</span>
						<a href="">Hellou.co.uk</a>
					</span>
				</p>

				<p>
					<img src="assets/front/img/728.jpg" alt="">
				</p>

				<p>Born Izrael Icek Krysztal in a small village in modern day Poland on 15 September 1903, Kristal helped his father run a confectionery shop in Lodz, Poland when Germany invaded the country. Even during the years that he and the city’s Jewish population were forced into the Lodz Ghetto, Kristal and his father continued making candy.  Come 1943, Kristal and his family were moved to Auschwitz, where his wife and two children were killed; he was the only member of his extended family to survive World War II. Following the war, Kristal reopened and ran his family’s candy shop in Lodz until 1950. He moved with his second wife and son to Israel and continued to work as a candy maker.</p>

				<ul>
					<li>Izrael Icek Krysztal</li>
					<li>Kristal and his family</li>
					<li>Following the war</li>
					<li>He received his official certificate</li>
					<li><a href="">Hellou.co.uk</a></li>
				</ul>

				<h2>Check Out Peranakan Food</h2>

				<p>
					<iframe width="640" height="360" src="https://www.youtube.com/embed/gAcLp3qFQYk" frameborder="0" allowfullscreen></iframe>
				</p>

				<p>Born Izrael Icek Krysztal in a small village in modern day Poland on 15 September 1903, Kristal helped his father run a confectionery shop in Lodz, Poland when Germany invaded the country. Even during the years that he and the city’s Jewish population were forced into the Lodz Ghetto, Kristal and his father continued making candy.  Come 1943, Kristal and his family were moved to Auschwitz, where his wife and two children were killed; he was the only member of his extended family to survive World War II. Following the war, Kristal reopened and ran his family’s candy shop in Lodz until 1950. He moved with his second wife and son to Israel and continued to work as a candy maker.</p>

				<div class="row share-buttons big">
					<a href="https://www.facebook.com/sharer/sharer.php?u=postize.com" class="row facebook">
						<svg><use xlink:href="#svg-facebook"></use></svg>
						<span>Share On Facebook</span>
					</a>
					<a href="https://twitter.com/intent/tweet?text=Take%20a%20look%20at%20this&amp;url=http://postize.com" class="row twitter">
						<svg><use xlink:href="#svg-twitter"></use></svg>
						<span>Share On Twitter</span>
					</a>
				</div>
			</div>
		</article>

		<div class="siblings row">
			<div class="pn">
				<a href="">
					<span class="p">Previous Post</span>
					<div class="row">
						<figure>
							<img src="assets/front/img/thumb300.jpg" alt="">
						</figure>
						<h2>Amazon Will Be Opening Their Second Amazon</h2>
					</div>
				</a>
			</div>
			<div class="pn">
				<a href="">
					<span class="n">Next Post</span>
					<div class="row">
						<figure>
							<img src="assets/front/img/thumb300.jpg" alt="">
						</figure>
						<h2>Physical Bookstore In San Diego Physical</h2>
					</div>
				</a>
			</div>
		</div>

		<div class="comments">
			<div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments#configurator" data-width="100%" data-numposts="5"></div>
		</div>
	</section>

	<section>
		<h1 class="section-heading">Related stories:</h1>

		<div class="articles fill-content">
			@include('partials.related')
		</div>
		
		{{-- Load related posts of the same category --}}
		<span href="" class="btn load" data-action="related" data-category="1">Load more</span>

	</section>

</div>

<aside class="sidebar">

	<div class="add">
		<a href="">
			<img src="{!! asset('assets/front/img/300.jpg') !!}" alt="">
		</a>
	</div>

	@include('partials.sidebar-articles')

	<div class="sticky">
		<div class="add">
			<a href="">
				<img src="{!! asset('assets/front/img/300.jpg') !!}" alt="">
			</a>
		</div>
	
		@include('partials.subscribe')
	</div>
	
</aside>
@endsection  