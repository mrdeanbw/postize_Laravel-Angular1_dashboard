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

	<header class="site-header">
		<div class="wrapper">
			<section>
				<a href="" class="logo">
					<img src="assets/front/svg/postize-logo.svg" alt="">
				</a>
				<nav class="nav nav--main">
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

	<main class="site">
		<div class="container wrapper">
			<div class="page">
				<section class="slider">
					<article class="item news">
						<a href="" class="image">
							<figure>
								<img src="assets/front/img/slide.jpg" alt="">
							</figure>
						</a>
						<aside>
							<a href="">
								<h1 class="main">Lady Gaga Talks About How Her Aunt’s Sexual Assault Tormented Her Before She Died</h1>
							</a>
							<div class="meta">by <a href="" class="author">John Doe</a> on <span class="date">March 08, 2016</span></div>
							<a href="" class="btn">Read more</a>
						</aside>
						<a href="" class="category">News</a>
					</article>

					<article class="item animals">
						<a href="" class="image">
							<figure>
								<img src="assets/front/img/slide.jpg" alt="">
							</figure>
						</a>
						<aside>
							<a href="">
								<h1 class="main">Lady Gaga Talks About How Her Aunt’s Sexual Assault Tormented Her Before She Died</h1>
							</a>
							<div class="meta">by <a href="" class="author">John Doe</a> on <span class="date">March 08, 2016</span></div>
							<a href="" class="btn">Read more</a>
						</aside>
						<a href="" class="category">News</a>
					</article>

					<article class="item funny">
						<a href="" class="image">
							<figure>
								<img src="assets/front/img/slide.jpg" alt="">
							</figure>
						</a>
						<aside>
							<a href="">
								<h1 class="main">Lady Gaga Talks About How Her Aunt’s Sexual Assault Tormented Her Before She Died</h1>
							</a>
							<div class="meta">by <a href="" class="author">John Doe</a> on <span class="date">March 08, 2016</span></div>
							<a href="" class="btn">Read more</a>
						</aside>
						<a href="" class="category">News</a>
					</article>
				</section>

				<section>
					<h1 class="section-heading">Top stories:</h1>

					<div class="articles">
						<article class="item item--big funny">
							<a href="" class="image">
								<figure>
									<img src="assets/front/img/thumb350.jpg" alt="">
								</figure>
							</a>
							<div class="info">
								<a href="">
									<h1>Lady Gaga Talks About How Her Aunt’s Sexual Assault Tormented Her Before She Died</h1>
								</a>
								<p>After opening their first physical bookstore in Seattle last November, Amazon will open opening their...</p>
								<div class="meta-holder">
									<div class="meta">
										<figure class="avatar">
											<img src="assets/front/img/avatar.jpg" alt="">
										</figure>
										<div>by <a href="" class="author">John Doe</a> on <span class="date">March 08, 2016</span></div>
									</div>
									<a href="" class="btn">Read more</a>
								</div>
							</div>
							<a href="" class="category">Funny</a>
						</article>

						<article class="item item--big animals">
							<a href="" class="image">
								<figure>
									<img src="assets/front/img/thumb350.jpg" alt="">
								</figure>
							</a>
							<div class="info">
								<a href="">
									<h1>Lady Gaga Talks About How Her Aunt’s Sexual Assault Tormented Her Before She Died</h1>
								</a>
								<p>After opening their first physical bookstore in Seattle last November, Amazon will open opening their...</p>
								<div class="meta-holder">
									<div class="meta">
										<figure class="avatar">
											<img src="assets/front/img/avatar.jpg" alt="">
										</figure>
										<div>by <a href="" class="author">John Doe</a> on <span class="date">March 08, 2016</span></div>
									</div>
									<a href="" class="btn">Read more</a>
								</div>
							</div>
							<a href="" class="category">Animals</a>
						</article>

						<article class="item item--big creepy">
							<a href="" class="image">
								<figure>
									<img src="assets/front/img/thumb350.jpg" alt="">
								</figure>
							</a>
							<div class="info">
								<a href="">
									<h1>Lady Gaga Talks About How Her Aunt’s Sexual Assault Tormented Her Before She Died</h1>
								</a>
								<p>After opening their first physical bookstore in Seattle last November, Amazon will open opening their...</p>
								<div class="meta-holder">
									<div class="meta">
										<figure class="avatar">
											<img src="assets/front/img/avatar.jpg" alt="">
										</figure>
										<div>by <a href="" class="author">John Doe</a> on <span class="date">March 08, 2016</span></div>
									</div>
									<a href="" class="btn">Read more</a>
								</div>
							</div>
							<a href="" class="category">Creepy</a>
						</article>
					</div>		
				</section>

				<section>
					<h1 class="section-heading">You may also like:</h1>

					<div class="articles">
						<article class="item item--small funny">
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
							<a href="" class="category">Funny</a>
						</article>
						<article class="item item--small animals">
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
							<a href="" class="category">Animals</a>
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
							<a href="" class="category">News</a>
						</article>
						<article class="item item--small food">
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
							<a href="" class="category">Food</a>
						</article>
						<article class="item item--small creepy">
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
							<a href="" class="category">Creepy</a>
						</article>
						<article class="item item--small feels">
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
							<a href="" class="category">Feels</a>
						</article>
						<article class="item item--small trending">
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
							<a href="" class="category">Trending</a>
						</article>
						<article class="item item--small gaming">
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
							<a href="" class="category">Gaming</a>
						</article>
						<article class="item item--small nostalgia">
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
							<a href="" class="category">Nostalgia</a>
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