@foreach($posts as $post)
    <article class="item item--small funny">
        <a href="{{url($post->slug)}}" class="image">
            <figure>
                <img src="{{ $post->image }}" alt="">
            </figure>
        </a>

        <div class="info">
            <a href="">
                <h2>{{ $post->title }}</h2>
            </a>

            <div class="meta">by <a href="" class="author"> {{$post->author->name}}</a> on
                <span class="date"> {{ (new DateTime($post->created_at))->format('m F, Y') }}</span></div>
        </div>
        <a href="" class="category">Funny</a>
    </article>
@endforeach