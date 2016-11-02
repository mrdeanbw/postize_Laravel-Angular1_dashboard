@extends('layouts.dashboard')

@section('title', '')
@section('css')

@endsection

@section('content')
    @foreach($users as $user)
        @if(!empty($user->posts))
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-info panel-bordered">
                        <div class="panel-heading">
                            <h6 class="panel-title">Writing Activity - {{ $user->name }}<a
                                        class="heading-elements-toggle"><i
                                            class="icon-more"></i></a></h6>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Image</th>
                                        <th>Title</th>
                                        <th class="text-center">Created</th>
                                        <th class="text-center">Sessions</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($user->posts as $post)
                                        <tr>
                                            <td class="text-center">
                                                <img src="{{ $post['image'] }}" class="img-circle img-sm" />
                                            </td>
                                            <td>
                                                <a href="{{ url($post['slug']) }}">{{ $post['title'] }}</a>  |  <a href="{{url('dashboard/post/' . $post['id'])}}"> (edit)</a>
                                            </td>
                                            <td>{{ \App\Models\DateTimeExtensions::toRelative($post['created_at']) }}</td>
                                            <td>
                                                {{ $post['analytics'][1] }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endsection

<!--js bottom-->
@section('js-bottom')
@endsection
