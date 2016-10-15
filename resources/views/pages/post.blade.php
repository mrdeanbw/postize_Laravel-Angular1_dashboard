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
            <article class="item item--post item--top news">

                <figure class="top-image">
                    <img src="{{$post->image}}" alt="">
                </figure>

                <div class="content">
                    <h1 class="post-title">{{$post->title}}</h1>

                    <div class="row">
                        <div class="ad-content">
                            <ins class="adsbygoogle"
                                 style="display:inline-block;width:300px;height:250px"
                                 data-ad-client="ca-pub-1766805469808808"
                                 data-ad-slot="2336573377"></ins>
                            <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
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
                        @if(!$mobile)
                            <div class="row share-buttons small">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{url($post->slug)}}"
                                   target="_blank"
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
                        @endif
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
                                        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                        <!-- PT_InPost_300x250_2 -->
                                        <ins class="adsbygoogle"
                                             style="display:inline-block;width:300px;height:250px"
                                             data-ad-client="ca-pub-1766805469808808"
                                             data-ad-slot="7826864976"></ins>
                                        <script>
                                            (adsbygoogle = window.adsbygoogle || []).push({});
                                        </script>
                                        <span class="ad-disclaimer">ADVERTISEMENT</span>
                                    </div>
                                </div>
                            @endif
                        @endif
                    @endfor

                    <div class="row">
                        <div class="ad-content">
                            @if(!$preview)
                                @if($mobile)
                                    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                    <!-- PT_Leaderboard_BTF_300x250 -->
                                    <ins class="adsbygoogle"
                                         style="display:inline-block;width:300px;height:250px"
                                         data-ad-client="ca-pub-1766805469808808"
                                         data-ad-slot="3534656977"></ins>
                                    <script>
                                        (adsbygoogle = window.adsbygoogle || []).push({});
                                    </script>
                                @else
                                    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                    <!-- PT_Leaderboard_BTF_728x90 -->
                                    <ins class="adsbygoogle"
                                         style="display:inline-block;width:728px;height:90px"
                                         data-ad-client="ca-pub-1766805469808808"
                                         data-ad-slot="2177946578"></ins>
                                    <script>
                                        (adsbygoogle = window.adsbygoogle || []).push({});
                                    </script>
                                @endif
                                <span class="ad-disclaimer">ADVERTISEMENT</span>
                            @endif
                        </div>
                    </div>

                    @if(!$post->is_last_page)
                        <div class="content row">
                            <a href="{{ $nextPageUrl }}" class="btn btn--next-page big">Next Page ></a>
                        </div>
                    @else
                        <div class="content row">
                            <a href="{{ url($nextPost->slug) }}" class="btn btn--next-page big">Next Post ></a>
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

        <section>
            <article class="item item--post">
                <div class="content promoted">
                    <div id="rcjsload_d38057"></div>
                    <script type="text/javascript">
                        (function() {
                            var referer="";try{if(referer=document.referrer,"undefined"==typeof referer)throw"undefined"}catch(exception){referer=document.location.href,(""==referer||"undefined"==typeof referer)&&(referer=document.URL)}referer=referer.substr(0,700);
                            var rcel = document.createElement("script");
                            rcel.id = 'rc_' + Math.floor(Math.random() * 1000);
                            rcel.type = 'text/javascript';
                            rcel.src = "http://trends.revcontent.com/serve.js.php?w=17087&t="+rcel.id+"&c="+(new Date()).getTime()+"&width="+(window.outerWidth || document.documentElement.clientWidth)+"&referer="+referer;
                            rcel.async = true;
                            var rcds = document.getElementById("rcjsload_d38057"); rcds.appendChild(rcel);
                        })();
                    </script>
                </div>
            </article>
        </section>

        <section>
            <div id="fc_2507917978"></div>
            <script type="text/javascript">
                (function (d,c) {
                    var s = d.createElement('script');
                    s.type = 'text/javascript';
                    s.src = 'https://a.rfgsi.com/v2/banner?fc_id=fc_2507917978&si_id=355&se_id=589';
                    s.async = true;
                    d.getElementById(c).appendChild(s);
                })(document, 'fc_2507917978');
            </script>
        </section>
        <section>
            <div class="comments">
                <div class="fb-comments" data-href="{{url($post->slug)}}" data-width="100%" data-numposts="5"></div>
            </div>
        </section>

        <section>
            <h1 class="section-heading">Next Post</h1>

            <article class="item item--big next-post {{ strtolower($nextPost->category_name) }}" id="next-post">
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
                            c0.37-0.21,0.83-0.21,1.2,0.02l16.35,9.81c0.36,0.21,0.58,0.6,0.58,1.02s-0.22,0.81-0.58,1.02L24.89,40.84z"/>
                                <path class="pause hidden" fill="#f1f1f1" d="M28.03,19.06v21.88c0,0.86-0.7,1.56-1.56,1.56h-3.12c-0.86,0-1.56-0.7-1.56-1.56V19.06
                            c0-0.86,0.7-1.56,1.56-1.56h3.12C27.33,17.5,28.03,18.2,28.03,19.06z M38.46,19.06v21.88c0,0.86-0.7,1.56-1.56,1.56h-3.12
                            c-0.86,0-1.56-0.7-1.56-1.56V19.06c0-0.86,0.7-1.56,1.56-1.56h3.12C37.76,17.5,38.46,18.2,38.46,19.06z"/>
                                <path class="stroke-bg" fill="none" stroke="#999" stroke-width="4" d="M30,7C17.32,7,7,17.32,7,30
                            c0,12.68,10.32,23,23,23c12.68,0,23-10.32,23-23C53,17.32,42.68,7,30,7z"/>
                                <path class="stroke" fill="none" stroke="#f1f1f1" stroke-width="4" d="M30,7C17.32,7,7,17.32,7,30
                            c0,12.68,10.32,23,23,23c12.68,0,23-10.32,23-23C53,17.32,42.68,7,30,7z"/>
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
                                <img src="{{$nextPost->author_image}}" alt="">
                            </figure>
                            <div>by <a href="{{url($nextPost->slug)}}" class="author">{{$nextPost->author_name}}</a>
                            </div>
                        </div>
                        {{-- <a href="{{url($post->slug)}}" class="btn">Read more</a> --}}
                        <div class="row share-buttons small">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{url($nextPost->slug)}}"
                               target="_blank"
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
                <a href="{{ url('category/' . strtolower($nextPost->category_name)) }}"
                   class="category">{{ $nextPost->category_name }}</a>

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

        <div class="sticky">
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
            @if(!$preview)
                <div class="row">
                    <div class="ad-content">
                        <div id="rcjsload_b1bdc5"></div>
                        <script type="text/javascript">
                            (function() {
                                var referer="";try{if(referer=document.referrer,"undefined"==typeof referer)throw"undefined"}catch(exception){referer=document.location.href,(""==referer||"undefined"==typeof referer)&&(referer=document.URL)}referer=referer.substr(0,700);
                                var rcel = document.createElement("script");
                                rcel.id = 'rc_' + Math.floor(Math.random() * 1000);
                                rcel.type = 'text/javascript';
                                rcel.src = "http://trends.revcontent.com/serve.js.php?w=17088&t="+rcel.id+"&c="+(new Date()).getTime()+"&width="+(window.outerWidth || document.documentElement.clientWidth)+"&referer="+referer;
                                rcel.async = true;
                                var rcds = document.getElementById("rcjsload_b1bdc5"); rcds.appendChild(rcel);
                            })();
                        </script>
                    </div>
                </div>
            @endif
        </div>

    </aside>
@endsection

@section('js-bottom')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.content img').each(function () {
                $(this).removeAttr('style');
            })
        });
    </script>
@endsection