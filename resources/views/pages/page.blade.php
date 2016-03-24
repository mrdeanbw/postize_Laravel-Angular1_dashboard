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
		
		{{-- Load related posts of different categories --}}
		<span href="" class="btn load" data-action="you-may-like" data-category="0">Load more</span>

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