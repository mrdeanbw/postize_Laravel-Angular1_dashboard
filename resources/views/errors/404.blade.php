@extends('layouts.main')

@section('content')
<div class="landing">

    <section class="content center">
        <h1 class="section-heading big">404</h1>

        <h2>There is nothing here.</h2>

        <img src="{!! asset('assets/front/img/404.gif') !!}" alt="">

    </section>

    <section class="content center">
        <h2>You may like some of the top posts on Postize.com</h2>

        <div class="articles articles--search">
            @include('partials.top-stories')
        </div>    
    </section>

</div>

@endsection  