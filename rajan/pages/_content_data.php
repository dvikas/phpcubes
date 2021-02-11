<?php
  $id = isset($_GET['id'])?$_GET['id']:0;
  $msg = null;  
if (isset($_POST['submit']) && $_POST['submit']=='Save') {
  $content =  mysql_real_escape_string($_POST['content']);
  $query = "UPDATE `links` SET `content`='".$content."' WHERE id = ".$id;
  mysql_query($query) or die('Unable to insert values'.mysql_error());
    if(mysql_affected_rows() > 0 ){
      $msg =  "Data updated successfully";
    }
  }

  $selectContent = "SELECT * FROM `links` WHERE `id` = '".$id."'";
  $selectResult = mysql_query($selectContent) or die('unable to select content');
  if(mysql_num_rows($selectResult) > 0){
      $contentData = mysql_fetch_assoc($selectResult);
      $content = stripslashes($contentData['content']);
      $keywords = $contentData['keywords'];
      $description = $contentData['description'];
      $title = $contentData['titleOfHead'];
      $requestParentId = $contentData['parent_id'];
      $alias = $contentData['alias'];
  }
?>
<?php if($msg != null) {?>
    <div class="alert alert-success alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <i class="fa fa-check fa-2x"></i><?php echo $msg?>
    </div>
    <?php }?>
    
<?php 

if($id != 0) {
?>
<form action="" id="contentFormId" method="post">
	<input type="hidden" id="contentId" value="<?=$id?>">	
	<div class="form-group pull-left" >   	
		<a class="btn btn-default pull-left" style="margin-right:10px;" target="__blank" href="<?=BASE_URL.'/'.$alias?>">Open Page</a>
		<a class="btn btn-default pull-left" style="margin-right:10px;" target="_blank" href="http://ckeditor.com/demo#standard"><i class="fa fa-edit"></i> CK Editor </a>
		
		<span class="text-success pull-right strong" style="display:none;font-weight:bold;" id="contentLoaderId">&nbsp;&nbsp;<i class="text-success fa fa-refresh fa-spin"></i>&nbsp;Updating...</span>
		
		<span class="text-primary pull-right strong" style="font-weight:bold;" id="contentLoaderTxtId"></span>
		
		<button type="button" name="submit" class="btn btn-success pull-right saveContent" value="Save"><i class="fa fa-floppy-o"></i> Submit</button>
		
	</div>
	<div class="form-group pull-right col-sm-12">   
	
		<textarea  id="text-content-id" style="padding:10px;width:75em;height:75em;" name="content" class="form-control"><?=$content?></textarea>
		
	</div>

	<div class="form-group pull-left">   
		<button type="button" name="submit" class="btn btn-success pull-right saveContent" value="Save"><i class="fa fa-floppy-o"></i> Submit</button>					
	</div>  

</form>
<?php 
} else {
	echo 'Please add Menu';
}
?>
