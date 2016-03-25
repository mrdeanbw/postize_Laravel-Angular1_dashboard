@foreach($posts as $post)
    {{ dd($post); }}
    <article class="item item--small news">
        <a href="" class="image">
            <figure>
                <img src="assets/front/img/thumb300.jpg" alt="">
            </figure>
        </a>

        <div class="info">
            <a href="">
                <h2>{{ $post->title }}</h2>
            </a>

            <div class="meta">by <a href="" class="author">{{$post->author}}</a> on <span class="date">{{ (new DateTime($post->created_at))->format('m DD, YY'); }}</span>
            </div>
        </div>
    </article>
@endforeach