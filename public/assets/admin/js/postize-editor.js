angular.module('PostizeEditor', ['textAngular']);

angular.module('PostizeEditor').controller('PostizeController', function ($scope, $sce) {
    var vm = this;

    vm.init = function () {
        vm.blocks = [];
        vm.editor = {
            active: 'text',
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

        jQuery('#editorFileInput').on('change fileclear', function () {
            $scope.$apply(function () {
                vm.editor.imageUpload.files = document.getElementById('editorFileInput').files;
            });
        });
    };

    vm.initCanvas = function () {
        ThumbnailGenerator.init();
    };

    vm.undoCanvas = ThumbnailGenerator.undo;
    vm.redoCanvas = ThumbnailGenerator.redo;
    vm.deleteFromCanvas = ThumbnailGenerator.delete;
    vm.toFrontCanvas = ThumbnailGenerator.toFront;
    vm.toBackCanvas = ThumbnailGenerator.toBack;

    vm.insertBlock = function () {
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
                content: $sce.trustAsHtml(vm.editor.text.content)
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
                for (var i = 0; i < vm.editor.imageUpload.files.length; i++) {
                    /*if (!vm.editor.imageUpload.files[i].source || !vm.editor.imageUpload.files[i].sourceurl)
                     {
                     jQuery.jGrowl('You must enter source name and valid source link for each image', {
                     header: 'Invalid',
                     theme: 'bg-danger'
                     });
                     return;
                     }*/

                    if (vm.editor.imageUpload.files[i].sourceurl.substr(0, 4) != 'http')
                        vm.editor.imageUpload.files[i].sourceurl = "http://" + vm.editor.imageUpload.files[i].sourceurl;
                }

                jQuery('.insertContentButton').attr('disabled', true);
                jQuery('.insertContentButton span').html('Uploading Images...');
                for (var i = 0; i < vm.editor.imageUpload.files.length; i++) {
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

                for (var i = 0; i < vm.editor.imageLink.links.length; i++) {
                    if (!vm.editor.imageLink.links[i].url) {
                        jQuery.jGrowl('You must enter image link', {
                            header: 'Invalid',
                            theme: 'bg-danger'
                        });
                        return;
                    }

                    if (vm.editor.imageLink.links[i].sourceurl.substr(0, 4) != 'http')
                        vm.editor.imageLink.links[i].sourceurl = "http://" + vm.editor.imageLink.links[i].sourceurl;

                    if (vm.editor.imageLink.links[i].url.substr(0, 4) != 'http')
                        vm.editor.imageLink.links[i].url = "http://" + vm.editor.imageLink.links[i].url;
                }

                for (var i = 0; i < vm.editor.imageLink.links.length; i++) {
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
                content: $sce.trustAsHtml(vm.editor.embed.content)
            });

            vm.editor.embed.content = "";
        }

        //attach order, for manual order changing
        var len = vm.blocks.length;
        vm.blocks[len - 1].position = len;
    };

    vm.addLinkImage = function () {
        vm.editor.imageLink.links.push({url: "", source: "", sourceurl: ""});
    };

    vm.convertYoutubeLink = function (url) {
        var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
        var match = url.match(regExp);

        if (match && match[2].length == 11) {
            return match[2];
        } else {
            return false;
        }
    };

    vm.moveUp = function (i) {
        if (i == 0)
            return;

        //synch order if user messed with +/-
        vm.blocks[i - 1].position = i;
        vm.blocks[i].position = i + 1;

        var toReplace = angular.copy(vm.blocks[i]);
        vm.blocks[i] = angular.copy(vm.blocks[i - 1]);
        vm.blocks[i - 1] = toReplace;

        vm.blocks[i - 1].position = i;
        vm.blocks[i].position = i + 1;
    };

    vm.moveDown = function (i) {
        if (i == (vm.blocks.length - 1))
            return;

        //synch order if user messed with +/-
        vm.blocks[i].position = i + 1;
        vm.blocks[i + 1].position = i + 2;

        var toReplace = angular.copy(vm.blocks[i]);
        vm.blocks[i] = angular.copy(vm.blocks[i + 1]);
        vm.blocks[i + 1] = toReplace;

        vm.blocks[i].position = i + 1;
        vm.blocks[i + 1].position = i + 2;
    };

    vm.minusPosition = function (i) {
        if (vm.blocks[i].position == 1)
            return;
        vm.blocks[i].position--;
    };

    vm.plusPosition = function (i) {
        if (vm.blocks[i].position == vm.blocks.length)
            return;

        vm.blocks[i].position++;
    };

    vm.moveToPosition = function (i) {
        if (vm.blocks[i].position < 1 || vm.blocks[i].position > vm.blocks.length)
            return;

        var toReplace = angular.copy(vm.blocks[i]);
        vm.blocks.splice(i, 1);
        vm.blocks.splice(toReplace.position - 1, 0, toReplace);

        for (var j = 0; j < vm.blocks.length; j++)
            vm.blocks[j].position = j + 1;
    };
});

/**
 * THUMBNAIL GENERATOR
 */
var ThumbnailGenerator = new function () {
    var self = this;
    self.canvas = null;
    self.state = [];
    self.mods = 0;
    self.lines = 0;
    self.imageCount = 0;

    self.init = function () {
        self.canvas = new fabric.Canvas("thumbnailGenerator", {
            selection: true,
        });

        //image upload
        document.getElementById('canvasImageUpload').onchange = function (e) {
            if (self.imageCount == 4) {
                jQuery.jGrowl('You can have up to 4 images.', {
                    header: 'Error',
                    theme: 'bg-danger'
                });
                return;
            }
            var reader = new FileReader();
            reader.readAsDataURL(e.target.files[0]);

            reader.onload = function (event) {
                var imgObj = new Image();
                imgObj.src = event.target.result;
                imgObj.onload = function () {
                    var image = new fabric.Image(imgObj);
                    self.canvas.add(image);
                    self.updateModifications(true);
                    self.imageCount++;
                    self.drawLines();
                };
            };
        };
/*
        self.canvas.add(new fabric.Rect({
            left: 10,
            top: 10,
            width: 50,
            height: 50,
            fill: "red"
        }));

        self.canvas.add(new fabric.Rect({
            left: 100,
            top: 10,
            width: 50,
            height: 50,
            fill: "blue"
        }));
*/
        self.canvas.on(
            'object:modified', function () {
                self.updateModifications(true);
                //console.log("modified");
            },
            'object:added', function () {
                self.updateModifications(true);
                //console.log("added");
            },
            'object:deleted', function () {
                self.updateModifications(true);
            });

    };

    self.delete = function() {
        if (self.canvas.getActiveObject()) {
            self.canvas.getActiveObject().remove();
            self.imageCount--;
            self.drawLines();
        }
    };

    self.toFront = function() {
        self.canvas.getActiveObject().bringToFront();
        for (var i = 0; i < self.lines.length; i++) {
            self.lines[i].bringToFront();
        }
    };

    self.toBack = function() {
        self.canvas.getActiveObject().sendToBack();
    };

    /**
     * undo/redo - not working yet, not sure if possible like this
     * @param savehistory
     */
    self.updateModifications = function (savehistory) {
        return;
        if (savehistory === true) {
            var json = JSON.stringify(self.canvas);
            if (self.state.length > 15)
                self.state.splice(0, 1);
            self.state.push(json);
        }
    };

    self.undo = function() {
        if (self.mods < self.state.length) {
            self.canvas.clear().renderAll();
            self.canvas.loadFromJSON(self.state[self.state.length - 1 - self.mods - 1]);
            self.canvas.renderAll();
            self.mods += 1;
        }
    };

    self.redo = function() {
        if (self.mods > 0) {
            self.canvas.clear().renderAll();
            self.canvas.loadFromJSON(self.state[self.state.length - 1 - self.mods + 1]);
            self.canvas.renderAll();
            self.mods -= 1;
        }
    };

    self.drawLines = function() {
        for (var i = 0; i < self.lines.length; i++) {
            self.lines[i].remove();
        }
        self.lines = [];
        if (self.imageCount == 1) {

        } else if (self.imageCount == 2) {
            var rect = new fabric.Rect();
            rect.set({ width: 10, height: 630, fill: '#fff', opacity: 1.0, left: 595, top: 0 });
            rect.selectable = false;
            self.lines.push(rect);
        } else if (self.imageCount == 3) {
            var rect = new fabric.Rect();
            rect.set({ width: 10, height: 630, fill: '#fff', opacity: 1.0, left: 715, top: 0 });
            rect.selectable = false;
            self.lines.push(rect);

            var rect = new fabric.Rect();
            rect.set({ width: 600, height: 10, fill: '#fff', opacity: 1.0, left: 715, top: 310 });
            rect.selectable = false;
            self.lines.push(rect);
        } else if (self.imageCount == 4) {
            var rect = new fabric.Rect();
            rect.set({ width: 10, height: 630, fill: '#fff', opacity: 1.0, left: 595, top: 0 });
            rect.selectable = false;
            self.lines.push(rect);

            var rect = new fabric.Rect();
            rect.set({ width: 1200, height: 10, fill: '#fff', opacity: 1.0, left: 0, top: 310 });
            rect.selectable = false;
            self.lines.push(rect);
        }

        for (var i = 0; i < self.lines.length; i++) {
            self.canvas.add(self.lines[i]);
            self.lines[i].bringToFront();
        }
    }

    self.automagic = function() {
        if (self.imageCount == 1) {

        } else if (self.imageCount == 2) {

        } else if (self.imageCount == 3) {

        } else if (self.imageCount == 4) {

        }
    }
};