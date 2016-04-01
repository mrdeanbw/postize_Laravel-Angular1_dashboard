@extends('layouts.main')

@section('css')
    <style type="text/css">
        .landing {
            background-color: white;
            padding-left: 20px;
            padding-right: 20px;
        }

        .landing input {
            border: 1px solid black;
        }

        .landing select {
            border: 1px solid black;
        }

        .content h2 {
            font-size: 30px;
            margin-top: 35px;
        }

        tr, th {
            border: 1px solid #000
        }

        .post-table {
            margin: 0px;
            padding: 0px;
            width: 100%;
            box-shadow: 10px 10px 5px #888888;
            border: 1px solid #000000;

            -moz-border-radius-bottomleft: 0px;
            -webkit-border-bottom-left-radius: 0px;
            border-bottom-left-radius: 0px;

            -moz-border-radius-bottomright: 0px;
            -webkit-border-bottom-right-radius: 0px;
            border-bottom-right-radius: 0px;

            -moz-border-radius-topright: 0px;
            -webkit-border-top-right-radius: 0px;
            border-top-right-radius: 0px;

            -moz-border-radius-topleft: 0px;
            -webkit-border-top-left-radius: 0px;
            border-top-left-radius: 0px;
        }

        .post-table table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            height: 100%;
            margin: 0px;
            padding: 0px;
        }

        .post-table tr:last-child td:last-child {
            -moz-border-radius-bottomright: 0px;
            -webkit-border-bottom-right-radius: 0px;
            border-bottom-right-radius: 0px;
        }

        .post-table table tr:first-child td:first-child {
            -moz-border-radius-topleft: 0px;
            -webkit-border-top-left-radius: 0px;
            border-top-left-radius: 0px;
        }

        .post-table table tr:first-child td:last-child {
            -moz-border-radius-topright: 0px;
            -webkit-border-top-right-radius: 0px;
            border-top-right-radius: 0px;
        }

        .post-table tr:last-child td:first-child {
            -moz-border-radius-bottomleft: 0px;
            -webkit-border-bottom-left-radius: 0px;
            border-bottom-left-radius: 0px;
        }

        .post-table tr:hover td {

        }

        .post-table tr:nth-child(odd) {
            background-color: #d1e8ff;
        }

        .post-table tr:nth-child(even) {
            background-color: #ffffff;
        }

        .post-table td {
            vertical-align: middle;

            border: 1px solid #000000;
            border-width: 0px 1px 1px 0px;
            text-align: left;
            padding: 10px;
            font-size: 16px;
            font-family: Arial;
            font-weight: normal;
            color: #000000;
        }

        .post-table tr:last-child td {
            border-width: 0px 1px 0px 0px;
        }

        .post-table tr td:last-child {
            border-width: 0px 0px 1px 0px;
        }

        .post-table tr:last-child td:last-child {
            border-width: 0px 0px 0px 0px;
        }

        .post-table tr:first-child td {
            background: -o-linear-gradient(bottom, #005fbf 5%, #003f7f 100%);
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0.05, #005fbf), color-stop(1, #003f7f));
            background: -moz-linear-gradient(center top, #005fbf 5%, #003f7f 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#005fbf", endColorstr="#003f7f");
            background: -o-linear-gradient(top, #005fbf, 003 f7f);

            background-color: #005fbf;
            border: 0px solid #000000;
            text-align: center;
            border-width: 0px 0px 1px 1px;
            font-size: 14px;
            font-family: Arial;
            font-weight: bold;
            color: #ffffff;
        }

        .post-table tr:first-child:hover td {
            background: -o-linear-gradient(bottom, #005fbf 5%, #003f7f 100%);
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0.05, #005fbf), color-stop(1, #003f7f));
            background: -moz-linear-gradient(center top, #005fbf 5%, #003f7f 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#005fbf", endColorstr="#003f7f");
            background: -o-linear-gradient(top, #005fbf, 003 f7f);

            background-color: #005fbf;
        }

        .post-table tr:first-child td:first-child {
            border-width: 0px 0px 1px 0px;
        }

        .post-table tr:first-child td:last-child {
            border-width: 0px 0px 1px 1px;
        }
    </style>
@endsection

@section('content')
    <div class="landing">

        <section class="content">
            <h1 class="section-heading">Manage Posts</h1>
            <a href="{{url('dashboard/post') }}" class="btn" style="margin-bottom: 20px; width: 300px; color: #fff">Create Post</a>

            <table id="post-table" class="post-table">
                <tr>
                    <td>ID</td>
                    <td>Thumbnail</td>
                    <td>Title</td>
                    <td>Description</td>
                    <td>Category</td>
                    <td>Status</td>
                    <td>Author</td>
                    <td>Actions</td>
                </tr>
                @foreach($posts as $post)
                    <tr>
                        <td>{{$post->id}}</td>
                        <td><img src="{{$post->image}}" style="border-radius:3px; border:1px solid black; width:156px; height:100px;" /></td>
                        <td style="font-size: 20px">{{$post->title}}</td>
                        <td>{{$post->description}}</td>
                        <td>{{$post->category_name}}</td>
                        <td style="text-align:center;font-weight:bold;background-color: {{$post->status == 1 ? '#D9FFDE' : '#FFFCD9' }}">{{$post->status == 1 ? 'Published' : 'Pending' }}</td>
                        <td>{{$post->author_name}}</td>
                        <td><a href="{{url('dashboard/post/' . $post->id) }}" class="btn">Edit</a></td>
                    </tr>
                @endforeach
            </table>
        </section>
    </div>
@endsection

@section('js-bottom')
    <script>
        $(document).ready(function () {
            $('.delete-post').click(function (e) {
                e.preventDefault();

                var post = $(this).attr('data-post-id');
                $(this).parent().append('<img class="loading" src="{{ asset("assets/img/loading.gif") }}" />');
                $.ajaxSetup({
                    headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
                });
                $.ajax({
                    type: "POST",
                    url: "{{ url('dashboard/post/delete') }}",
                    cache: false,
                    context: this,
                    data: {
                        postId: post,
                    },

                    success: function (data) {

                        $(this).parent().children('img').remove();
                        $(this).parent().parent().remove();
                        alert(data);

                    },
                    error: function (response) {

                        $(this).parent().children('img').remove();
                        alert(response);
                    },


                });

            });
        });


    </script>
@endsection
