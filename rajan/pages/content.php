<?php
require_once('header.php');
?>

    <div class="container" style="margin-top: 20px;">
    
        <div class="row">
			
			<div role="tabpanel">

			  <!-- Nav tabs -->
			  <ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#contentData" aria-controls="contentData" role="tab" data-toggle="tab">Edit content</a></li>
				<li role="presentation"><a href="#contentMenu" aria-controls="contentMenu" role="tab" data-toggle="tab">Menu</a></li>
				<li role="presentation"><a href="#contentHelp" aria-controls="contentHelp" role="tab" data-toggle="tab">Help</a></li>				
				<li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
			  </ul>

			  <!-- Tab panes -->
			  <div class="tab-content">
				
				<div role="tabpanel" class="tab-pane active" id="contentData" style="padding-top:20px;">
					<?php require_once('_content_data.php')?>				
				</div>
				
				<div role="tabpanel" class="tab-pane" id="contentMenu"  style="padding-top:20px;">
					<?php require_once('_content_menu.php')?>
				</div>
								
				<div role="tabpanel" class="tab-pane" id="contentHelp"  style="padding-top:20px;">
					<?php require_once('_content_help.php')?>
				</div><!--/contentHelp-->				

				<div role="tabpanel" class="tab-pane" id="settings">...</div>
			  </div>

			</div>
			
          </div><!--/row--> 
      </div>
<?php include('footer.php'); ?>

    <link rel="stylesheet" href="codemirror/codemirror.css">
    <!-- CodeMirror syntax highlighing code editor -->
    <script src="codemirror/codemirror.min.js"></script>
   

    <script src="codemirror/xml-fold.js"></script>
	<script src="codemirror/matchtags.js"></script>
    <script src="codemirror/xml.min.js"></script>
	<script src="codemirror/fullscreen.js"></script> 
<!--
	<script src="codemirror/hardwrap.js"></script> 
-->

<script>
	window.onload = function() {
	var yourTextarea = 	document.getElementById("text-content-id");
	var editor = CodeMirror.fromTextArea(yourTextarea, {
    lineNumbers: true,
    extraKeys: {
        "F11": function(cm) {
          cm.setOption("fullScreen", !cm.getOption("fullScreen"));
        },
        "Esc": function(cm) {
          if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
        },
        "Ctrl-J": "toMatchingTag",
        //"Ctrl-Q": function(cm) { 
			//setTimeout(function() {
				//cm.wrapParagraph(cm.getCursor(), options); 				
			//}, 200);
			//},
    },
    matchTags: {bothTags: true},
  });
   editor.setSize(1200, 600);
   // on and off handler like in jQuery
	editor.on('change',function(cMirror){
	  // get value right from instance
	  yourTextarea.value = cMirror.getValue();
	});

	//var wait, options = {column: 120};
	//editor.on("change", function(cm, change) {
	  //clearTimeout(wait);
	  //wait = setTimeout(function() {
		//console.log(cm.wrapParagraphsInRange(change.from, CodeMirror.changeEnd(change), options));
	  //}, 200);
	//});
}
</script>
<style type="text/css">
	.CodeMirror-fullscreen {
	  position: fixed;
	  top: 190px; left: 0; right: 0; bottom: 0;
	  height: auto;
	  z-index: 9;
	}
</style>

<script type="text/javascript">
	$(document).ready(function(){
		$('button.saveContent').on('click',function(){
			var that = $(this);
			var frm = $('#text-content-id').val();
			$.ajax({
				url : '_content_ajax_savecontent.php',
				data : {content:frm,'id':$('#contentId').val()},
				type : 'post',
				dataType : 'json',
				beforeSend : function(){
					$('#contentLoaderId').show();
					that.addClass('disabled');
					$('#contentLoaderTxtId').html('').fadeIn();
				},
				success : function(data){
					if(data == 2){
						$('#contentLoaderTxtId').html('&nbsp;&nbsp;&nbsp;No Update');
					} else if(data == 1){
						$('#contentLoaderTxtId').html('&nbsp;&nbsp;&nbsp;Content Updated..');
					} else {
						$('#contentLoaderTxtId').html('&nbsp;&nbsp;&nbsp;Error');
					}
					setTimeout(function(){
						$('#contentLoaderTxtId').fadeOut('slow')
					},3000);
				},
				complete : function(){
					$('#contentLoaderId').hide();
					that.removeClass('disabled');
				}
			});
		});
	});
</script>
