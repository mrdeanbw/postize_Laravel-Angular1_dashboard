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
    </style>
@endsection
@section('content')
    <div class="landing">

        <section class="content">
            <form action="{{ url('dashboard/post' . (!empty($post) ? '/' . $post->id : '')) }}" method="post"
                  enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <h1 class="section-heading">Add/Edit Post</h1>

                <div class="field-set">
                    <label for="title">Title:</label>

                    <div class="field">
                        <input id="title" name="title" type="text" placeholder="Create your title here..."
                               value="{{$post->title or ''}}" required/>
                    </div>
                </div>
                <div class="field-set">
                    <label>Permalink:</label>

                    <div class="field">
                        <a href="{{!empty($post->slug) ? url($post->slug) : 'None yet'}}">
                            {{!empty($post->slug) ? url($post->slug) : 'None yet'}}
                        </a>
                    </div>
                </div>

                <div class="field-set">
                    <label for="description">Description (Facebook caption):</label>

                    <div class="field">
                        <input id="description" name="description" type="text" value="{{$post->description or ''}}"
                               placeholder="Enter description here..." class="form-control input-md" required=""/>
                    </div>
                </div>


                <div class="field-set">
                    <label for="category">Category:</label>
                    <select id="category" name="category_id" class="form-control" required>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" {{ !empty($post->category_id) && $post->category_id == $category->id ? ' selected' : '' }}>{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="field-set row">
                    <label>Status: </label>
                    <select id="status" name="status" class="form-control select">
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
                </div>

                <div class="field-set">

                    @if(!empty($post->image))
                        <label>Current Thumbnail:</label>
                        <div class="field">
                            <a target="_blank" href="{{$post->image}}"> <img src="{{$post->image}}"
                                                                             style="width:150px;height:150px;"/>
                            </a>
                        </div>
                    @endif

                    <label for="image">No thumbnail yet, upload one below.</label>


                    <div class="field">
                        <input id="image" name="image" class="form-control" type="file">
                    </div>

                    <label for="image_url">Or enter the URL of an image to use as the thumbnail:</label>

                    <div class="field">
                        <input id="image_url" name="image_url" type="text"
                               placeholder="(Optional) Paste an image URL here..." class="form-control"
                               value="{{$post->image or ''}}">
                    </div>
                </div>
                <div class="field-set third" style="margin-top:5px">
                    <input id="serialpost" type="button" class="btn" value="Save Post"/>
                </div>
                <h1>Content Blocks</h1>

                <div id="blockcontentdiv">

                </div>
                <input id="submitpost" type="submit" class="btn" style="display:none"/>
            </form>
            <div class="field-set" style="width:100%;float:left">
                <div class="field" style="width:100%;float:left">
                    <div style="width:100%;float:left;padding-left:10px;padding-right:10px;">
                        <div style="width:30%;float:left;">
                            <span>Choose a type of block:</span>
                            <br />
                            <select id="blocktype" style="margin-top: 40px">
                                <option value="p">Paragraph / Big Bold Text</option>
                                <option value="quoteblock">Block Quote</option>
                                <option value="imageurl">Image (Paste URL)</option>
                                <option value="imageupload">Image (Upload file)</option>
                                <option value="youtube">Youtube Links Only</option>
                                <option value="html">Embeds (Instagram/Twitter)</option>
                            </select>
                        </div>
                        <div style="width:50%;float:left;padding-left:10px;padding-right:10px;" id="blockcontentdiv">
                            <textarea id="textcontent" name="textcontent" style="height:100px"></textarea>
                            <input id="mediacontent" type="text" name="mediacontent" style="display:none">

                            <form id="imageuploadform" action="{{ url('dashboard/post/uploadimage') }}" method="post">
                                <input id="imagecontent" type="file" name="imagecontent" style="display:none">
                            </form>
                            <div id="imagesource" style="display:none">
                                <textarea id="imagesourcecontent" name="imagesourcecontent"
                                          style="height:20px;display:none"></textarea>
                            </div>
                        </div>
                        <div style="width:20%;float:left;padding-left:10px;padding-right:10px;">
                            <input type="button" class="btn" value="Add" onclick="addBlock()">
                        </div>
                    </div>
                </div>
            </div>

            <div style="width:100%">
                <p>Preview</p>
            </div>

            <div id="preview" class="field-set">
                <ul id="sortable">
                    @if($post != null)
                        @for($bcount = 0; $bcount < count($post->blocks); $bcount++)
                            <li id="sortableli{{$bcount}}" class="ui-state-default"
                                style="background-color:white;background-image:none">
                                <span style="float: left;margin-top: 10px; padding-right: 20px; cursor: pointer;">+</span>

                                <div style="padding-top:10px;float:left;width:93%">
                                    <div id="contentdiv{{$bcount}}" contenteditable="true" name="contentdiv[]"
                                         style="width:80%;float:left">
                                        {!! $post->blocks[$bcount] !!}
                                    </div>
                                    <div style="width:20%;float:left">
                                        <a onclick="removeBlock({{$bcount}})" style="float:right;cursor:pointer">x</a>
                                    </div>
                                </div>
                            </li>
                        @endfor
                    @endif
                </ul>
            </div>

            <br /><br />
            <div class="field-set third" style="margin-top:20px">
                <input id="serialpost" type="button" class="btn" value="Save Post"/>
            </div>

        </section>

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
            var blocktype = $('#blocktype').val();
            var block = null;
            if (blocktype == 'p') {
                block = $($('#textcontent').val());
            } else if (blocktype == 'quoteblock') {
                block = $('<blockquote cite="http://www.worldwildlife.org/who/index.html">' + $('#textcontent').val().replace('<p>', '').replace('</p>', '') + '</blockquote>')
            } else if (blocktype == 'youtube') {
                var mc = $('#mediacontent').val().replace('watch', 'embed');
                block = $('<iframe width="640" height="360" src="' + mc + '" frameborder="0" allowfullscreen></iframe>');
            } else if (blocktype == 'html') {
                alert($('#textcontent').val());
                    block = $($('#mediacontent').val());
            } else if (blocktype == 'imageurl') {
                var imgsrc = $('#imagesourcecontent').val().replace('<p>', '').replace('</p>', '');
                if (imgsrc.indexOf('</a>') == -1) {
                    imgsrc = '<a href="">' + imgsrc + '</a>';
                }
                block = $('<img src="' + $('#mediacontent').val() + '" alt="" style="width:100%"><span class="source"><span>via:</span>' + imgsrc + '</span>');
            } else if (blocktype == 'imageupload') {
                var imgsrc = $('#imagesourcecontent').val().replace('<p>', '').replace('</p>', '');
                if (imgsrc.indexOf('</a>') == -1) {
                    imgsrc = '<a href="">' + imgsrc + '</a>';
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
            if (blocktype == 'p') {
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

            $('#blocktype').change(function () {
                if ($(this).val() == 'imageupload') {
                    $('#cke_textcontent').hide();
                    $('#imagecontent').show();
                    $('#mediacontent').hide();
                    $('#imagesource').show();
                } else if ($(this).val() == 'imageurl') {
                    $('#cke_textcontent').hide();
                    $('#imagecontent').hide();
                    $('#mediacontent').show();
                    $('#imagesource').show();
                } else if ($(this).val() == 'youtube') {
                    $('#cke_textcontent').hide();
                    $('#imagecontent').hide();
                    $('#mediacontent').show();
                    $('#imagesource').hide();
                }
                else if ($(this).val() == 'html') {
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
                ['Bold', 'Link', 'Format']
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
                                {name: 'basicstyles', groups: ['basicstyles', 'cleanup'], items: ['Bold']},
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