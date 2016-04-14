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
        vm.cropThumbnail = false;
        ThumbnailGenerator.init();
    };

    vm.undoCanvas = function() {
        vm.cropThumbnail = false;
        ThumbnailGenerator.undo();
    }
    vm.redoCanvas = function() {
        vm.cropThumbnail = false;
        ThumbnailGenerator.redo();
    }
    vm.deleteFromCanvas = ThumbnailGenerator.delete;
    vm.toFrontCanvas = ThumbnailGenerator.toFront;
    vm.toBackCanvas = ThumbnailGenerator.toBack;
    vm.cropSelected = function() {
        ThumbnailGenerator.cropSelected();
        vm.cropThumbnail = false;
    };
    vm.cropMode = function() {
        vm.cropThumbnail = ThumbnailGenerator.cropMode(!vm.cropThumbnail);
    };

    vm.arrangeCanvas = function() {
        vm.cropThumbnail = false;
        ThumbnailGenerator.automagic();
    };

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
            //attach order, for manual order changing
            var len = vm.blocks.length;
            vm.blocks[len - 1].position = len;
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

                    if (vm.editor.imageUpload.files[i].sourceurl && vm.editor.imageUpload.files[i].sourceurl.substr(0, 4) != 'http')
                        vm.editor.imageUpload.files[i].sourceurl = "http://" + vm.editor.imageUpload.files[i].sourceurl;
                }

                jQuery('.insertContentButton').attr('disabled', true);
                jQuery('.insertContentButton span').html('Uploading Images...');
                var all_files = [];
                var xhrCount = 0;
                for (var i = 0; i < vm.editor.imageUpload.files.length; i++) {
                    var file = vm.editor.imageUpload.files[i];
                    all_files.push(file);
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", document.location.origin + "/dashboard/post/uploadimage", true);
                    xhr.uniqueid = i;
                    xhr.setRequestHeader("X_FILENAME", all_files[i].name);
                    var formData = new FormData();
                    formData.append("imagecontent", all_files[i]);
                    xhr.send(formData);
                    xhr.onreadystatechange = function() {
                        if (this.readyState == 4) {
                            var status = String(this.status);
                            var response = JSON.parse(this.responseText);
                            var uid = this.uniqueid;
                            if (status[0] == '2') {
                                $scope.$apply(function() {

                                    vm.blocks.push({
                                        type: "image",
                                        url: response.url,
                                        source: all_files[uid].source,
                                        sourceurl: all_files[uid].sourceurl
                                    })
                                    //attach order, for manual order changing
                                    var len = vm.blocks.length;
                                    vm.blocks[len - 1].position = len;
                                });
                            }
                            xhrCount++;

                            //check if last xHR
                            if (xhrCount == all_files.length) {
                                $scope.$apply(function() {
                                    jQuery('.insertContentButton').attr('disabled', false);
                                    jQuery('.insertContentButton span').html('Insert Content');
                                    jQuery('#editorFileInput').fileinput('reset');
                                    vm.editor.imageUpload.files = [];
                                });
                            }
                        }
                    }


                }
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

                    if (vm.editor.imageLink.links[i].sourceurl && vm.editor.imageLink.links[i].sourceurl.substr(0, 4) != 'http')
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
                //attach order, for manual order changing
                var len = vm.blocks.length;
                vm.blocks[len - 1].position = len;
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
            //attach order, for manual order changing
            var len = vm.blocks.length;
            vm.blocks[len - 1].position = len;
        }


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
    self.canvasDimensions = {width: 1200, height: 630};
    self.state = [];
    self.mods = 0;
    self.images = [];
    self.lines = 0;
    //self.imageCount = 0;
    self.cropThumbnail = null;
    self.cropEl = null;
    self.undoredo = false;

    self.init = function () {
        jQuery("#thumbnailGenerator").attr("width", self.canvasDimensions.width + "px");
        jQuery("#thumbnailGenerator").attr("height", self.canvasDimensions.height + "px");
        self.canvas = new fabric.Canvas("thumbnailGenerator", {
            selection: true,
        });
        self.canvas.selection = false;

        //image upload
        document.getElementById('canvasImageUpload').onchange = function (e) {
            if (self.images.length == 4) {
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
                    //self.updateModifications(true);
                    var image = new fabric.Image(imgObj);
                    self.images.push(image);
                    self.canvas.add(image);
                    self.drawLines();
                };
            };
        };
        self.canvas.on('object:modified', function (ev) {
            if (ev.target != self.cropEl && self.undoredo != true) {
                self.updateModifications(true);
                self.mods = 0;
                console.log("modified");
            }
        });
        self.canvas.on('object:added', function (ev) {
            if (ev.target != self.cropEl && self.undoredo != true) {
                self.updateModifications(true);
                self.mods = 0;
                console.log("added");
            }
        });
        self.canvas.on('object:deleted', function (ev) {
            if (ev.target != self.cropEl && self.undoredo != true) {
                self.updateModifications(true);
                self.mods = 0;
                console.log("deleted");
            }
        });

        //crop stuff
        /*self.canvas.on("mouse:down", function (event) {
            if (self.cropDisabled) return;

            self.cropEl.left = event.e.pageX - self.pos[0];
            self.cropEl.top = event.e.pageY - self.pos[1];
            //el.selectable = false;
            self.cropEl.visible = true;
            self.mousex = event.e.pageX;
            self.mousey = event.e.pageY;
            self.cropInProgress = true;
            self.canvas.bringToFront(self.cropEl);
        });

        self.canvas.on("mouse:move", function (event) {
            if (self.cropInProgress && !self.cropDisabled) {
                console.log(self.cropEl.left);
                if (event.e.pageX - self.mousex > 0) {
                    self.cropEl.width = event.e.pageX - self.mousex;
                }

                if (event.e.pageY - self.mousey > 0) {
                    self.cropEl.height = event.e.pageY - self.mousey;
                }
            }
        });

        self.canvas.on("mouse:up", function (event) {
            self.cropInProgress = false;
        });
        var r = document.getElementById('thumbnailGenerator').getBoundingClientRect();
        self.pos[0] = r.left;
        self.pos[1] = r.top;
         */
        self.cropEl = new fabric.Rect({
            //left: 100,
            //top: 100,
            fill: "#ccc",
            originX: 'left',
            originY: 'top',
            stroke: '#000',
            strokeDashArray: [5, 5],
            opacity: 0.7,
            width: 150,
            height: 150,
        });

        self.cropEl.visible = false;
        self.cropEl.hasRotatingPoint = false;
        self.canvas.add(self.cropEl);
    };

    self.delete = function() {
        self.updateModifications(true);
        var selected = self.canvas.getActiveObject();
        if (selected) {
            for (var i = 0; i < self.images.length; i++) {
                if (selected == self.images[i]) {
                    selected.remove();
                    self.images.splice(i, 1);
                    break;
                }
            }
            self.drawLines();
        }
    };

    self.toFront = function() {
        self.canvas.getActiveObject() ? self.canvas.getActiveObject().bringToFront() : angular.noop();
        for (var i = 0; i < self.lines.length; i++) {
            self.lines[i].bringToFront();
        }
    };

    self.toBack = function() {
        self.canvas.getActiveObject() ? self.canvas.getActiveObject().sendToBack() : angular.noop();
    };

    self.drawLines = function() {
        for (var i = 0; i < self.lines.length; i++) {
            self.lines[i].remove();
        }
        self.lines = [];
        if (self.images.length == 1) {

        } else if (self.images.length == 2) {
            var rect = new fabric.Rect();
            rect.set({ width: 10, height: 630, fill: '#fff', opacity: 1.0, left: 595, top: 0 });
            rect.selectable = false;
            self.lines.push(rect);
        } else if (self.images.length == 3) {
            var rect = new fabric.Rect();
            rect.set({ width: 10, height: 630, fill: '#fff', opacity: 1.0, left: 715, top: 0 });
            rect.selectable = false;
            self.lines.push(rect);

            var rect = new fabric.Rect();
            rect.set({ width: 600, height: 10, fill: '#fff', opacity: 1.0, left: 715, top: 310 });
            rect.selectable = false;
            self.lines.push(rect);
        } else if (self.images.length == 4) {
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
        if (self.images.length == 0)
            return;
        self.updateModifications(true);
        self.undoredo = true;
        self.cropEl.visible = false;
        self.cropThumbnail = false;

        if (self.images.length == 1) {
            self.images[0].left = 0;
            self.images[0].top = 0;
            self.images[0].setAngle(0);
            if (self.images[0].width / self.images[0].height < self.canvasDimensions.width / self.canvasDimensions.height)
                self.images[0].scaleToWidth(self.canvasDimensions.width);
            else
                self.images[0].scaleToHeight(self.canvasDimensions.height);

        } else if (self.images.length == 2) {
            self.images[0].left = 0;
            self.images[0].top = 0;
            self.images[0].setAngle(0);
            if (self.images[0].width / self.images[0].height < (self.canvasDimensions.width/2) / self.canvasDimensions.height)
                self.images[0].scaleToWidth(self.canvasDimensions.width / 2);
            else
                self.images[0].scaleToHeight(self.canvasDimensions.height);

            self.images[1].left = self.canvasDimensions.width/2;
            self.images[1].top = 0;
            self.images[1].setAngle(0);
            if (self.images[1].width / self.images[1].height < (self.canvasDimensions.width/2) / self.canvasDimensions.height)
                self.images[1].scaleToWidth(self.canvasDimensions.width / 2);
            else
                self.images[1].scaleToHeight(self.canvasDimensions.height);
            self.images[1].bringToFront();
        } else if (self.images.length == 3) {
            self.images[0].left = 0;
            self.images[0].top = 0;
            self.images[0].setAngle(0);
            if (self.images[0].width / self.images[0].height < (self.canvasDimensions.width * 0.6) / self.canvasDimensions.height)
                self.images[0].scaleToWidth(self.canvasDimensions.width * 0.6);
            else
                self.images[0].scaleToHeight(self.canvasDimensions.height);

            self.images[1].left = self.canvasDimensions.width * 0.6;
            self.images[1].top = 0;
            self.images[1].setAngle(0);
            if (self.images[1].width / self.images[1].height < (self.canvasDimensions.width * 0.4) / (self.canvasDimensions.height * 0.5))
                self.images[1].scaleToWidth(self.canvasDimensions.width * 0.4);
            else
                self.images[1].scaleToHeight(self.canvasDimensions.height * 0.5);

            self.images[1].bringToFront();

            self.images[2].left = self.canvasDimensions.width * 0.6;
            self.images[2].top = self.canvasDimensions.height/2;
            self.images[2].setAngle(0);
            if (self.images[2].width / self.images[2].height < (self.canvasDimensions.width * 0.4) / (self.canvasDimensions.height * 0.5))
                self.images[2].scaleToWidth(self.canvasDimensions.width * 0.4);
            else
                self.images[2].scaleToHeight(self.canvasDimensions.height * 0.5);
            self.images[2].bringToFront();
        } else if (self.images.length == 4) {
            self.images[0].left = 0;
            self.images[0].top = 0;
            self.images[0].setAngle(0);
            if (self.images[0].width / self.images[0].height < (self.canvasDimensions.width * 0.5) / (self.canvasDimensions.height * 0.5))
                self.images[0].scaleToWidth(self.canvasDimensions.width * 0.5);
            else
                self.images[0].scaleToHeight(self.canvasDimensions.height * 0.5);

            self.images[1].left = self.canvasDimensions.width * 0.5;
            self.images[1].top = 0;
            self.images[1].setAngle(0);
            if (self.images[1].width / self.images[1].height < (self.canvasDimensions.width * 0.5) / (self.canvasDimensions.height * 0.5))
                self.images[1].scaleToWidth(self.canvasDimensions.width * 0.5);
            else
                self.images[1].scaleToHeight(self.canvasDimensions.height * 0.5);
            self.images[1].bringToFront();

            self.images[2].left = 0;
            self.images[2].top =  self.canvasDimensions.height * 0.5;
            self.images[2].setAngle(0);
            if (self.images[2].width / self.images[2].height < (self.canvasDimensions.width * 0.5) / (self.canvasDimensions.height * 0.5))
                self.images[2].scaleToWidth(self.canvasDimensions.width * 0.5);
            else
                self.images[2].scaleToHeight(self.canvasDimensions.height * 0.5);
            self.images[2].bringToFront();

            self.images[3].left = self.canvasDimensions.width * 0.5;
            self.images[3].top =  self.canvasDimensions.height * 0.5;
            self.images[3].setAngle(0);
            if (self.images[3].width / self.images[3].height < (self.canvasDimensions.width * 0.5) / (self.canvasDimensions.height * 0.5))
                self.images[3].scaleToWidth(self.canvasDimensions.width * 0.5);
            else
                self.images[3].scaleToHeight(self.canvasDimensions.height * 0.5);
            self.images[3].bringToFront();
        }
        for (var i = 0; i < self.lines.length; i++) {
            self.lines[i].bringToFront();
        }

        for (var i = 0; i < self.images.length; i++) {
            self.images[i].selectable = true;
        }
        self.canvas.renderAll();
        self.undoredo = false;
    };

    self.cropMode = function(toCrop) {
        self.cropEl.visible = false;
        self.canvas.renderAll();
        if (toCrop) {
            self.cropThumbnail = self.canvas.getActiveObject();
            if (!self.cropThumbnail) {
                jQuery.jGrowl('Please select image that you want to crop first.', {
                    header: 'Error',
                    theme: 'bg-danger'
                });
                return false;
            }
            for (var i = 0; i < self.images.length; i++) {
                self.images[i].selectable = false;
            }
            jQuery.jGrowl('Now position the square over the area that you want to crop', {
                header: 'Tips',
                theme: 'bg-success'
            });
            self.cropEl.visible = true;
            self.cropEl.bringToFront();
            return true;

        } else {
            for (var i = 0; i < self.images.length; i++) {
                self.images[i].selectable = true;
            }
            self.cropThumbnail = null;
            return false;
        }
    };

    self.cropSelected = function() {
        if (!self.cropThumbnail)
            return;

        self.updateModifications(true);
        var left = self.cropEl.getLeft() - (self.cropThumbnail.getWidth()/2) - self.cropThumbnail.getLeft();
        var top = self.cropEl.getTop() - (self.cropThumbnail.getHeight()/2) - self.cropThumbnail.getTop();

        var width = self.cropEl.getWidth();
        var height = self.cropEl.getHeight();
        self.cropThumbnail.clipTo = function (ctx) {
            ctx.rect(left, top, width, height);
        };
        self.cropThumbnail = false;
        self.cropEl.visible = false;
        for (var i = 0; i < self.images.length; i++) {
            self.images[i].selectable = true;
        }
        self.canvas.deactivateAll().renderAll();
    };

    /**
     * undo/redo - not working yet, not sure if possible like this
     * @param savehistory
     */
    self.updateModifications = function (savehistory) {
        if (savehistory === true) {
            var newstate = {
                images: [],
                lines: []
            };
            for (var i = 0; i < self.images.length; i++) {
                self.images[i].clone(function(cl) {
                    newstate.images.push(cl);
                })
            }
            for (var i = 0; i < self.lines.length; i++) {
                self.lines[i].clone(function(cl) {
                    newstate.lines.push(cl);
                });
            }
            if (self.state.length > 15)
                self.state.splice(0, 1);
            self.state.push(newstate);
        }
    };

    self.undo = function() {
        if (self.mods < self.state.length) {
            self.undoredo = true;
            self.cropEl.visible = false;
            self.cropThumbnail = false;
            self.canvas.clear().renderAll();
            var toReturn = self.state[self.state.length - 1 - self.mods - 1];
            if (!toReturn) {
                self.undoredo = false;
                return;
            }

            self.images = toReturn.images;
            self.lines = toReturn.lines;

            self.redraw();
            self.mods++;
        }
    };

    self.redo = function() {
        if (self.mods > 0) {
            self.undoredo = true;
            self.cropEl.visible = false;
            self.cropThumbnail = false;
            self.canvas.clear().renderAll();
            var toReturn = self.state[self.state.length - 1 - self.mods + 1];
            if (!toReturn) {
                self.undoredo = false;
                return;
            }
            self.images = toReturn.images;
            self.lines = toReturn.lines;

            self.redraw();
            self.mods--;
        }
    };

    self.redraw = function() {
        self.drawLines();
        for (var i = 0; i < self.images.length; i++) {
            self.canvas.add(self.images[i]);
            self.images[i].selectable = true;
        }
        self.canvas.add(self.cropEl);
        self.canvas.renderAll();
        self.undoredo = false;
    }
};
