<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <!--
    All Credit goes to http://fengyuanchen.github.io/cropper
-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/cropperjs/dist/cropper.css">
    <!-- Content -->


    <style>
        .btn {
            padding-left: .75rem;
            padding-right: .75rem;
        }

        label.btn {
            margin-bottom: 0;
        }

        .d-flex>.btn {
            flex: 1;
        }

        .carbonads {
            border-radius: .25rem;
            border: 1px solid #ccc;
            font-size: .875rem;
            overflow: hidden;
            padding: 1rem;
        }

        .carbon-wrap {
            overflow: hidden;
        }

        .carbon-img {
            clear: left;
            display: block;
            float: left;
        }

        .carbon-text,
        .carbon-poweredby {
            display: block;
            margin-left: 140px;
        }

        .carbon-text,
        .carbon-text:hover,
        .carbon-text:focus {
            color: #fff;
            text-decoration: none;
        }

        .carbon-poweredby,
        .carbon-poweredby:hover,
        .carbon-poweredby:focus {
            color: #ddd;
            text-decoration: none;
        }

        @media (min-width: 768px) {
            .carbonads {
                float: right;
                margin-bottom: -1rem;
                margin-top: -1rem;
                max-width: 360px;
            }
        }

        .footer {
            font-size: .875rem;
            overflow: hidden;
        }

        .heart {
            color: #ddd;
            display: block;
            height: 2rem;
            line-height: 2rem;
            margin-bottom: 0;
            margin-top: 1rem;
            position: relative;
            text-align: center;
            width: 100%;
        }

        .heart:hover {
            color: #ff4136;
        }

        .heart::before {
            border-top: 1px solid #eee;
            content: " ";
            display: block;
            height: 0;
            left: 0;
            position: absolute;
            right: 0;
            top: 50%;
        }

        .heart::after {
            background-color: #fff;
            content: "♥";
            padding-left: .5rem;
            padding-right: .5rem;
            position: relative;
            z-index: 1;
        }

        .img-container,
        .img-preview {
            background-color: #f7f7f7;
            text-align: center;
            width: 100%;
        }

        .img-container {
            margin-bottom: 1rem;
            max-height: 497px;
            min-height: 200px;
        }

        @media (min-width: 768px) {
            .img-container {
                min-height: 497px;
            }
        }

        .img-container>img {
            max-width: 100%;
        }

        .docs-preview {
            margin-right: -1rem;
        }

        .img-preview {
            float: left;
            margin-bottom: .5rem;
            margin-right: .5rem;
            overflow: hidden;
        }

        .img-preview>img {
            max-width: 100%;
        }

        .preview-lg {
            height: 9rem;
            width: 16rem;
        }

        .preview-md {
            height: 4.5rem;
            width: 8rem;
        }

        .preview-sm {
            height: 2.25rem;
            width: 4rem;
        }

        .preview-xs {
            height: 1.125rem;
            margin-right: 0;
            width: 2rem;
        }

        .docs-data>.input-group {
            margin-bottom: .5rem;
        }

        .docs-data .input-group-prepend .input-group-text {
            min-width: 4rem;
        }

        .docs-data .input-group-append .input-group-text {
            min-width: 3rem;
        }

        .docs-buttons>.btn,
        .docs-buttons>.btn-group,
        .docs-buttons>.form-control {
            margin-bottom: .5rem;
            margin-right: .25rem;
        }

        .docs-toggles>.btn,
        .docs-toggles>.btn-group,
        .docs-toggles>.dropdown {
            margin-bottom: .5rem;
        }

        .docs-tooltip {
            display: block;
            margin: -.5rem -.75rem;
            padding: .5rem .75rem;
        }

        .docs-tooltip>.icon {
            margin: 0 -.25rem;
            vertical-align: top;
        }

        .tooltip-inner {
            white-space: normal;
        }

        .btn-upload .tooltip-inner,
        .btn-toggle .tooltip-inner {
            white-space: nowrap;
        }

        .btn-toggle {
            padding: .5rem;
        }

        .btn-toggle>.docs-tooltip {
            margin: -.5rem;
            padding: .5rem;
        }

        @media (max-width: 400px) {
            .btn-group-crop {
                margin-right: -1rem !important;
            }

            .btn-group-crop>.btn {
                padding-left: .5rem;
                padding-right: .5rem;
            }

            .btn-group-crop .docs-tooltip {
                margin-left: -.5rem;
                margin-right: -.5rem;
                padding-left: .5rem;
                padding-right: .5rem;
            }
        }

        .docs-options .dropdown-menu {
            width: 100%;
        }

        .docs-options .dropdown-menu>li {
            font-size: .875rem;
            padding: .125rem 1rem;
        }

        .docs-options .dropdown-menu .form-check-label {
            display: block;
        }

        .docs-cropped .modal-body {
            text-align: center;
        }

        .docs-cropped .modal-body>img,
        .docs-cropped .modal-body>canvas {
            max-width: 100%;
        }

        .loader {
            position: absolute;
            height: 100%;
            width: 100%;
            top: 0;
            left: 0;
            background: #000;
        }

        .frame {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 2px;
            background: #000;
            color: #fff;
        }

        .center {
            position: absolute;
            width: 220px;
            height: 220px;
            top: calc(50% - 110px);
            left: calc(50% - 110px);
        }

        .dot-1 {
            position: absolute;
            z-index: 3;
            width: 30px;
            height: 30px;
            top: 95px;
            left: 95px;
            background: #fff;
            border-radius: 50%;
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both;
            -webkit-animation: jump-jump-1 2s cubic-bezier(0.21, 0.98, 0.6, 0.99) infinite alternate;
            animation: jump-jump-1 2s cubic-bezier(0.21, 0.98, 0.6, 0.99) infinite alternate;
        }

        .dot-2 {
            position: absolute;
            z-index: 2;
            width: 60px;
            height: 60px;
            top: 80px;
            left: 80px;
            background: #fff;
            border-radius: 50%;
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both;
            -webkit-animation: jump-jump-2 2s cubic-bezier(0.21, 0.98, 0.6, 0.99) infinite alternate;
            animation: jump-jump-2 2s cubic-bezier(0.21, 0.98, 0.6, 0.99) infinite alternate;
        }

        .dot-3 {
            position: absolute;
            z-index: 1;
            width: 90px;
            height: 90px;
            top: 65px;
            left: 65px;
            background: #fff;
            border-radius: 50%;
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both;
            -webkit-animation: jump-jump-3 2s cubic-bezier(0.21, 0.98, 0.6, 0.99) infinite alternate;
            animation: jump-jump-3 2s cubic-bezier(0.21, 0.98, 0.6, 0.99) infinite alternate;
        }

        @-webkit-keyframes jump-jump-1 {

            0%,
            70% {
                box-shadow: 2px 2px 3px 2px rgba(0, 0, 0, 0.2);
                -webkit-transform: scale(0);
                transform: scale(0);
            }

            100% {
                box-shadow: 10px 10px 15px 0 rgba(0, 0, 0, 0.3);
                -webkit-transform: scale(1);
                transform: scale(1);
            }
        }

        @keyframes jump-jump-1 {

            0%,
            70% {
                box-shadow: 2px 2px 3px 2px rgba(0, 0, 0, 0.2);
                -webkit-transform: scale(0);
                transform: scale(0);
            }

            100% {
                box-shadow: 10px 10px 15px 0 rgba(0, 0, 0, 0.3);
                -webkit-transform: scale(1);
                transform: scale(1);
            }
        }

        @-webkit-keyframes jump-jump-2 {

            0%,
            40% {
                box-shadow: 2px 2px 3px 2px rgba(0, 0, 0, 0.2);
                -webkit-transform: scale(0);
                transform: scale(0);
            }

            100% {
                box-shadow: 10px 10px 15px 0 rgba(0, 0, 0, 0.3);
                -webkit-transform: scale(1);
                transform: scale(1);
            }
        }

        @keyframes jump-jump-2 {

            0%,
            40% {
                box-shadow: 2px 2px 3px 2px rgba(0, 0, 0, 0.2);
                -webkit-transform: scale(0);
                transform: scale(0);
            }

            100% {
                box-shadow: 10px 10px 15px 0 rgba(0, 0, 0, 0.3);
                -webkit-transform: scale(1);
                transform: scale(1);
            }
        }

        @-webkit-keyframes jump-jump-3 {

            0%,
            10% {
                box-shadow: 2px 2px 3px 2px rgba(0, 0, 0, 0.2);
                -webkit-transform: scale(0);
                transform: scale(0);
            }

            100% {
                box-shadow: 10px 10px 15px 0 rgba(0, 0, 0, 0.3);
                -webkit-transform: scale(1);
                transform: scale(1);
            }
        }

        @keyframes jump-jump-3 {

            0%,
            10% {
                box-shadow: 2px 2px 3px 2px rgba(0, 0, 0, 0.2);
                -webkit-transform: scale(0);
                transform: scale(0);
            }

            100% {
                box-shadow: 10px 10px 15px 0 rgba(0, 0, 0, 0.3);
                -webkit-transform: scale(1);
                transform: scale(1);
            }
        }
    </style>
    <script>
        $(function() {
            $.ajax({
                url: "https://api.unsplash.com/photos/?&client_id=f0afe99aaf46a21c572d5dd3d620f3cf96e287a52e8af381f4bbaa5729a02215",
                success: function(result) {
                    unsplash = result;
                    $('.img-container img').each(function(i) {
                        var i = Math.floor((Math.random() * 10) + 1);
                        $(this).attr('src', unsplash[i].urls.regular); //[full, small, regular, raw, thumb]
                    });
                    $(".img-container img").one("load", function() {
                        imageCrop();
                    }).each(function(i) {

                    });
                }
            });
        });

        function imageCrop() {
            'use strict';
            var console = window.console || {
                log: function() {}
            };
            var URL = window.URL || window.webkitURL;
            var $image = $('#image');
            var $download = $('#download');
            var $dataX = $('#dataX');
            var $dataY = $('#dataY');
            var $dataHeight = $('#dataHeight');
            var $dataWidth = $('#dataWidth');
            var $dataRotate = $('#dataRotate');
            var $dataScaleX = $('#dataScaleX');
            var $dataScaleY = $('#dataScaleY');
            var options = {
                aspectRatio: 16 / 9,
                preview: '.img-preview',
                viewMode: 1,
                crop: function(e) {
                    $dataX.val(Math.round(e.detail.x));
                    $dataY.val(Math.round(e.detail.y));
                    $dataHeight.val(Math.round(e.detail.height));
                    $dataWidth.val(Math.round(e.detail.width));
                    $dataRotate.val(e.detail.rotate);
                    $dataScaleX.val(e.detail.scaleX);
                    $dataScaleY.val(e.detail.scaleY);
                }
            };
            var originalImageURL = $image.attr('src');
            var uploadedImageName = 'cropped.jpg';
            var uploadedImageType = 'image/jpeg';
            var uploadedImageURL;

            // Tooltip
            $('[data-toggle="tooltip"]').tooltip();
            $('.loader').remove();
            // Cropper
            $image.on({
                ready: function(e) {
                    console.log(e.type);
                },
                cropstart: function(e) {
                    console.log(e.type, e.detail.action);
                },
                cropmove: function(e) {
                    console.log(e.type, e.detail.action);
                },
                cropend: function(e) {
                    console.log(e.type, e.detail.action);
                },
                crop: function(e) {
                    console.log(e.type);
                },
                zoom: function(e) {
                    console.log(e.type, e.detail.ratio);
                }
            }).cropper(options);

            // Buttons
            if (!$.isFunction(document.createElement('canvas').getContext)) {
                $('button[data-method="getCroppedCanvas"]').prop('disabled', true);
            }

            if (typeof document.createElement('cropper').style.transition === 'undefined') {
                $('button[data-method="rotate"]').prop('disabled', true);
                $('button[data-method="scale"]').prop('disabled', true);
            }

            // Download
            if (typeof $download[0].download === 'undefined') {
                $download.addClass('disabled');
            }

            // Options
            $('.docs-toggles').on('change', 'input', function() {
                var $this = $(this);
                var name = $this.attr('name');
                var type = $this.prop('type');
                var cropBoxData;
                var canvasData;

                if (!$image.data('cropper')) {
                    return;
                }

                if (type === 'checkbox') {
                    options[name] = $this.prop('checked');
                    cropBoxData = $image.cropper('getCropBoxData');
                    canvasData = $image.cropper('getCanvasData');

                    options.ready = function() {
                        $image.cropper('setCropBoxData', cropBoxData);
                        $image.cropper('setCanvasData', canvasData);
                    };
                } else if (type === 'radio') {
                    options[name] = $this.val();
                }

                $image.cropper('destroy').cropper(options);
            });

            // Methods
            $('.docs-buttons').on('click', '[data-method]', function() {
                var $this = $(this);
                var data = $this.data();
                var cropper = $image.data('cropper');
                var cropped;
                var $target;
                var result;

                if ($this.prop('disabled') || $this.hasClass('disabled')) {
                    return;
                }

                if (cropper && data.method) {
                    data = $.extend({}, data); // Clone a new one

                    if (typeof data.target !== 'undefined') {
                        $target = $(data.target);

                        if (typeof data.option === 'undefined') {
                            try {
                                data.option = JSON.parse($target.val());
                            } catch (e) {
                                console.log(e.message);
                            }
                        }
                    }

                    cropped = cropper.cropped;

                    switch (data.method) {
                        case 'rotate':
                            if (cropped && options.viewMode > 0) {
                                $image.cropper('clear');
                            }

                            break;

                        case 'getCroppedCanvas':
                            if (uploadedImageType === 'image/jpeg') {
                                if (!data.option) {
                                    data.option = {};
                                }

                                data.option.fillColor = '#fff';
                            }

                            break;
                    }

                    result = $image.cropper(data.method, data.option, data.secondOption);

                    switch (data.method) {
                        case 'rotate':
                            if (cropped && options.viewMode > 0) {
                                $image.cropper('crop');
                            }

                            break;

                        case 'scaleX':
                        case 'scaleY':
                            $(this).data('option', -data.option);
                            break;

                        case 'getCroppedCanvas':
                            if (result) {
                                // Bootstrap's Modal
                                $('#getCroppedCanvasModal').modal().find('.modal-body').html(result);

                                if (!$download.hasClass('disabled')) {
                                    download.download = uploadedImageName;
                                    $download.attr('href', result.toDataURL(uploadedImageType));
                                }
                            }

                            break;

                        case 'destroy':
                            if (uploadedImageURL) {
                                URL.revokeObjectURL(uploadedImageURL);
                                uploadedImageURL = '';
                                $image.attr('src', originalImageURL);
                            }

                            break;
                    }

                    if ($.isPlainObject(result) && $target) {
                        try {
                            $target.val(JSON.stringify(result));
                        } catch (e) {
                            console.log(e.message);
                        }
                    }
                }
            });

            // Keyboard
            $(document.body).on('keydown', function(e) {
                if (e.target !== this || !$image.data('cropper') || this.scrollTop > 300) {
                    return;
                }

                switch (e.which) {
                    case 37:
                        e.preventDefault();
                        $image.cropper('move', -1, 0);
                        break;

                    case 38:
                        e.preventDefault();
                        $image.cropper('move', 0, -1);
                        break;

                    case 39:
                        e.preventDefault();
                        $image.cropper('move', 1, 0);
                        break;

                    case 40:
                        e.preventDefault();
                        $image.cropper('move', 0, 1);
                        break;
                }
            });

            // Import image
            var $inputImage = $('#inputImage');

            if (URL) {
                $inputImage.change(function() {
                    var files = this.files;
                    var file;

                    if (!$image.data('cropper')) {
                        return;
                    }

                    if (files && files.length) {
                        file = files[0];

                        if (/^image\/\w+$/.test(file.type)) {
                            uploadedImageName = file.name;
                            uploadedImageType = file.type;

                            if (uploadedImageURL) {
                                URL.revokeObjectURL(uploadedImageURL);
                            }

                            uploadedImageURL = URL.createObjectURL(file);
                            $image.cropper('destroy').attr('src', uploadedImageURL).cropper(options);
                            $inputImage.val('');
                        } else {
                            window.alert('Please choose an image file.');
                        }
                    }
                });
            } else {
                $inputImage.prop('disabled', true).parent().addClass('disabled');
            }
        }
    </script>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <!-- <h3>Demo:</h3> -->
                <div class="img-container">
                    <img id="image" src="https://images.unsplash.com/photo-1556912998-2e11c44a2a08?ixlib=rb-1.2.1&q=85&fm=jpg&crop=entropy&cs=srgb&ixid=eyJhcHBfaWQiOjgyMjQzfQ" alt="Picture">
                    <div class="frame loader">
                        <div class="center">
                            <div class="dot-1"></div>
                            <div class="dot-2"></div>
                            <div class="dot-3"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <!-- <h3>Preview:</h3> -->
                <div class="docs-preview clearfix">
                    <div class="img-preview preview-lg"></div>
                    <div class="img-preview preview-md"></div>
                    <div class="img-preview preview-sm"></div>
                    <div class="img-preview preview-xs"></div>
                </div>

                <!-- <h3>Data:</h3> -->
                <div class="docs-data">
                    <div class="input-group input-group-sm">
                        <span class="input-group-prepend">
                            <label class="input-group-text" for="dataX">X</label>
                        </span>
                        <input type="text" class="form-control" id="dataX" placeholder="x">
                        <span class="input-group-append">
                            <span class="input-group-text">px</span>
                        </span>
                    </div>
                    <div class="input-group input-group-sm">
                        <span class="input-group-prepend">
                            <label class="input-group-text" for="dataY">Y</label>
                        </span>
                        <input type="text" class="form-control" id="dataY" placeholder="y">
                        <span class="input-group-append">
                            <span class="input-group-text">px</span>
                        </span>
                    </div>
                    <div class="input-group input-group-sm">
                        <span class="input-group-prepend">
                            <label class="input-group-text" for="dataWidth">Width</label>
                        </span>
                        <input type="text" class="form-control" id="dataWidth" placeholder="width">
                        <span class="input-group-append">
                            <span class="input-group-text">px</span>
                        </span>
                    </div>
                    <div class="input-group input-group-sm">
                        <span class="input-group-prepend">
                            <label class="input-group-text" for="dataHeight">Height</label>
                        </span>
                        <input type="text" class="form-control" id="dataHeight" placeholder="height">
                        <span class="input-group-append">
                            <span class="input-group-text">px</span>
                        </span>
                    </div>
                    <div class="input-group input-group-sm">
                        <span class="input-group-prepend">
                            <label class="input-group-text" for="dataRotate">Rotate</label>
                        </span>
                        <input type="text" class="form-control" id="dataRotate" placeholder="rotate">
                        <span class="input-group-append">
                            <span class="input-group-text">deg</span>
                        </span>
                    </div>
                    <div class="input-group input-group-sm">
                        <span class="input-group-prepend">
                            <label class="input-group-text" for="dataScaleX">ScaleX</label>
                        </span>
                        <input type="text" class="form-control" id="dataScaleX" placeholder="scaleX">
                    </div>
                    <div class="input-group input-group-sm">
                        <span class="input-group-prepend">
                            <label class="input-group-text" for="dataScaleY">ScaleY</label>
                        </span>
                        <input type="text" class="form-control" id="dataScaleY" placeholder="scaleY">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9 docs-buttons">
                <!-- <h3>Toolbar:</h3> -->
                <div class="btn-group">
                    <button type="button" class="btn btn-primary" data-method="setDragMode" data-option="move" title="Move">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(" setDragMode", "move" )">
                            <span class="fa fa-arrows"></span>
                        </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="setDragMode" data-option="crop" title="Crop">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(" setDragMode", "crop" )">
                            <span class="fa fa-crop"></span>
                        </span>
                    </button>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.1" title="Zoom In">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(" zoom", 0.1)">
                            <span class="fa fa-search-plus"></span>
                        </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.1" title="Zoom Out">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(" zoom", -0.1)">
                            <span class="fa fa-search-minus"></span>
                        </span>
                    </button>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-primary" data-method="move" data-option="-10" data-second-option="0" title="Move Left">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(" move", -10, 0)">
                            <span class="fa fa-arrow-left"></span>
                        </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="move" data-option="10" data-second-option="0" title="Move Right">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(" move", 10, 0)">
                            <span class="fa fa-arrow-right"></span>
                        </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="-10" title="Move Up">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(" move", 0, -10)">
                            <span class="fa fa-arrow-up"></span>
                        </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="10" title="Move Down">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(" move", 0, 10)">
                            <span class="fa fa-arrow-down"></span>
                        </span>
                    </button>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-primary" data-method="rotate" data-option="-45" title="Rotate Left">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(" rotate", -45)">
                            <span class="fa fa-rotate-left"></span>
                        </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="rotate" data-option="45" title="Rotate Right">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(" rotate", 45)">
                            <span class="fa fa-rotate-right"></span>
                        </span>
                    </button>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-primary" data-method="scaleX" data-option="-1" title="Flip Horizontal">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(" scaleX", -1)">
                            <span class="fa fa-arrows-h"></span>
                        </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="scaleY" data-option="-1" title="Flip Vertical">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(" scaleY", -1)">
                            <span class="fa fa-arrows-v"></span>
                        </span>
                    </button>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-primary" data-method="crop" title="Crop">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(" crop")">
                            <span class="fa fa-check"></span>
                        </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="clear" title="Clear">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(" clear")">
                            <span class="fa fa-remove"></span>
                        </span>
                    </button>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-primary" data-method="disable" title="Disable">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(" disable")">
                            <span class="fa fa-lock"></span>
                        </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="enable" title="Enable">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(" enable")">
                            <span class="fa fa-unlock"></span>
                        </span>
                    </button>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-primary" data-method="reset" title="Reset">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(" reset")">
                            <span class="fa fa-refresh"></span>
                        </span>
                    </button>
                    <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
                        <input type="file" class="sr-only" id="inputImage" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="Import image with Blob URLs">
                            <span class="fa fa-upload"></span>
                        </span>
                    </label>
                    <button type="button" class="btn btn-primary" data-method="destroy" title="Destroy">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(" destroy")">
                            <span class="fa fa-power-off"></span>
                        </span>
                    </button>
                </div>

                <div class="btn-group btn-group-crop">
                    <button type="button" class="btn btn-success" data-method="getCroppedCanvas" data-option="{ " maxWidth": 4096, "maxHeight" : 4096 }">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(" getCroppedCanvas", { maxWidth: 4096, maxHeight: 4096 })">
                            Get Cropped Canvas
                        </span>
                    </button>
                    <button type="button" class="btn btn-success" data-method="getCroppedCanvas" data-option="{ " width": 160, "height" : 90 }">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(" getCroppedCanvas", { width: 160, height: 90 })">
                            160×90
                        </span>
                    </button>
                    <button type="button" class="btn btn-success" data-method="getCroppedCanvas" data-option="{ " width": 320, "height" : 180 }">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(" getCroppedCanvas", { width: 320, height: 180 })">
                            320×180
                        </span>
                    </button>
                </div>

                <!-- Show the cropped image in modal -->
                <div class="modal fade docs-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="getCroppedCanvasTitle">Cropped</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <a class="btn btn-primary" id="download" href="javascript:void(0);" download="cropped.jpg">Download</a>
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal -->

                <button type="button" class="btn btn-secondary" data-method="getData" data-option data-target="#putData">
                    <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(" getData")">
                        Get Data
                    </span>
                </button>
                <button type="button" class="btn btn-secondary" data-method="setData" data-target="#putData">
                    <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(" setData", data)">
                        Set Data
                    </span>
                </button>
                <button type="button" class="btn btn-secondary" data-method="getContainerData" data-option data-target="#putData">
                    <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(" getContainerData")">
                        Get Container Data
                    </span>
                </button>
                <button type="button" class="btn btn-secondary" data-method="getImageData" data-option data-target="#putData">
                    <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(" getImageData")">
                        Get Image Data
                    </span>
                </button>
                <button type="button" class="btn btn-secondary" data-method="getCanvasData" data-option data-target="#putData">
                    <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(" getCanvasData")">
                        Get Canvas Data
                    </span>
                </button>
                <button type="button" class="btn btn-secondary" data-method="setCanvasData" data-target="#putData">
                    <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(" setCanvasData", data)">
                        Set Canvas Data
                    </span>
                </button>
                <button type="button" class="btn btn-secondary" data-method="getCropBoxData" data-option data-target="#putData">
                    <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(" getCropBoxData")">
                        Get Crop Box Data
                    </span>
                </button>
                <button type="button" class="btn btn-secondary" data-method="setCropBoxData" data-target="#putData">
                    <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(" setCropBoxData", data)">
                        Set Crop Box Data
                    </span>
                </button>
                <button type="button" class="btn btn-secondary" data-method="moveTo" data-option="0">
                    <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="cropper.moveTo(0)">
                        Move to [0,0]
                    </span>
                </button>
                <button type="button" class="btn btn-secondary" data-method="zoomTo" data-option="1">
                    <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="cropper.zoomTo(1)">
                        Zoom to 100%
                    </span>
                </button>
                <button type="button" class="btn btn-secondary" data-method="rotateTo" data-option="180">
                    <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="cropper.rotateTo(180)">
                        Rotate 180°
                    </span>
                </button>
                <button type="button" class="btn btn-secondary" data-method="scale" data-option="-2" data-second-option="-1">
                    <span class="docs-tooltip" data-toggle="tooltip" title="cropper.scale(-2, -1)">
                        Scale (-2, -1)
                    </span>
                </button>
                <textarea type="text" class="form-control" id="putData" rows="1" placeholder="Get data to here or set data with this value"></textarea>
            </div><!-- /.docs-buttons -->

            <div class="col-md-3 docs-toggles">
                <!-- <h3>Toggles:</h3> -->
                <div class="btn-group d-flex flex-nowrap" data-toggle="buttons">
                    <label class="btn btn-primary active">
                        <input type="radio" class="sr-only" id="aspectRatio0" name="aspectRatio" value="1.7777777777777777">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="aspectRatio: 16 / 9">
                            16:9
                        </span>
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" class="sr-only" id="aspectRatio1" name="aspectRatio" value="1.3333333333333333">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="aspectRatio: 4 / 3">
                            4:3
                        </span>
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" class="sr-only" id="aspectRatio2" name="aspectRatio" value="1">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="aspectRatio: 1 / 1">
                            1:1
                        </span>
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" class="sr-only" id="aspectRatio3" name="aspectRatio" value="0.6666666666666666">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="aspectRatio: 2 / 3">
                            2:3
                        </span>
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" class="sr-only" id="aspectRatio4" name="aspectRatio" value="NaN">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="aspectRatio: NaN">
                            Free
                        </span>
                    </label>
                </div>

                <div class="btn-group d-flex flex-nowrap" data-toggle="buttons">
                    <label class="btn btn-primary">
                        <input type="radio" class="sr-only" id="viewMode0" name="viewMode" value="0" checked>
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="View Mode 0">
                            VM0
                        </span>
                    </label>
                    <label class="btn btn-primary active">
                        <input type="radio" class="sr-only" id="viewMode1" name="viewMode" value="1">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="View Mode 1">
                            VM1
                        </span>
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" class="sr-only" id="viewMode2" name="viewMode" value="2">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="View Mode 2">
                            VM2
                        </span>
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" class="sr-only" id="viewMode3" name="viewMode" value="3">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="View Mode 3">
                            VM3
                        </span>
                    </label>
                </div>

                <div class="dropdown dropup docs-options">
                    <button type="button" class="btn btn-primary btn-block dropdown-toggle" id="toggleOptions" data-toggle="dropdown" aria-expanded="true">
                        Toggle Options
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="toggleOptions" role="menu">
                        <li class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" id="responsive" type="checkbox" name="responsive" checked>
                                <label class="form-check-label" for="responsive">responsive</label>
                            </div>
                        </li>
                        <li class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" id="restore" type="checkbox" name="restore" checked>
                                <label class="form-check-label" for="restore">restore</label>
                            </div>
                        </li>
                        <li class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" id="checkCrossOrigin" type="checkbox" name="checkCrossOrigin" checked>
                                <label class="form-check-label" for="checkCrossOrigin">checkCrossOrigin</label>
                            </div>
                        </li>
                        <li class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" id="checkOrientation" type="checkbox" name="checkOrientation" checked>
                                <label class="form-check-label" for="checkOrientation">checkOrientation</label>
                            </div>
                        </li>
                        <li class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" id="modal" type="checkbox" name="modal" checked>
                                <label class="form-check-label" for="modal">modal</label>
                            </div>
                        </li>
                        <li class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" id="guides" type="checkbox" name="guides" checked>
                                <label class="form-check-label" for="guides">guides</label>
                            </div>
                        </li>
                        <li class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" id="center" type="checkbox" name="center" checked>
                                <label class="form-check-label" for="center">center</label>
                            </div>
                        </li>
                        <li class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" id="highlight" type="checkbox" name="highlight" checked>
                                <label class="form-check-label" for="highlight">highlight</label>
                            </div>
                        </li>
                        <li class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" id="background" type="checkbox" name="background" checked>
                                <label class="form-check-label" for="background">background</label>
                            </div>
                        </li>
                        <li class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" id="autoCrop" type="checkbox" name="autoCrop" checked>
                                <label class="form-check-label" for="autoCrop">autoCrop</label>
                            </div>
                        </li>
                        <li class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" id="movable" type="checkbox" name="movable" checked>
                                <label class="form-check-label" for="movable">movable</label>
                            </div>
                        </li>
                        <li class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" id="rotatable" type="checkbox" name="rotatable" checked>
                                <label class="form-check-label" for="rotatable">rotatable</label>
                            </div>
                        </li>
                        <li class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" id="scalable" type="checkbox" name="scalable" checked>
                                <label class="form-check-label" for="scalable">scalable</label>
                            </div>
                        </li>
                        <li class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" id="zoomable" type="checkbox" name="zoomable" checked>
                                <label class="form-check-label" for="zoomable">zoomable</label>
                            </div>
                        </li>
                        <li class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" id="zoomOnTouch" type="checkbox" name="zoomOnTouch" checked>
                                <label class="form-check-label" for="zoomOnTouch">zoomOnTouch</label>
                            </div>
                        </li>
                        <li class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" id="zoomOnWheel" type="checkbox" name="zoomOnWheel" checked>
                                <label class="form-check-label" for="zoomOnWheel">zoomOnWheel</label>
                            </div>
                        </li>
                        <li class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" id="cropBoxMovable" type="checkbox" name="cropBoxMovable" checked>
                                <label class="form-check-label" for="cropBoxMovable">cropBoxMovable</label>
                            </div>
                        </li>
                        <li class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" id="cropBoxResizable" type="checkbox" name="cropBoxResizable" checked>
                                <label class="form-check-label" for="cropBoxResizable">cropBoxResizable</label>
                            </div>
                        </li>
                        <li class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" id="toggleDragModeOnDblclick" type="checkbox" name="toggleDragModeOnDblclick" checked>
                                <label class="form-check-label" for="toggleDragModeOnDblclick">toggleDragModeOnDblclick</label>
                            </div>
                        </li>
                    </ul>
                </div><!-- /.dropdown -->
            </div><!-- /.docs-toggles -->
        </div>
        <h2>Here is the <a href="http://fengyuanchen.github.io/cropper/" target="_blank">Original Source</a></h2>
    </div>
    <!-- Alert -->

</body>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://fengyuanchen.github.io/js/common.js"></script>
<script src="https://unpkg.com/cropperjs/dist/cropper.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropper/4.0.0/cropper.min.js"></script>




</html>