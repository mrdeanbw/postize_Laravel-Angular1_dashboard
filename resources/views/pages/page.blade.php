@extends('layouts.main')

@section('content')
<div class="page">

	{{-- @include('partials.slider') --}}
	
	<section>
		{{-- <h1 class="section-heading">Top stories:</h1> --}}

		@include('partials.top-stories')     
	</section>

	<section class="from-the-web">
		<article class="item item--post">
			<div class="content promoted">
				{!! config('custom.content-advertising-1') !!}
			</div>
		</article>
	</section>
</div>

<aside class="sidebar">

	@include('partials.sidebar-articles')

	@if(!empty(config('custom.facebook-url')))
		<div class="sticky sticky--facebook">
		
		</div>
	@endif
</aside>
@endsection  