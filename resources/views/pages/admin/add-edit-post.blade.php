@extends('layouts.dashboard')

@section('title', !empty($post) ? ' - Edit: ' . $post->title : ' - New Post')

@section('css')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel='stylesheet' href='{{ asset('assets/plugins/editors/textangular/textAngular.css') }}'>
@endsection

@section('content')
    <div ng-app="PostizeEditor" ng-controller="PostizeController as PCTRL" ng-init="PCTRL.init()">
        <div class="row">
            <a href="{{url('dashboard/post/list')}}" class="btn bg-indigo-400 btn-labeled btn-rounded"><b><i
                            class="glyphicon glyphicon-chevron-left"></i></b> All Posts</a><br><br>
        </div>

        <div class="row">
            <div class="col-md-12">
                <!-- Basic layout-->
                <form class="form-horizontal"
                      action="{{ url('dashboard/post' . (!empty($post) ? '/' . $post->id : '')) }}"
                      method="post"
                      enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h5 class="panel-title">Post Details</h5>
                        </div>
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

                                    <a class="col-lg-9 control-label" href="{{url($post->slug)}}"
                                       target="_blank">{{url($post->slug)}}</a>
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
                                        <option value="0" {{ !empty($post) && $post->status == 0 ? 'selected' : '' }}>
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
                </form>
                <!-- /basic layout -->
            </div>
        </div>
        <div class="row" ng-init="PCTRL.initCanvas()">
            <div class="col-md-12">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Thumbnail Generator</h5>
                    </div>
                    <div class="panel-body">
                        <div class="uploader">
                            <input type="file" class="file-styled" id="canvasImageUpload">
                            <span class="action btn bg-pink-400 legitRipple" style="-webkit-user-select: none;">Choose File</span>
                        </div>
                        <span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb. Result thumbnail dimensions will be 1200x630px</span>
                        <br><br>
                        <canvas id="thumbnailGenerator" width="1200" height="630"></canvas>
                        <!--<button type="button" class="btn btn-default" ng-click="PCTRL.undoCanvas()"><i class="icon-undo"></i> Undo</button>
                        <button type="button" class="btn btn-default" ng-click="PCTRL.redoCanvas()"><i class="icon-redo"></i> Redo</button>-->
                        <button type="button" class="btn btn-default" ng-click="PCTRL.deleteFromCanvas()"><i class="icon-cancel-circle2"></i> Remove selected image</button>
                        <button type="button" class="btn btn-default" ng-click="PCTRL.toFrontCanvas()"><i class="icon-stack-up"></i> Move selected image to front</button>
                        <button type="button" class="btn btn-default" ng-click="PCTRL.toBackCanvas()"><i class="icon-stack-down"></i> Move selected image to back</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Content Editor</h5>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <button ng-click="PCTRL.editor.active = 'text'" type="button"
                                        class="btn btn-labeled btn-xlg"
                                        ng-class="PCTRL.editor.active == 'text' ? 'btn-success' : 'btn-primary'"><b><i
                                                class="icon-typography"></i></b> Text
                                </button>
                                <button ng-click="PCTRL.editor.active = 'image'" type="button"
                                        class="btn btn-labeled btn-xlg"
                                        ng-class="PCTRL.editor.active == 'image' ? 'btn-success' : 'btn-primary'"><b><i
                                                class="icon-image2"></i></b> Image
                                </button>
                                <button ng-click="PCTRL.editor.active = 'embed'" type="button"
                                        class="btn btn-labeled btn-xlg"
                                        ng-class="PCTRL.editor.active == 'embed' ? 'btn-success' : 'btn-primary'"><b><i
                                                class="icon-embed2"></i></b> Embed
                                </button>
                            </div>
                            <div class="col-md-6">
                                <p class="text-right" ng-show="PCTRL.editor.active == 'text'">
                                    <i class="icon-typography"></i> Text: Write a paragraph, heading or a quote
                                </p>
                                <p class="text-right" ng-show="PCTRL.editor.active == 'image'">
                                    <i class="icon-image2"></i> Image: Enter URL to an image or upload one
                                </p>
                                <p class="text-right" ng-show="PCTRL.editor.active == 'embed'">
                                    <i class="icon-embed2"></i> Embed: Embed Youtube video, Ad code, etc.
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">

                            <div class="col-md-12" ng-show="PCTRL.editor.active == 'text'">
                                <text-angular
                                        ta-toolbar="[['p'], ['h1','h2','h3'], ['bold','italics'], ['insertLink', 'quote']]"
                                        ng-model="PCTRL.editor.text.content"></text-angular>
                                <div class="panel-group panel-group-control panel-group-control-right content-group-lg"
                                     id="accordion-control-right">
                                    <div class="panel panel-white">
                                        <div class="panel-heading">
                                            <h6 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse"
                                                   data-parent="#accordion-control-right"
                                                   href="#accordion-control-right-group1">HTML Code Preview</a>
                                            </h6>
                                        </div>
                                        <div id="accordion-control-right-group1" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                @{{ PCTRL.editor.text.content ? PCTRL.editor.text.content : '//start typing in the editor above' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12" ng-show="PCTRL.editor.active == 'image'">
                                <div class="tabbable nav-tabs-vertical nav-tabs-left">
                                    <ul class="nav nav-tabs nav-tabs-highlight">
                                        <li class="active"><a href="#left-tab1" data-toggle="tab"><i
                                                        class="icon-upload4 position-left"></i> Upload Images</a></li>
                                        <li><a href="#left-tab2" data-toggle="tab"><i
                                                        class="icon-link2 position-left"></i> Link Images</a></li>
                                    </ul>

                                    <div class="tab-content">
                                        <div class="tab-pane active has-padding" id="left-tab1">
                                            <input id="editorFileInput" type="file" class="file-input"
                                                   multiple="multiple" data-show-caption="false">
                                            <br><br>
                                            <div ng-repeat="t in PCTRL.editor.imageUpload.files" class="row">
                                                <div class="col-md-2">@{{t.name}}</div>
                                                <div class="col-md-5"><input class="form-control" placeholder="Source"
                                                                             ng-model="t.source"></div>
                                                <div class="col-md-5"><input class="form-control"
                                                                             placeholder="Link to source"
                                                                             ng-model="t.sourceurl"></div>
                                            </div>
                                        </div>

                                        <div class="tab-pane has-padding" id="left-tab2">
                                            <div ng-repeat="(i, t) in PCTRL.editor.imageLink.links" class="row">
                                                <div class="col-md-4"><input class="form-control"
                                                                             placeholder="Link to image"
                                                                             ng-model="t.url"></div>
                                                <div class="col-md-4"><input class="form-control" placeholder="Source"
                                                                             ng-model="t.source"></div>
                                                <div class="col-md-3"><input class="form-control"
                                                                             placeholder="Link to source"
                                                                             ng-model="t.sourceurl"></div>
                                                <div class="col-md-1">
                                                    <button class="btn btn-danger"
                                                            ng-click="PCTRL.editor.imageLink.links.splice(i, 1)"><i
                                                                class="icon-cancel-circle2"></i></button>
                                                </div>
                                            </div>
                                            <br>
                                            <button class="btn btn-primary" ng-click="PCTRL.addLinkImage()">Add New
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" ng-show="PCTRL.editor.active == 'embed'">
                                <textarea class="form-control embedTextarea"
                                          ng-model="PCTRL.editor.embed.content"></textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn bg-teal-400 btn-labeled insertContentButton"
                                        ng-click="PCTRL.insertBlock()"><b><i class="icon-pencil4"></i></b> <span>Insert Content Block</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" ng-repeat="(i, block) in PCTRL.blocks">
            <div class="col-md-12">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-sm-3">
                                <h5 class="panel-title">
                            <span ng-show="block.type == 'text'">
                                <i class="icon-typography"></i> @{{i+1}}. Text Block
                            </span>
                            <span class="text-right" ng-show="block.type == 'image'">
                                <i class="icon-image2"></i> @{{i+1}}. Image Block
                            </span>
                            <span class="text-right" ng-show="block.type == 'embed'">
                                <i class="icon-embed2"></i> @{{i+1}}. Embed Block
                            </span>
                                </h5>
                            </div>
                            <div class="col-sm-4 text-right">
                                <button type="button" class="btn btn-primary btn-labeled" ng-click="PCTRL.moveDown(i)">
                                    <b><i class="icon-chevron-down"></i></b> Move Down
                                </button>
                                <button type="button" class="btn btn-primary btn-labeled" ng-click="PCTRL.moveUp(i)"><b><i
                                                class="icon-chevron-up"></i></b> Move Up
                                </button>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div class="input-group bootstrap-touchspin">
                                        <span class="input-group-btn"></span>
                                        <span class="input-group-addon bootstrap-touchspin-prefix">Position:</span>
                                        <input type="text" class="form-control touchspin-button-group" value="50"
                                               style="display: block;" ng-model="block.position">
                                        <div class="input-group-btn">
                                            <button class="btn btn-default bootstrap-touchspin-down" type="button"
                                                    ng-click="PCTRL.minusPosition(i)">-
                                            </button>
                                            <button class="btn btn-default bootstrap-touchspin-up" type="button"
                                                    ng-click="PCTRL.plusPosition(i)">+
                                            </button>
                                            <button type="button" class="btn btn-primary"
                                                    ng-click="PCTRL.moveToPosition(i)">Move
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-danger btn-labeled" ng-click=""><b><i
                                                class="icon-cancel-circle2"></i></b> Remove Block
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row" ng-if="block.type == 'text'">
                            <div class="col-md-6">
                                <h4>Edit</h4>
                                <hr>
                                <text-angular
                                        ta-toolbar="[['p'], ['h1','h2','h3'], ['bold','italics'], ['insertLink', 'quote']]"
                                        ng-model="block.content"></text-angular>
                            </div>
                            <div class="col-md-6">
                                <h4>Preview</h4>
                                <hr>
                                <div ng-bind-html="block.content"></div>
                            </div>
                        </div>
                        <div class="row" ng-if="block.type == 'image'">
                            <div class="col-md-6">
                                <h4>Edit</h4>
                                <hr>
                                <div class="form-group">
                                    <label>Image link:</label>
                                    <input type="text" class="form-control" ng-model="block.url">
                                </div>
                                <div class="form-group">
                                    <label>Source</label>
                                    <input type="text" class="form-control" ng-model="block.source">
                                </div>
                                <div class="form-group">
                                    <label>Source link:</label>
                                    <input type="text" class="form-control" ng-model="block.sourceurl">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4>Preview</h4>
                                <hr>
                                <img class="img-responsive" style="max-height: 220px;" ng-src="@{{ block.url }}">
                                <span ng-show="block.source && block.sourceurl">via: <a href="@{{block.sourceurl}}"
                                                                                        target="_blank">@{{ block.source }}</a></span>
                                <span ng-show="block.source && !block.sourceurl">via: @{{ block.source }}</span>
                                <span ng-show="!block.source && block.sourceurl">via: <a href="@{{block.sourceurl}}"
                                                                                         target="_blank">source</a></span>
                            </div>
                        </div>
                        <div class="row" ng-if="block.type == 'embed'">
                            <div class="col-md-6">
                                <h4>Edit</h4>
                                <hr>
                                <div class="form-group">
                                    <label>Content:</label>
                                    <textarea class="form-control embedTextarea" ng-model="block.content"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4>Preview</h4>
                                <hr>
                                <div ng-bind-html="block.content"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js-bottom')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/fabric.js/1.5.0/fabric.min.js"></script>
    <script src="{{ asset('assets/dashboard/js/plugins/uploaders/fileinput.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/plugins/notifications/pnotify.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/plugins/notifications/noty.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/plugins/notifications/jgrowl.min.js') }}"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular.min.js"></script>
    <script src="{{ asset('assets/plugins/editors/textangular/textAngular-rangy.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/editors/textangular/textAngular-sanitize.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/editors/textangular/textAngular.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/postize-editor.js') }}"></script>
@endsection