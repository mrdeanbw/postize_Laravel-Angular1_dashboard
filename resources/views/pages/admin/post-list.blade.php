@extends('layouts.dashboard')

@section('title', 'Manage Posts')

@section('css')
@endsection

@section('content')
    <div class="panel panel-flat" id="data">
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped datatable-basic">

                    <thead>
                    <th>ID</th>
                    <th>Thumbnail</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Author</th>
                    <th>Actions</th>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{$post->id}}</td>
                            <td><img src="{{$post->image}}"
                                     style="border-radius:3px; border:1px solid black; width:156px; height:100px;"/>
                            </td>
                            <td style="font-size: 20px">{{$post->title}}</td>
                            <td>{{$post->description}}</td>
                            <td>{{$post->category_name}}</td>
                            <td style="text-align:center;font-weight:bold;background-color: {{$post->status == 1 ? '#D9FFDE' : '#FFFCD9' }}">{{$post->status == 1 ? 'Published' : 'Pending' }}</td>
                            <td>{{$post->author_name}}</td>
                            <td><a href="{{url('dashboard/post/' . $post->id) }}" class="btn">Edit</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js-bottom')
    <script>
        $(document).ready(function () {
            $('.datatable-basic').DataTable({
                autoWidth: false,
                dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
                language: {
                    search: '<span>Filter:</span> _INPUT_',
                    lengthMenu: '<span>Show:</span> _MENU_',
                    paginate: {'first': 'First', 'last': 'Last', 'next': '→', 'previous': '←'}
                },
                drawCallback: function () {
                    $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
                },
                preDrawCallback: function () {
                    $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
                }
            });

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
