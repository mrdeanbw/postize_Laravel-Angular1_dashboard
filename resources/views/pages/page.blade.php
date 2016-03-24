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
    
        @include('partials.you-may-like')

        <span href="" class="btn load">Load more</span>
    </section>

</div>

<aside class="sidebar">

    <div class="add">
        <a href="">
            <img src="{!! asset('assets/front/img/300.jpg') !!}" alt="">
        </a>
    </div>

    @include('partials.sidebar-articles')

    <div class="add sticky">
        <a href="">
            <img src="{!! asset('assets/front/img/300.jpg') !!}" alt="">
        </a>
    </div>
    
    @include('partials.subscribe')
    
</aside>
@endsection  