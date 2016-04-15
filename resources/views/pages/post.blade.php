@extends('layouts.main')

@section('css')
    <style type="text/css">
        .content h2 {
            font-size: 30px;
            margin-top: 35px;
        }

        .content img {
            width: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="page">

        <section>
            <article class="item item--post news">

                <figure class="top-image">
                    <img src="{{$post->image}}" alt="">
                </figure>

                <div class="content">
                    <h1>{{$post->title}}</h1>

                    <div class="meta-holder">
                        <div class="meta">
                            <figure class="avatar">
                                <img src="{{ $post->author->image }}" alt="">
                            </figure>
                            <div>by <a href="" class="author">{{$post->author->name}}</a> on <span class="date">
								{{ (new DateTime($post->created_at))->format('m M, Y') }}
							</span></div>
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

                    {{--<div class="tags">
                        <span>Topics</span>
                        <a href="">Candy maker</a>
                        <a href="">Confectioner</a>
                        <a href="">Guinnes World Records</a>
                        <a href="">Holocaust survivor</a>
                        <a href="">Israel</a>
                    </div>--}}
                    <?php $imagesShown = 0; ?>
                    @for($i = 0; $i < count($post->blocks); $i++)
                        {!! $post->blocks[$i] !!}

                        @if(strpos($post->blocks[$i], '<img ') !== false && strpos($post->blocks[$i], 'src="http://postize.com') !== false)
                            <?php $imagesShown++; ?>
                        @endif

                        @if($imagesShown == 2)
                            <div class="row">
                                <div class="ad-content">
                                    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                    <ins class="adsbygoogle"
                                         style="display:inline-block;width:300px;height:250px"
                                         data-ad-client="ca-pub-1766805469808808"
                                         data-ad-slot="9667310973"></ins>
                                    <script>
                                        (adsbygoogle = window.adsbygoogle || []).push({});
                                    </script>
                                    <span class="ad-disclaimer">ADVERTISEMENT</span>
                                </div>
                            </div>
                        @endif
                    @endfor

                    <div class="row share-buttons big">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{url($post->slug)}}"
                           class="row facebook">
                            <svg>
                                <use xlink:href="#svg-facebook"></use>
                            </svg>
                            <span>Share On Facebook</span>
                        </a>
                        <a href="https://twitter.com/intent/tweet?text=Take%20a%20look%20at%20this&amp;url={{url($post->slug)}}"
                           class="row twitter">
                            <svg>
                                <use xlink:href="#svg-twitter"></use>
                            </svg>
                            <span>Share On Twitter</span>
                        </a>
                    </div>

                    <div class="row">
                        <div class="ad-content">
                            @if($mobile)
                                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                <ins class="adsbygoogle"
                                     style="display:inline-block;width:300px;height:250px"
                                     data-ad-client="ca-pub-1766805469808808"
                                     data-ad-slot="9667310973"></ins>
                                <script>
                                    (adsbygoogle = window.adsbygoogle || []).push({});
                                </script>

                            @else
                                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                <ins class="adsbygoogle"
                                     style="display:inline-block;width:728px;height:90px"
                                     data-ad-client="ca-pub-1766805469808808"
                                     data-ad-slot="2177946578"></ins>
                                <script>
                                    (adsbygoogle = window.adsbygoogle || []).push({});
                                </script>
                            @endif
                            <span class="ad-disclaimer">ADVERTISEMENT</span>
                        </div>
                    </div>
                </div>
            </article>

            {{--<div class="siblings row">
                <div class="pn">
                    <a href="">
                        <span class="p">Previous Post</span>

                        <div class="row">
                            <figure>
                                <img src="assets/front/img/thumb300.jpg" alt="">
                            </figure>
                            <h2>Amazon Will Be Opening Their Second Amazon</h2>
                        </div>
                    </a>
                </div>
                <div class="pn">
                    <a href="">
                        <span class="n">Next Post</span>

                        <div class="row">
                            <figure>
                                <img src="assets/front/img/thumb300.jpg" alt="">
                            </figure>
                            <h2>Physical Bookstore In San Diego Physical</h2>
                        </div>
                    </a>
                </div>
            </div>--}}

        </section>
        <section>
            <div id="rcjsload_c437be"></div>
            <script type="text/javascript">
                (function () {
                    var referer = "";
                    try {
                        if (referer = document.referrer, "undefined" == typeof referer)throw"undefined"
                    } catch (exception) {
                        referer = document.location.href, ("" == referer || "undefined" == typeof referer) && (referer = document.URL)
                    }
                    referer = referer.substr(0, 700);
                    var rcel = document.createElement("script");
                    rcel.id = 'rc_' + Math.floor(Math.random() * 1000);
                    rcel.type = 'text/javascript';
                    rcel.src = "http://trends.revcontent.com/serve.js.php?w=17087&t=" + rcel.id + "&c=" + (new Date()).getTime() + "&width=" + (window.outerWidth || document.documentElement.clientWidth) + "&referer=" + referer;
                    rcel.async = true;
                    var rcds = document.getElementById("rcjsload_c437be");
                    rcds.appendChild(rcel);
                })();
            </script>
        </section>
        <section>
            <h1 class="section-heading">Related stories:</h1>

            <div class="articles fill-content">
                @include('partials.related')
            </div>

            {{-- Load related posts of the same category
            <span href="" class="btn load" data-action="related" data-category="1">Load more</span>
            --}}
        </section>

        <section>
            <div class="comments">
                <div class="fb-comments" data-href="{{url($post->slug)}}" data-width="100%" data-numposts="5"></div>
            </div>
        </section>
    </div>

    <aside class="sidebar">

        {{--<div class="add">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <ins class="adsbygoogle"
                 style="display:inline-block;width:300px;height:250px"
                 data-ad-client="ca-pub-1766805469808808"
                 data-ad-slot="9667310973"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>--}}

        @include('partials.sidebar-articles')

        <div class="sticky">
            <div class="add">
                <div id="rcjsload_3bbf6e"></div>
                <script type="text/javascript">
                    (function () {
                        var referer = "";
                        try {
                            if (referer = document.referrer, "undefined" == typeof referer)throw"undefined"
                        } catch (exception) {
                            referer = document.location.href, ("" == referer || "undefined" == typeof referer) && (referer = document.URL)
                        }
                        referer = referer.substr(0, 700);
                        var rcel = document.createElement("script");
                        rcel.id = 'rc_' + Math.floor(Math.random() * 1000);
                        rcel.type = 'text/javascript';
                        rcel.src = "http://trends.revcontent.com/serve.js.php?w=17088&t=" + rcel.id + "&c=" + (new Date()).getTime() + "&width=" + (window.outerWidth || document.documentElement.clientWidth) + "&referer=" + referer;
                        rcel.async = true;
                        var rcds = document.getElementById("rcjsload_3bbf6e");
                        rcds.appendChild(rcel);
                    })();
                </script>
            </div>
            {{--@include('partials.subscribe')--}}
        </div>

    </aside>
@endsection

@section('js-bottom')
    <style>
        strong {
            font-weight: bold
        }
    </style>
@endsection  