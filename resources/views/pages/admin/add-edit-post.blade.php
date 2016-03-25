@extends('layouts.main')

@section('js-top')
    <script src="{{ asset('assets/admin/plugins/tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init(
                {
                    selector: 'textarea',
                    tools: "inserttable",
                    plugins: "pagebreak hr link lists preview searchreplace table wordcount code contextmenu image media spellchecker visualblocks imagetools paste",
                    contextmenu: "link image inserttable | cell row column deletetable spellchecker",
                    image_advtab: true,
                    menubar1: 'insert',
                    toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                    toolbar2: 'print preview media | forecolor backcolor emoticons pagebreak',
                    paste_data_images: true,
                    pagebreak_separator: '<!--nextpage-->',
                    convert_urls: false
                });</script>
@endsection

@section('content')
    <div class="landing">

        <section class="content">
            <form action="{{ url('dashboard/post' . (!empty($post) ? '/' . $post->id : '')) }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <h1 class="section-heading">Add/Edit Post</h1>

            <p>
                <span>Title</span>
			<span><input id="title" name="title" type="text" placeholder="Create your title here..."
                         value="{{$post->title or ''}}" required/></span>
            </p>

            <p>
                <span>Permalink</span>
                <br/>
			<span>
				<a href="{{!empty($post->slug) ? url($post->slug) : 'None yet'}}">
                    {{!empty($post->slug) ? url($post->slug) : 'None yet'}}
                </a>
			</span>
            </p>

            <p>
                <span>Category: </span>
			<span>
				<select id="category" name="category_id" class="form-control">
                    <option value="0">No category selected</option>
                    @foreach($categories as $category)
                        <option value="{{$category->code}}" {{ !empty($post->category) && $post->category == $category->code ? ' selected' : '' }}>{{$category->name}}</option>
                    @endforeach
                </select>
			</span>
            </p>

            <p>
                <span>Description (Facebook caption)</span>
			<span>
                <input id="description" name="description" type="text" value="{{$post->description or ''}}"
                       placeholder="Enter description here..." class="form-control input-md" required=""/>
			</span>
            </p>

            <p>
                <span>Status: </span>

                <span>
                                        <select id="status" name="status" class="form-control">
                                            <option value="1" data-bg="#A2FACB"
                                                    style="background-color: #A2FACB" {{ !empty($post) && $post->status == 1 ? 'selected' : '' }}>
                                                Enabled
                                            </option>
                                            <option value="0" data-bg="#f7e1b5"
                                                    style="background-color: #f7e1b5" {{ !empty($post) && $post->status == 0 ? 'selected' : '' }}>
                                                Pending
                                            </option>
                                            <option value="2" data-bg="#F799B1"
                                                    style="background-color: #F799B1" {{ !empty($post) && $post->status == 2 ? 'selected' : '' }}>
                                                Deleted
                                            </option>
                                        </select>
                </span>
            </p>

            <p>
                <span>Thumbnail</span><br />
                <span>@if(!empty($post->image))
                        <span>Current Image:</span><br/>
                        <img src="{{$post->image}}" style="width:100px;height:100px;"/><br/><br/>
                    @endif
                    Upload a new thumbnail: <input id="image" name="image" class="form-control" type="file"><br/>
                    Or enter the URL of an image to use as the thumbnail:
                    <input id="image_url" name="image_url" type="text"
                           placeholder="(Optional) Paste an image URL here..."
                           class="form-control" value="{{$post->image or ''}}"></span>
            </p>

            <p>
                <textarea name="content"
                          rows="40">{{ $post->content or '' }}</textarea>
            </p>

            <input type="submit"/>
            </form>
        </section>

    </div>

@endsection

@section('js-bottom')
    <script>
        $(document).ready(function () {
            $('#status').change(function() {
                $(this).css('background-color', $('option:selected', this).attr('data-bg'));
            });

            $('#status').css('background-color', $('option:selected', $('#status')).attr('data-bg'));
        });
    </script>
@endsection