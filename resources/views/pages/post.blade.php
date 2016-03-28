@extends('layouts.main')

@section('css')
    <style type="text/css">
        .content h2 {
            font-size: 30px;
            margin-top: 35px;
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

                    @foreach($post->blocks as $block)
                        {!! $block !!}
                    @endforeach

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

@section('js-bottom')
    <style>
        strong {
            font-weight: bold
        }
    </style>
@endsection  