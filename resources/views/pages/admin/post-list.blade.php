@extends('layouts.dashboard')

@section('title', '- Manage Posts')

@section('css')
@endsection

@section('content')
    <div class="row">
        <a href="{{url('dashboard/post')}}" class="btn bg-indigo-400 btn-labeled btn-rounded"><b><i class="glyphicon glyphicon-plus"></i></b> Create Post</a><br><br>
    </div>

    <div class="panel panel-flat" id="data">
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table tasks-list table-lg postizePostList">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Thumbnail</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Author</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{$post->id}}</td>
                            <td><img src="{{$post->image}}" class="postizeListThumb"></td>
                            <td>
                                <h4>{{$post->title}}</h4>
                                {{$post->description}}
                            </td>
                            <td>
                                <span class="label border-left-violet label-striped">{{$post->category_name}}</span>
                            </td>
                            <td class="text-center postizeStatusWrap">
                                @if($post->status == \App\Models\PostStatus::Enabled)
                                    <i class="icon-checkmark-circle text-success" data-popup="tooltip" title="" data-original-title="Published"></i><br>
                                @else
                                    <i class="icon-question4 text-info" data-popup="tooltip" title="" data-original-title="Ready For Review"></i><br>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($post->author_image)
                                    <img src="{{$post->author_image}}" class="img-circle img-md" alt="" data-popup="tooltip" title="" data-original-title="{{$post->author_name}}">
                                @else
                                    <span class="label label-flat border-indigo text-indigo-600">{{$post->author_name}}</span>
                                @endif
                            </td>
                            <td>
                                @if(Auth::user()->type == 1 || $post->user_id == Auth::user()->id)
                                <a href="{{url('dashboard/post/' . $post->id) }}" class="btn bg-indigo-400 btn-labeled btn-rounded"><b><i class="glyphicon glyphicon-edit"></i></b> Edit</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="text-center">{!! $posts->links() !!}</div>
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
