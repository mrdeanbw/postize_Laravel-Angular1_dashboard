@extends('layouts.main')
  
@section('content')
<div class="landing">

	<section class="content">
		<form action="{{ url('dashboard/post' . (!empty($post) ? '/' . $post->id : '')) }}" method="post" enctype="multipart/form-data">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<h1 class="section-heading">Add/Edit Post</h1>
			
			<div class="field-set">
				<label for="title">Title:</label>
				<div class="field">
					<input id="title" name="title" type="text" placeholder="Create your title here..." value="{{$post->title or ''}}" required/>
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
				<label for="category">Category:</label>
				<select id="category" name="category_id" class="form-control">
					<option value="0">No category selected</option>
					@foreach($categories as $category)
					<option value="{{$category->code}}" {{ !empty($post->category) && $post->category == $category->code ? ' selected' : '' }}>{{$category->name}}</option>
					@endforeach
				</select>
			</div>

			<div class="field-set">
				<label for="description">Description (Facebook caption):</label>
				<div class="field">
					<input id="description" name="description" type="text" value="{{$post->description or ''}}" placeholder="Enter description here..." class="form-control input-md" required=""/>
				</div>
			</div>

			<div class="field-set row">
				<label>Status: </label>
				<select id="status" name="status" class="form-control select">
					<option value="1" data-bg="#A2FACB"	style="background-color: #A2FACB" {{ !empty($post) && $post->status == 1 ? 'selected' : '' }}>Enabled</option>
					<option value="0" data-bg="#f7e1b5" style="background-color: #f7e1b5" {{ !empty($post) && $post->status == 0 ? 'selected' : '' }}>Pending</option>
					<option value="2" data-bg="#F799B1" style="background-color: #F799B1" {{ !empty($post) && $post->status == 2 ? 'selected' : '' }}>Deleted</option>
				</select>
			</div>

			<div class="field-set">

				<h2>Thumbnail</h2>

				@if(!empty($post->image))
				<label>Current Image:</label>
				<div class="field">
					<img src="{{$post->image}}" style="width:100px;height:100px;"/>
				</div>
				@endif

				<label for="image">Upload a new thumbnail:</label>
				<div class="field">
					<input id="image" name="image" class="form-control" type="file">
				</div>

				<label for="image_url">Or enter the URL of an image to use as the thumbnail:</label>
				<div class="field">
					<input id="image_url" name="image_url" type="text" placeholder="(Optional) Paste an image URL here..." class="form-control" value="{{$post->image or ''}}">
				</div>
			</div>
		</form>
			<div class="field-set" style="width:100%;float:left">
				<div class="field" style="width:100%;float:left">
					<div style="width:100%;float:left;padding-left:10px;padding-right:10px;">
						<div style="width:30%;float:left;">
							<select id="blocktype">
								<option value="p">p</option>
								<option value="h2">h2</option>
								<option value="quoteblock">quoteblock</option>
								<option value="imageurl">image(url)</option>
								<option value="imageupload">image(upload)</option>
								<option value="video">video</option>
							</select>
						</div>
						<div style="width:50%;float:left;padding-left:10px;padding-right:10px;" id="blockcontentdiv">
							<textarea id="textcontent" name="textcontent" style="height:100px"></textarea>
							<input id="mediacontent" type="text" name="mediacontent" style="display:none">
							<form id="imageuploadform" action="{{ url('dashboard/post/uploadimage') }}" method="post">
								<input id="imagecontent" type="file" name="imagecontent" style="display:none">
							</form>
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
			
			<div id="preview" class="field-set" >
				<ul id="sortable">
				</ul>
			</div>
			
			<div class="field-set third">
				<input type="submit" class="btn"/>
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
	#sortable { list-style: none; margin: 0; padding: 0; }
	#sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; width:100%; float:left; list-style:none}
	strong {font-weight: bold}
</style>
<script>
var blockindex = 0;

function removeBlock(id) {
	$('#sortableli' + id).detach();
}

function addBlock() {
	var blocktype = $('#blocktype').val();
	var block = null;
	if (blocktype == 'p') {
		block = $($('#textcontent').val());
	} else if (blocktype == 'h2') {
		block = $('<h2>' + $('#textcontent').val().replace('<p>','').replace('</p>','') + '</h2>');
	} else if (blocktype == 'quoteblock') {
		block = $('<blockquote cite="http://www.worldwildlife.org/who/index.html">' + $('#textcontent').val() + '</blockquote>')
	} else if (blocktype == 'video') {
		block = $('<p><iframe width="640" height="360" src="' + $('#mediacontent').val() + '" frameborder="0" allowfullscreen></iframe></p>');
	} else if (blocktype == 'imageurl') {
		block = $('<p><img src="' + $('#mediacontent').val() +'" alt=""><span class="source"><span>source:</span><a href="">Hellou.co.uk</a></span></p>');
	} else if (blocktype == 'imageupload') {
		block = $('<p><img id="upimage' + blockindex + '" src="" alt=""><span class="source"><span>source:</span><a href="">Hellou.co.uk</a></span></p>');
		var tmp_blockindex = blockindex;
		$('#imageuploadform').ajaxForm({
			dataType: 'json',
			reference: null,
			beforeSend: function() {
			},
			error: function() {
				alert("An error occurred while uploading your image");
			},
			success: function(data) {
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
	var blockdiv = $('<div style="padding-top:10px;float:left;width:100%"></div>');
	var contentdiv = $('<div id="contentdiv' + blockindex + '" contenteditable="true" style="width:80%;float:left"></div>');
	contentdiv.append(block);
	var closediv = $('<div style="width:20%;float:left"></div>');
	var closebutton = $('<a onclick="removeBlock(' + blockindex + ')" style="float:right;cursor:pointer">x</a>');
	closediv.append(closebutton);
	blockdiv.append(contentdiv);
	blockdiv.append(closediv);
	var sortableli = $('<li id="sortableli' + blockindex + '" class="ui-state-default"></li>');
	sortableli.append(blockdiv);
	$('#sortable').append(sortableli);
	if (blocktype == 'p')
	CKEDITOR.inline('contentdiv' + blockindex, {
		toolbar : [
			{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: ['Bold'] },
			{ name: 'links', items: [ 'Link' ] },
			{ name: 'styles', items: ['Format'] }
		],
		startupFocus: false
	});
	blockindex++;
}

$(document).ready(function () {
	$('#status').change(function() {
		$(this).siblings('.sd-select').find('.sd-label').css('background-color', $('option:selected', this).attr('data-bg'));
	});

	$("#status > option").each(function(i) {
		$('#status').siblings('.sd-select').find('.sd-options > li').eq(i).css('background-color', $(this).attr('data-bg'));
	});

	$('#status').siblings('.sd-select').find('.sd-label').css('background-color', $('option:selected', $('#status')).attr('data-bg'));
	
	$('#blocktype').change(function() {
		if ($(this).val() == 'imageupload') {
			$('#cke_textcontent').hide();
			$('#imagecontent').show();
			$('#mediacontent').hide();
		} else if ($(this).val() == 'imageurl' || $(this).val() == 'video') {
			$('#cke_textcontent').hide();
			$('#imagecontent').hide();
			$('#mediacontent').show();
		} else {
			$('#cke_textcontent').show();
			$('#imagecontent').hide();
			$('#mediacontent').hide();
		}
	});
	$("#sortable").sortable();
	
	var myToolbar = [
		['Bold', 'Link', 'Format']
	];
	var config = {
		toolbar_mySimpleToolbar: myToolbar,
		toolbar: 'mySimpleToolbar'
	};          
	$('#textcontent').ckeditor(config);   
});
</script>
@endsection