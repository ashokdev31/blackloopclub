<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
    var nwFontCssLink = '<link rel="stylesheet" type="text/css" ' +
        'href="blk-corp-assets/include/bundles/minified-ff613f557436be79502bdcfb1496ebb8.css" />',
        ASSET_PREFIX_PATH = 'http://assets.blackrock.com/blk-corp-assets/';
</script>
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/message-box.js" type="text/javascript"></script>
<script src="js/plugins/sortable.js" type="text/javascript"></script>
<script src="js/fileinput.js" type="text/javascript"></script>
<script src="js/plugins/canvas-to-blob.min.js"></script>
<script src="js/form-elements.min.js"></script>
<script src="themes/explorer-fa/theme.js" type="text/javascript"></script>
<script src="themes/fa/theme.js" type="text/javascript"></script>
<script src="js/popper.min.js" type="text/javascript"></script>
<script src="flickity/js/flickity-docs.min.js" type="text/javascript"></script>
<script type="text/javascript"
        src="blk-corp-assets/include/bundles/minified-1fcdef76d627bd299322d26272e9a1fa.js"></script>
<script type="text/javascript"
        src="blk-corp-assets/include/bundles/minified-c421b4b8ea0c63b6ce80b0c9e42eb297.js"></script>
<script type="text/javascript"
        src="blk-corp-assets/include/bundles/minified-ba02d03bd206bfb4861ff9055dd26ea0.js"></script>
<script type="text/javascript"
        src="blk-corp-assets/include/bundles/minified-5cd16dc5d3a50291ec5ae4bc24117fdb.js"></script>
<script type="text/javascript"
        src="blk-corp-assets/include/bundles/minified-198308703977442307c4e50b4e693fd2.js"></script>
<script src="account/assets/plugins/modals/classie.js" type="text/javascript"></script>
<script src="account/assets/plugins/modals/modalEffects.js" type="text/javascript"></script>
<script src="account/assets/plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
<script src="sliderengine/amazingslider.js"></script>
<link rel="stylesheet" type="text/css" href="sliderengine/amazingslider-1.css">
<script src="sliderengine/initslider-1.js"></script>

<script type="text/javascript">

$('#file-fr').fileinput({
    theme: 'fa',
    language: 'fr',
    uploadUrl: '#',
    allowedFileExtensions: ['jpg', 'png', 'gif']
});
$('#file-es').fileinput({
    theme: 'fa',
    language: 'es',
    uploadUrl: '#',
    allowedFileExtensions: ['jpg', 'png', 'gif']
});
$("#file-0").fileinput({
    theme: 'fa',
    'allowedFileExtensions': ['jpg', 'png', 'gif']
});
$("#file-1").fileinput({
    theme: 'fa',
    uploadUrl: '#', // you must set a valid URL here else you will get an error
    allowedFileExtensions: ['jpg', 'png', 'gif'],
    overwriteInitial: false,
    maxFileSize: 1000,
    maxFilesNum: 10,
    //allowedFileTypes: ['image', 'video', 'flash'],
    slugCallback: function (filename) {
        return filename.replace('(', '_').replace(']', '_');
    }
});
/*
 $(".file").on('fileselect', function(event, n, l) {
 alert('File Selected. Name: ' + l + ', Num: ' + n);
 });
 */
$("#file-3").fileinput({
    theme: 'fa',
    showUpload: false,
    showCaption: false,
    browseClass: "btn btn-primary btn-lg",
    fileType: "any",
    previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
    overwriteInitial: false,
    initialPreviewAsData: true,
    initialPreview: [
        "http://lorempixel.com/1920/1080/transport/1",
        "http://lorempixel.com/1920/1080/transport/2",
        "http://lorempixel.com/1920/1080/transport/3"
    ],
    initialPreviewConfig: [
        {caption: "transport-1.jpg", size: 329892, width: "120px", url: "{$url}", key: 1},
        {caption: "transport-2.jpg", size: 872378, width: "120px", url: "{$url}", key: 2},
        {caption: "transport-3.jpg", size: 632762, width: "120px", url: "{$url}", key: 3}
    ]
});
$("#file-4").fileinput({
    theme: 'fa',
    uploadExtraData: {kvId: '10'}
});
$(".btn-warning").on('click', function () {
    var $el = $("#file-4");
    if ($el.attr('disabled')) {
        $el.fileinput('enable');
    } else {
        $el.fileinput('disable');
    }
});
$(".btn-info").on('click', function () {
    $("#file-4").fileinput('refresh', {previewClass: 'bg-info'});
});
/*
 $('#file-4').on('fileselectnone', function() {
 alert('Huh! You selected no files.');
 });
 $('#file-4').on('filebrowse', function() {
 alert('File browse clicked for #file-4');
 });
 */
$(document).ready(function () {
    $("#test-upload").fileinput({
        'theme': 'fa',
        'showPreview': false,
        'allowedFileExtensions': ['jpg', 'png', 'gif'],
        'elErrorContainer': '#errorBlock'
    });
    $("#kv-explorer").fileinput({
        'theme': 'explorer-fa',
        'uploadUrl': '#',
        overwriteInitial: false,
        initialPreviewAsData: true,
        initialPreview: [
            "http://lorempixel.com/1920/1080/nature/1",
            "http://lorempixel.com/1920/1080/nature/2",
            "http://lorempixel.com/1920/1080/nature/3"
        ],
        initialPreviewConfig: [
            {caption: "nature-1.jpg", size: 329892, width: "120px", url: "{$url}", key: 1},
            {caption: "nature-2.jpg", size: 872378, width: "120px", url: "{$url}", key: 2},
            {caption: "nature-3.jpg", size: 632762, width: "120px", url: "{$url}", key: 3}
        ]
    });
    /*
     $("#test-upload").on('fileloaded', function(event, file, previewId, index) {
     alert('i = ' + index + ', id = ' + previewId + ', file = ' + file.name);
     });
     */
});
</script>
<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
(function(){ var widget_id = 'pHxa2Wxly4';var d=document;var w=window;function l(){
var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();</script>
<!-- {/literal} END JIVOSITE CODE -->

<script>
    jQuery(document).ready(function () {
        Main.init();
        FormElements.init();
    });
</script>
