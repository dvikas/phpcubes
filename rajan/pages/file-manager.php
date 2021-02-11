<?php
require_once("header.php");
?>
    <!-- Custom CSS -->
  <link href="../dist/css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
  <link href="../dist/css/elfinder.min.css" rel="stylesheet">
  <link href="../dist/css/elfinder.theme.css" rel="stylesheet">

			<div class="row">
					<div class="container" style="margin-top: 20px;">
						<div class="file-manager"></div>
					</div>
			</div><!--/row-->

<!-- file manager library -->
<script src="../js/jquery-1.7.2.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../dist/js/sb-admin-2.js"></script>
<!-- jQuery UI -->
<script src="../js/jquery-ui.min.js"></script>


	<!-- rich text editor library -->
  <!-- rich text editor library -->
  <script src="../js/jquery.cleditor.min.js"></script>
  <!-- file manager library -->
  <script src="../js/jquery.elfinder.min.js"></script>

<script type="text/javascript">
    //file manager
	var elf = $('.file-manager').elfinder({
		url : '../misc/elfinder-connector/connector.php'  // connector URL (REQUIRED)
	}).elfinder('instance');
</script>
<style type="text/css">
    .ui-widget {
        font-family: Verdana,Arial,sans-serif;
        font-size: 1.5em;
    }


    .ui-state-default.elfinder-button.ui-state-disabled {
        height: 28px;
        width: 28px;
    }

    .ui-state-default.elfinder-button{
        height: 28px;
        width: 28px;
    }

</style>
