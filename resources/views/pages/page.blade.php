@extends('layouts.main')

@section('content')
<div class="page">

	@include('partials.slider')
	
	<section>
		<h1 class="section-heading">Top stories:</h1>

		@include('partials.top-stories')     
	</section>

	<section>
		<h1 class="section-heading">You may also like:</h1>
		
		<div class="articles fill-content">
			@include('partials.you-may-like')
		</div>

		<div id="rcjsload_5e8030"></div>
		<script type="text/javascript">
			(function() {
				var referer="";try{if(referer=document.referrer,"undefined"==typeof referer)throw"undefined"}catch(exception){referer=document.location.href,(""==referer||"undefined"==typeof referer)&&(referer=document.URL)}referer=referer.substr(0,700);
				var rcel = document.createElement("script");
				rcel.id = 'rc_' + Math.floor(Math.random() * 1000);
				rcel.type = 'text/javascript';
				rcel.src = "http://trends.revcontent.com/serve.js.php?w=17087&t="+rcel.id+"&c="+(new Date()).getTime()+"&width="+(window.outerWidth || document.documentElement.clientWidth)+"&referer="+referer;
				rcel.async = true;
				var rcds = document.getElementById("rcjsload_5e8030"); rcds.appendChild(rcel);
			})();
		</script>

		{{-- Load related posts of different categories
		<span href="" class="btn load" data-action="you-may-like" data-category="0">Load more</span>
		--}}

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
			<div id="rcjsload_78508f"></div>
			<script type="text/javascript">
				(function() {
					var referer="";try{if(referer=document.referrer,"undefined"==typeof referer)throw"undefined"}catch(exception){referer=document.location.href,(""==referer||"undefined"==typeof referer)&&(referer=document.URL)}referer=referer.substr(0,700);
					var rcel = document.createElement("script");
					rcel.id = 'rc_' + Math.floor(Math.random() * 1000);
					rcel.type = 'text/javascript';
					rcel.src = "http://trends.revcontent.com/serve.js.php?w=17088&t="+rcel.id+"&c="+(new Date()).getTime()+"&width="+(window.outerWidth || document.documentElement.clientWidth)+"&referer="+referer;
					rcel.async = true;
					var rcds = document.getElementById("rcjsload_78508f"); rcds.appendChild(rcel);
				})();
			</script>
		</div>
		
		@include('partials.subscribe')
	</div>
</aside>
@endsection  