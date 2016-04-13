angular.module('PostizeEditor', ['textAngular']);

angular.module('PostizeEditor').controller('PostizeController', function($scope) {
    var vm = this;

    vm.init = function() {
        vm.blocks = [];
        vm.editor = {
            active : 'text',
            text: {
                content: ""
            },
            imageUpload: {
                files: []
            },
            imageLink: {
                links: [{url: "", source: "", sourceurl: ""}]
            },
            embed: {
                content: "",
            }
        };

        // file upload
        jQuery('#editorFileInput').fileinput({
            maxFileCount: 20,
            initialPreview: [],
            showUpload: false,
            fileActionSettings: {
                removeIcon: '<i class="icon-bin"></i>',
                removeClass: 'btn btn-link btn-xs btn-icon',
                uploadIcon: '<i class="icon-upload"></i>',
                uploadClass: 'btn btn-link btn-xs btn-icon',
                indicatorNew: '<i class="icon-file-plus text-slate"></i>',
                indicatorSuccess: '<i class="icon-checkmark3 file-icon-large text-success"></i>',
                indicatorError: '<i class="icon-cross2 text-danger"></i>',
                indicatorLoading: '<i class="icon-spinner2 spinner text-muted"></i>',
            }
        });

        jQuery('#editorFileInput').on('change fileclear',function() {
            $scope.$apply(function() {
                vm.editor.imageUpload.files = document.getElementById('editorFileInput').files;
            });
        });
    };

    vm.insertBlock = function() {
        if (vm.editor.active == 'text') {
            //text block creating
            if (!vm.editor.text.content) {
                jQuery.jGrowl('Please enter some text first', {
                    header: 'Invalid',
                    theme: 'bg-danger'
                });
                return;
            }
            vm.blocks.push({
                type: "text",
                content: vm.editor.text.content
            });

            vm.editor.text.content = "";
        } else if (vm.editor.active == 'image') {
            //image block creating
            if (jQuery("#left-tab1").hasClass('active')) {
                //upload images
                if (vm.editor.imageUpload.files.length == 0) {
                    jQuery.jGrowl('Upload at least one image', {
                        header: 'Invalid',
                        theme: 'bg-danger'
                    });
                    return;
                }
                for (var i = 0; i< vm.editor.imageUpload.files.length; i++) {
                    if (!vm.editor.imageUpload.files[i].source || !vm.editor.imageUpload.files[i].sourceurl)
                    {
                        jQuery.jGrowl('You must enter source name and valid source link for each image', {
                            header: 'Invalid',
                            theme: 'bg-danger'
                        });
                        return;
                    }

                    if (vm.editor.imageUpload.files[i].sourceurl.substr(0,4) != 'http')
                        vm.editor.imageUpload.files[i].sourceurl = "http://" + vm.editor.imageUpload.files[i].sourceurl;
                }

                jQuery('.insertContentButton').attr('disabled', true);
                jQuery('.insertContentButton span').html('Uploading Images...');
                for (var i = 0; i< vm.editor.imageUpload.files.length; i++) {
                    var file = vm.editor.imageUpload.files[i];
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", document.location.origin + "/dashboard/post/uploadimage", false);
                    xhr.setRequestHeader("X_FILENAME", file.name);
                    var formData = new FormData();
                    formData.append("imagecontent", file);
                    xhr.send(formData);

                    var status = String(xhr.status);
                    var response = JSON.parse(xhr.responseText);
                    if (status[0] == '2') {
                        vm.blocks.push({
                            type: "image",
                            url: response.url,
                            source: file.source,
                            sourceurl: file.sourceurl
                        })
                    }
                }
                jQuery('.insertContentButton').attr('disabled', false);
                jQuery('.insertContentButton span').html('Insert Content');
                jQuery('#editorFileInput').fileinput('reset');
                vm.editor.imageUpload.files = [];
            } else {
                //link images
                if (vm.editor.imageLink.links.length == 0) {
                    jQuery.jGrowl('Enter at least one image', {
                        header: 'Invalid',
                        theme: 'bg-danger'
                    });
                    return;
                }

                for (var i = 0; i< vm.editor.imageLink.links.length; i++) {
                    if (!vm.editor.imageLink.links[i].url || !vm.editor.imageLink.links[i].source || !vm.editor.imageLink.links[i].sourceurl)
                    {
                        jQuery.jGrowl('You must enter image link, source name and valid source link for each image', {
                            header: 'Invalid',
                            theme: 'bg-danger'
                        });
                        return;
                    }

                    if (vm.editor.imageLink.links[i].sourceurl.substr(0,4) != 'http')
                        vm.editor.imageLink.links[i].sourceurl = "http://" + vm.editor.imageLink.links[i].sourceurl;

                    if (vm.editor.imageLink.links[i].url.substr(0,4) != 'http')
                        vm.editor.imageLink.links[i].url = "http://" + vm.editor.imageLink.links[i].url;
                }

                for (var i = 0; i< vm.editor.imageLink.links.length; i++) {
                    vm.blocks.push({
                        type: "image",
                        url: vm.editor.imageLink.links[i].url,
                        source: vm.editor.imageLink.links[i].source,
                        sourceurl: vm.editor.imageLink.links[i].sourceurl
                    });
                }

                vm.editor.imageLink.links = [{url: "", source: "", sourceurl: ""}];
            }
        } else if (vm.editor.active == 'embed') {
            if (!vm.editor.embed.content) {
                jQuery.jGrowl('Please enter some text first', {
                    header: 'Invalid',
                    theme: 'bg-danger'
                });
                return;
            }
            var YTEmbed = vm.convertYoutubeLink(vm.editor.embed.content);
            if (YTEmbed) {
                vm.editor.embed.content = '<iframe width="560" height="315" src="//www.youtube.com/embed/' + YTEmbed + '" frameborder="0" allowfullscreen></iframe>';
            }
            vm.blocks.push({
                type: "embed",
                content: vm.editor.embed.content
            });

            vm.editor.embed.content = "";

        }
        console.log(vm.blocks);
    };

    vm.addLinkImage = function() {
        vm.editor.imageLink.links.push({url: "", source: "", sourceurl: ""});
    };

    vm.convertYoutubeLink = function(url) {
        var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
        var match = url.match(regExp);

        if (match && match[2].length == 11) {
            return match[2];
        } else {
            return false;
        }
    }
});