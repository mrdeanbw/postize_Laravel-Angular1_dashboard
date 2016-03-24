<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>Postize</title>

	<link rel="stylesheet" href="assets/front/css/style.css">
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

	<nav class="mobile-menu">
		<form action="">
			<input type="text" placeholder="Search Postize">
			<span class="magnifier mobile-search"><svg><use xlink:href="#svg-search"></use></svg></span>
		</form>
		<nav class="nav nav--more cats">
			<a href="{{ url('/') }}" class="home">Home</a>
			<a href="{{ url('/') }}" class="funny active">Funny</a>
			<a href="{{ url('/') }}" class="animals">Animals</a>
			<a href="{{ url('/') }}" class="news">News</a>
			<a href="{{ url('/') }}" class="food">Food</a>
			<a href="{{ url('/') }}" class="creepy">Creepy</a>
			<a href="{{ url('/') }}" class="feels">Feels</a>
			<a href="{{ url('/') }}" class="trending">Trending</a>
			<a href="{{ url('/') }}" class="gaming">Gaming</a>
			<a href="{{ url('/') }}" class="nostalgia">Nostalgia</a>
			<a href="{{ url('/') }}" class="btn post">Submit post</a>
		</nav>
		<nav class="nav nav--more">
			<a href="{{ url('/') }}" class="active">Terms &amp; Conditions</a>
			<a href="{{ url('/') }}" >Privacy Policy</a>
			<a href="{{ url('/') }}" >DMCA Removal</a>
			<a href="{{ url('/') }}" >Contact us</a>
		</nav>
		<div class="nav-footer">
			<div class="social">
				<a href="" class="facebook"><svg><use xlink:href="#svg-facebook"></use></svg></a>
				<a href="" class="twitter"><svg><use xlink:href="#svg-twitter"></use></svg></a>
				<a href="" class="instagram"><svg><use xlink:href="#svg-instagram"></use></svg></a>
				<a href="" class="youtube"><svg><use xlink:href="#svg-youtube"></use></svg></a>
			</div>
		</div>
	</nav>

	<header class="header header--main">
		<div class="wrapper">
			<section>
				<a href="" class="logo">
					<img src="assets/front/svg/postize-logo.svg" alt="">
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

	<header class="header header--post">
		<div class="wrapper">
			<section>
				<a href="" class="logo">
					<img src="assets/front/svg/postize-logo-letter.svg" alt="">
				</a>
				<h2 class="resize-post-header">Lady Gaga Talks About How Her Aunt’s Sexual Assault Tormented Her Before She Died</h2>
			</section>

			<aside>
				<div class="share">
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

	<main class="site">
		<div class="container wrapper">
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
					<h1 class="section-heading">Releated stories:</h1>

					<div class="articles">
						<article class="item item--small news">
							<a href="" class="image">
								<figure>
									<img src="assets/front/img/thumb300.jpg" alt="">
								</figure>
							</a>
							<div class="info">
								<a href="">
									<h2>Finn Surprises Sick Children With Star Wars Toys!</h2>
								</a>
								<div class="meta">by <a href="" class="author">John Doe</a> on <span class="date">March 08, 2016</span></div>
							</div>
						</article>
						<article class="item item--small news">
							<a href="" class="image">
								<figure>
									<img src="assets/front/img/thumb300.jpg" alt="">
								</figure>
							</a>
							<div class="info">
								<a href="">
									<h2>Finn Surprises Sick Children With Star Wars Toys!</h2>
								</a>
								<div class="meta">by <a href="" class="author">John Doe</a> on <span class="date">March 08, 2016</span></div>
							</div>
						</article>
						<article class="item item--small news">
							<a href="" class="image">
								<figure>
									<img src="assets/front/img/thumb300.jpg" alt="">
								</figure>
							</a>
							<div class="info">
								<a href="">
									<h2>Finn Surprises Sick Children With Star Wars Toys!</h2>
								</a>
								<div class="meta">by <a href="" class="author">John Doe</a> on <span class="date">March 08, 2016</span></div>
							</div>
						</article>
						<article class="item item--small news">
							<a href="" class="image">
								<figure>
									<img src="assets/front/img/thumb300.jpg" alt="">
								</figure>
							</a>
							<div class="info">
								<a href="">
									<h2>Finn Surprises Sick Children With Star Wars Toys!</h2>
								</a>
								<div class="meta">by <a href="" class="author">John Doe</a> on <span class="date">March 08, 2016</span></div>
							</div>
						</article>
						<article class="item item--small news">
							<a href="" class="image">
								<figure>
									<img src="assets/front/img/thumb300.jpg" alt="">
								</figure>
							</a>
							<div class="info">
								<a href="">
									<h2>Finn Surprises Sick Children With Star Wars Toys!</h2>
								</a>
								<div class="meta">by <a href="" class="author">John Doe</a> on <span class="date">March 08, 2016</span></div>
							</div>
						</article>
						<article class="item item--small news">
							<a href="" class="image">
								<figure>
									<img src="assets/front/img/thumb300.jpg" alt="">
								</figure>
							</a>
							<div class="info">
								<a href="">
									<h2>Finn Surprises Sick Children With Star Wars Toys!</h2>
								</a>
								<div class="meta">by <a href="" class="author">John Doe</a> on <span class="date">March 08, 2016</span></div>
							</div>
						</article>
					</div>

					<span href="" class="btn load">Load more</span>
				</section>
			</div>

			<aside class="sidebar">

				<div class="add">
					<a href="">
						<img src="assets/front/img/300.jpg" alt="">
					</a>
				</div>

				<div class="articles">
					<article class="item funny">
						<a href="" class="image">
							<figure>
								<img src="assets/front/img/thumb300.jpg" alt="">
							</figure>
							<h2>Finn Surprises Sick Children With Star Wars Toys!</h2>
						</a>
						<a href="" class="category">Funny</a>
					</article>
					<article class="item animals">
						<a href="" class="image">
							<figure>
								<img src="assets/front/img/thumb300.jpg" alt="">
							</figure>
							<h2>Finn Surprises Sick Children With Star Wars Toys!</h2>
						</a>
						<a href="" class="category">Animals</a>
					</article>
					<article class="item food">
						<a href="" class="image">
							<figure>
								<img src="assets/front/img/thumb300.jpg" alt="">
							</figure>
							<h2>Finn Surprises Sick Children With Star Wars Toys!</h2>
						</a>
						<a href="" class="category">Food</a>
					</article>
				</div>

				<div class="add sticky">
					<a href="">
						<img src="assets/front/img/300.jpg" alt="">
					</a>
				</div>

				<div class="subscribe">
					<header>
						<svg><use xlink:href="#svg-email"></use></svg>
						<h2>Subscribe to our newsletter</h2>
					</header>
					<form action="">
						<input type="text" placeholder="Email">
						<input type="submit" class="btn" value="Subscribe">
					</form>
				</div>
			</aside>
		</div>

		<footer class="site-footer">
			<div class="wrapper content">
				<section>
					<a href="" class="logo">
						<img src="assets/front/svg/postize-logo-footer.svg" alt="">
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
	</main>

	<div class="go-top"><svg><use xlink:href="#svg-arrow"></use></svg></span></div>

	<script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
	<script src="assets/front/js/scripts.js"></script>
	<script src="http://localhost:35755/livereload.js"></script> 

</body>
</html>