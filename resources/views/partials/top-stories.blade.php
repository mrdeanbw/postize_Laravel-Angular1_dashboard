@foreach($posts as $post)
	<div class="articles">
		<article class="item item--big funny">
			<a href="" class="image">
				<figure>
					<img src="{{$post->image}}" alt="">
				</figure>
			</a>
			<div class="info">
				<a href="{{url($post->slug)}}">
					<h1>{{$post->title}}</h1>
				</a>
				<p>After opening their first physical bookstore in Seattle last November, Amazon will open opening their...</p>
				<div class="meta-holder">
					<div class="meta">
						<figure class="avatar">
							<img src="{{$post->author->image}}" alt="">
						</figure>
						<div>by <a href="" class="author">{{$post->author->name}}</a> on
							<span class="date">{{ (new DateTime($post->created_at))->format('m F, Y') }}</span></div>
					</div>
					<a href="" class="btn">Read more</a>
				</div>
			</div>
			<a href="" class="category">Funny</a>
		</article>
	</div>
	@endforeach


