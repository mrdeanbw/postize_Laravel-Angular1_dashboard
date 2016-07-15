@extends('layouts.main')

{{-- @section('css')
    <style type="text/css">
        .content h2 {
            font-size: 30px;
            margin-top: 35px;
        }

        .content img {
            width: 100%;
        }

        .page .item.news:after {
            background-color: transparent !important;
        }
    </style>
@endsection --}}

@section('content')
    <div class="page">

        <section>
            <article class="item item--post news">

                @if(!$preview && !$mobile)
                <div class="ad-content">
                    {!! config('custom.mgid-top') !!}
                </div>
                @endif

                <figure class="top-image">
                    <img src="{{$post->image}}" alt="">
                </figure>

                <div class="content">
                    <h1 class="post-title">{{$post->title}}</h1>

                    <div class="row">
                        <div class="ad-content">
                            {!! config('custom.pt-leaderboard-atf') !!}
                            <span class="ad-disclaimer">ADVERTISEMENT</span>
                        </div>
                    </div>

                    <div class="meta-holder">
                        <div class="meta">
                            <figure class="avatar">
                                <img src="{{ $post->author->image }}" alt="">
                            </figure>
                            <div>by <a href="" class="author">{{$post->author->name}}</a></div>
                        </div>
                        <div class="row share-buttons small">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{url($post->slug)}}" target="_blank"
                               class="row facebook">
                                <div>
                                    <svg>
                                        <use xlink:href="#svg-facebook"></use>
                                    </svg>
                                </div>
                                <span>Share</span>
                            </a>
                            <a href="https://twitter.com/intent/tweet?text=Take%20a%20look%20at%20this&amp;url={{url($post->slug)}}"
                               class="row twitter">
                                <div>
                                    <svg>
                                        <use xlink:href="#svg-twitter"></use>
                                    </svg>
                                </div>
                                <span>Tweet</span>
                            </a>
                        </div>
                    </div>

                    <?php $mediaBlocksShown = 0; $adShown = false; ?>
                    @for($i = 0; $i < count($post->blocks); $i++)
                        {!! $post->blocks[$i]->content !!}

                        @if(in_array($post->blocks[$i]->type, ['image', 'embed']))
                            <?php $mediaBlocksShown++; ?>
                        @endif

                        @if($mediaBlocksShown == 1 && !$adShown)
                            <?php $adShown = true; ?>
                            @if(!$preview)
                            <div class="row">
                                <div class="ad-content">
                                    {!! config('custom.pt-in-post') !!}
                                    <span class="ad-disclaimer">ADVERTISEMENT</span>
                                </div>
                            </div>
                            @endif
                        @endif
                    @endfor

                    <div class="row">
                        <div class="ad-content">
                            @if(!$preview)
                                {!! config('custom.pt-leaderboard-btf') !!}
                                <span class="ad-disclaimer">ADVERTISEMENT</span>
                            @endif
                        </div>
                    </div>

                    @if(!$post->is_last_page)
                        <div class="content row">
                            <a href="{{ $nextPageUrl }}" class="btn btn--next-page big">Next Page ></a>
                        </div>
                    @endif

                    <div class="row share-buttons big">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{url($post->slug)}}"
                           class="row facebook" target="_blank">
                            <svg>
                                <use xlink:href="#svg-facebook"></use>
                            </svg>
                            <span>Share On Facebook</span>
                        </a>

                        @if(!$mobile)
                            <a href="https://twitter.com/intent/tweet?text=Take%20a%20look%20at%20this&amp;url={{url($post->slug)}}"
                               class="row twitter" target="_blank">
                                <svg>
                                    <use xlink:href="#svg-twitter"></use>
                                </svg>
                                <span>Share On Twitter</span>
                            </a>
                        @endif
                    </div>
                </div>
            </article>
        </section>

        @if($post->is_last_page)
        <section>
            <article class="item item--post next">
                <div class="content row">
                    <h2>See what's next on {{ ucwords(config('custom.app-domain')) }}</h2>
                    <a href="{{url($nextPost->slug)}}" class="btn btn--next-post big">Next Post</a>
               </div>
           </article>
       </section>
        @endif

        <section>
            <article class="item item--post">
                <div class="content promoted">
                    {!! config('custom.mgid-below-content') !!}
                </div>
            </article>
        </section>

        <section>
            <div class="comments">
                <div class="fb-comments" data-href="{{url($post->slug)}}" data-width="100%" data-numposts="5"></div>
            </div>
        </section>

        <section>
            <h1 class="section-heading">Next Post</h1>

            <article class="item item--big next-post {{ strtolower($nextPost->category->name) }}" id="next-post">
                <div class="item__image-holder">
                    <a href="{{url($nextPost->slug)}}" class="image" id="next-post-url">
                        <figure>
                            <img src="{{$nextPost->image}}" alt="">
                        </figure>
                    </a>
                    <div class="play-btn">
                        <svg viewBox="0 0 60 60">
                          <title>play icon</title>
                          <g>
                            <path class="play" fill="#f1f1f1" d="M24.89,40.84c-0.37,0.22-0.83,0.23-1.2,0.02s-0.6-0.61-0.6-1.04V20.2c0-0.43,0.23-0.83,0.6-1.04
                            c0.37-0.21,0.83-0.21,1.2,0.02l16.35,9.81c0.36,0.21,0.58,0.6,0.58,1.02s-0.22,0.81-0.58,1.02L24.89,40.84z" />
                            <path class="pause hidden" fill="#f1f1f1" d="M28.03,19.06v21.88c0,0.86-0.7,1.56-1.56,1.56h-3.12c-0.86,0-1.56-0.7-1.56-1.56V19.06
                            c0-0.86,0.7-1.56,1.56-1.56h3.12C27.33,17.5,28.03,18.2,28.03,19.06z M38.46,19.06v21.88c0,0.86-0.7,1.56-1.56,1.56h-3.12
                            c-0.86,0-1.56-0.7-1.56-1.56V19.06c0-0.86,0.7-1.56,1.56-1.56h3.12C37.76,17.5,38.46,18.2,38.46,19.06z" />
                            <path class="stroke-bg" fill="none" stroke="#999" stroke-width="4" d="M30,7C17.32,7,7,17.32,7,30
                            c0,12.68,10.32,23,23,23c12.68,0,23-10.32,23-23C53,17.32,42.68,7,30,7z" />
                            <path class="stroke" fill="none" stroke="#f1f1f1" stroke-width="4" d="M30,7C17.32,7,7,17.32,7,30
                            c0,12.68,10.32,23,23,23c12.68,0,23-10.32,23-23C53,17.32,42.68,7,30,7z" />
                        </g>
                    </svg>
                    </div>
                </div>
                <div class="info">
                    <a href="{{url($nextPost->slug)}}">
                        <h1>{{$nextPost->title}}</h1>
                    </a>
                    <p>{{$nextPost->description}}</p>
                    <div class="meta-holder">
                        <div class="meta">
                            <figure class="avatar">
                                <img src="{{$nextPost->author->image}}" alt="">
                            </figure>
                            <div>by <a href="{{url($nextPost->slug)}}" class="author">{{$nextPost->author->name}}</a> on
                                <span class="date">{{ DateTime::createFromFormat('Y-m-d H:i:s', $nextPost->created_at)->format('jS F, Y') }}</span></div>
                            </div>
                            {{-- <a href="{{url($post->slug)}}" class="btn">Read more</a> --}}
                            <div class="row share-buttons small">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{url($nextPost->slug)}}" target="_blank"
                                 class="row facebook">
                                 <div>
                                    <svg>
                                        <use xlink:href="#svg-facebook"></use>
                                    </svg>
                                </div>
                                <span>Share</span>
                            </a>
                            <a href="https://twitter.com/intent/tweet?text=Take%20a%20look%20at%20this&amp;url={{url($nextPost->slug)}}"
                             class="row twitter">
                             <div>
                                <svg>
                                    <use xlink:href="#svg-twitter"></use>
                                </svg>
                            </div>
                            <span>Tweet</span>
                        </a>
                    </div>
                </div>
            </div>
            <a href="{{ url('category/' . strtolower($nextPost->category->name)) }}" class="category">{{ $nextPost->category->name }}</a>

        </article>
        </section>
    </div>

    <aside class="sidebar">
        <div class="row">
            <div class="ad-content">
                @if(!$preview)
                {!! config('custom.pt-sidebar-atf') !!}
                <span class="ad-disclaimer">ADVERTISEMENT</span>
                @else
                    <img src="http://placehold.it/300x600">
                @endif
            </div>
        </div>

        @include('partials.sidebar-articles')

        {{-- <div class="sticky">
            <div class="add">

            </div>

            @include('partials.subscribe')

        </div>--}}

        <div class="sticky sticky--facebook">
            <div class="row">
                <div class="ad-content">
                    @if(!$preview)
                        {!! config('custom.pt-sidebar-btf') !!}
                        <span class="ad-disclaimer">ADVERTISEMENT</span>
                    @else
                        <img src="http://placehold.it/300x250">
                    @endif
                </div>
            </div>
            <div class="fb-page" data-href="{{config('custom.facebook-url')}}" data-height="500" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="{{config('custom.facebook-url')}}" class="fb-xfbml-parse-ignore"><a href="{{config('custom.facebook-url')}}">{{config('custom.app-name')}}</a></blockquote></div>

        </div>

    </aside>
@endsection

@section('js-bottom')
    @if($pageNumber > 1)
        <script src="//go.mobstitialtag.com/notice.php?p=685922&interstitial=1"></script>
    @endif

    <script type="text/javascript">
        $(document).ready(function() {
            $('.content img').each(function() {
                $(this).removeAttr('style');
            })
        });
    </script>
@endsection