@extends('layouts.dashboard')

@section('title', !empty($post) ? ' - Edit: ' . $post->title : ' - New Post')

@section('css')
@endsection

@section('content')
    <div class="row">
        <a href="{{url('dashboard/post/list')}}" class="btn bg-indigo-400 btn-labeled btn-rounded"><b><i class="glyphicon glyphicon-chevron-left"></i></b> All Posts</a><br><br>
    </div>
    <div class="row">
        <div class="col-md-6">
            <!-- Basic layout-->
            <form class="form-horizontal" action="{{ url('dashboard/post' . (!empty($post) ? '/' . $post->id : '')) }}"
                  method="post"
                  enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Post Details</h5>

                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Post Title:</label>

                                <div class="col-lg-9">
                                    <input name="title" type="text" class="form-control"
                                           value="{{ $post->title or '' }}"
                                           placeholder="Enter a title for this post..." required>
                                </div>
                            </div>

                            @if (!empty($post->slug))
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Link:</label>

                                <a class=" col-lg-9 control-label" href="{{url($post->slug)}}">url($post->slug)}}</a>
                            </div>
                            @endif
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Description (tagline):</label>

                                <div class="col-lg-9">
                                    <input name="description" type="text" class="form-control"
                                           value="{{ $post->description or '' }}"
                                           placeholder="Enter a description for this post..." required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">Category:</label>

                                <div class="col-lg-9">
                                    <select id="category" name="category_id" class="form-control" required>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" {{ !empty($post->category_id) && $post->category_id == $category->id ? ' selected' : '' }}>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">Status:</label>

                                <div class="col-lg-9">
                                    <select id="status" name="status" class="form-control select">
                                        <option value="1" {{ !empty($post) && $post->status == 1 ? 'selected' : '' }}>
                                            Enabled
                                        </option>
                                        <option value="0"  {{ !empty($post) && $post->status == 0 ? 'selected' : '' }}>
                                            Pending
                                        </option>
                                        <option value="2" {{ !empty($post) && $post->status == 2 ? 'selected' : '' }}>
                                            Deleted
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary legitRipple">Save Post<i
                                            class="icon-arrow-right14 position-right"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- /basic layout -->
        </div>
        <div class="col-md-6">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Thumbnail</h5>

                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-lg-9">
                                <div class="media no-margin-top">
                                    <div class="media-left">
                                        <a href="#"><img src="{{ asset('assets/dashboard/images/placeholder.jpg') }}" style="width: 58px; height: 58px;" class="img-rounded" alt=""></a>
                                    </div>

                                    <div class="media-body">
                                        <div class="uploader"><input type="file" class="file-styled"><span class="filename" style="-webkit-user-select: none;">No file selected</span><span class="action btn bg-pink-400 legitRipple" style="-webkit-user-select: none;">Choose File</span></div>
                                        <span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js-bottom')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="{{ asset('assets/admin/plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/ckeditor/adapters/jquery.js') }}"></script>
    <script src="//malsup.github.com/jquery.form.js"></script>
    <style>
        #sortable {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        #sortable li {
            margin: 0 3px 3px 3px;
            padding: 0.4em;
            padding-left: 1.5em;
            width: 100%;
            float: left;
            list-style: none
        }

        strong {
            font-weight: bold
        }
    </style>
    <script>
        var blockindex = {{$bcount or 0}};

        function removeBlock(id) {
            $('#sortableli' + id).detach();
        }

        function addBlock() {
            var blocktype = $('#block-type-message').data('block-type');
            var block = null;
            if (blocktype == 'paragraph') {
                block = $($('#textcontent').val());
            } else if (blocktype == 'blockquote') {
                block = $('<blockquote cite="">' + $('#textcontent').val().replace('<p>', '').replace('</p>', '') + '</blockquote>')
            } else if (blocktype == 'youtube') {
                var mc = $('#mediacontent').val().replace('watch', 'embed');
                block = $('<iframe width="640" height="360" src="' + mc + '" frameborder="0" allowfullscreen></iframe>');
            } else if (blocktype == 'html') {
                block = $($('#mediacontent').val());
            } else if (blocktype == 'image-url') {
                var imgsrc = $('#imagesourcecontent').val().replace('<p>', '').replace('</p>', '');
                if (imgsrc.indexOf('</a>') == -1) {
                    imgsrc = '<a href="' + imgsrc + '">' + imgsrc + '</a>';
                }
                block = $('<img src="' + $('#mediacontent').val() + '" alt="" style="width:100%"><span class="source"><span>via:</span>' + imgsrc + '</span>');
            } else if (blocktype == 'image-upload') {
                var imgsrc = $('#imagesourcecontent').val().replace('<p>', '').replace('</p>', '');
                if (imgsrc.indexOf('</a>') == -1) {
                    imgsrc = '<a href="' + imgsrc + '">' + imgsrc + '</a>';
                }
                block = $('<img id="upimage' + blockindex + '" src="" alt="" style="width:100%""><span class="source"><span>via:</span>' + imgsrc + '</span>');
                var tmp_blockindex = blockindex;
                $('#imageuploadform').ajaxForm({
                    dataType: 'json',
                    reference: null,
                    beforeSend: function () {
                    },
                    error: function () {
                        alert("An error occurred while uploading your image");
                    },
                    success: function (data) {
                        if (data.success) {
                            $('#upimage' + tmp_blockindex).attr('src', data.url);
                        } else {
                            alert('An error occurred.');
                            this.error();
                        }
                    }
                });
                $('#imageuploadform').submit();
            }
            var blockdiv = $('<div style="padding-top:10px;float:left;width:93%"></div>');
            var contentdiv = $('<div id="contentdiv' + blockindex + '" contenteditable="true" name="contentdiv[]" style="width:80%;float:left"></div>');
            contentdiv.append(block);
            var closediv = $('<div style="width:20%;float:left"></div>');
            var closebutton = $('<a onclick="removeBlock(' + blockindex + ')" style="float:right;cursor:pointer">x</a>');
            closediv.append(closebutton);
            blockdiv.append(contentdiv);
            blockdiv.append(closediv);
            var sortableli = $('<li id="sortableli' + blockindex + '" class="ui-state-default" style="background-color:white;background-image:none"><span style="float: left;margin-top: 10px; padding-right: 20px; cursor: pointer;">+</span></li>');
            sortableli.append(blockdiv);
            $('#sortable').append(sortableli);
            if (blocktype == 'paragraph') {
                CKEDITOR.inline('contentdiv' + blockindex, {
                    toolbar: [
                        {name: 'basicstyles', groups: ['basicstyles', 'cleanup'], items: ['Bold']},
                        {name: 'links', items: ['Link']},
                        {name: 'styles', items: ['Format']}
                    ],
                    startupFocus: false
                });
            }
            blockindex++;

            $('#cke_textcontent').val("");
            $('#textcontent').val("");
            $('#imagecontent').val("");
            $('#mediacontent').val("");
            $('#imagesource').val("");
        }

        $(document).ready(function () {
            $('#status').change(function () {
                $(this).siblings('.sd-select').find('.sd-label').css('background-color', $('option:selected', this).attr('data-bg'));
            });

            $("#status > option").each(function (i) {
                $('#status').siblings('.sd-select').find('.sd-options > li').eq(i).css('background-color', $(this).attr('data-bg'));
            });

            $('#status').siblings('.sd-select').find('.sd-label').css('background-color', $('option:selected', $('#status')).attr('data-bg'));

            $('.block-type').click(function (e) {
                e.preventDefault();
                $('#block-type-message').text('You are currently creating a block for: "' + $(this).text() + '"');
                $('#block-type-message').data('block-type', $(this).data('block-type'));

                $('#cke_textcontent').hide();
                $('#imagecontent').hide();
                $('#mediacontent').hide();
                $('#imagesource').hide();

                if ($(this).data('block-type') == 'image-upload') {
                    $('#cke_textcontent').hide();
                    $('#imagecontent').show();
                    $('#mediacontent').hide();
                    $('#imagesource').show();
                } else if ($(this).data('block-type') == 'image-url') {
                    $('#cke_textcontent').hide();
                    $('#imagecontent').hide();
                    $('#mediacontent').show();
                    $('#imagesource').show();
                } else if ($(this).data('block-type') == 'youtube') {
                    $('#cke_textcontent').hide();
                    $('#imagecontent').hide();
                    $('#mediacontent').show();
                    $('#imagesource').hide();
                }
                else if ($(this).data('block-type') == 'html') {
                    $('#cke_textcontent').hide();
                    $('#imagecontent').hide();
                    $('#mediacontent').show();
                    $('#imagesource').hide();
                } else {
                    $('#cke_textcontent').show();
                    $('#imagecontent').hide();
                    $('#mediacontent').hide();
                    $('#imagesource').hide();
                }
            });

            $('#serialpost').click(function () {
                $('div[name^="contentdiv"]').each(function () {
                    var blockdata = $(this).html();
                    var pblock = $('<input type="hidden" name="blocks[]" value="">');
                    pblock.val(blockdata);
                    $('#blockcontentdiv').append(pblock);
                });
                $('#submitpost').click();
            });

            $("#sortable").sortable({
                connectWith: 'ul',
                handle: 'span'
            });

            var myToolbar = [
                ['Bold', 'Italic', 'Link', 'Format']
            ];

            var config = {
                toolbar_mySimpleToolbar: myToolbar,
                toolbar: 'mySimpleToolbar'
            };

            $('#textcontent').ckeditor(config);

            myToolbar = [
                ['Link']
            ];

            config = {
                toolbar_mySimpleToolbar: myToolbar,
                toolbar: 'mySimpleToolbar'
            };

            $('#imagesourcecontent').ckeditor(config);

            if (blockindex > 0) {
                for (i = 0; i < blockindex; i++) {
                    if ($('#contentdiv' + i).find('p').html() != null) {
                        CKEDITOR.inline('contentdiv' + i, {
                            toolbar: [
                                {
                                    name: 'basicstyles',
                                    groups: ['basicstyles', 'cleanup'],
                                    items: ['Bold']
                                },
                                {name: 'links', items: ['Link']},
                                {name: 'styles', items: ['Format']}
                            ],
                            startupFocus: false
                        });
                    }
                }
            }
        });
    </script>
@endsection