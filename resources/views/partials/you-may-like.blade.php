@foreach($posts as $post)
    <article class="item item--small {{ strtolower($post->category->name) }}">
        <a href="{{url($post->slug)}}" class="image">
            <figure>
                <img src="{{ $post->image }}" alt="">
            </figure>
        </a>

        <div class="info">
            <a href="{{url($post->slug)}}">
                <h2>{{ $post->title }}</h2>
            </a>

            <div class="meta">
            	<div>by <a href="{{url($post->slug)}}" class="author"> {{$post->author->name}}</a> on
                <span class="date"> {{ (new DateTime($post->created_at))->format('m M, Y') }}</span></div>
            </div>
        </div>
        <a href="{{ url('category/' . strtolower($post->category->name)) }}" class="category">{{ $post->category->name }}</a>
    </article>
@endforeach
