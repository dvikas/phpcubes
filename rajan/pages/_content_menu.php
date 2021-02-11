<?php
 $parent_id = $child_parent_id = $last_parent_id = 0;
 $linkHref = $msg = $id = '';
 $editans = array();
    /*
     * If SubCat is present then replace main cat wwith sub cat 
     * */
     if(isset($_POST['sub_cat']) && !empty($_POST['sub_cat'])) {
       $_POST['parent_id'] = $_POST['sub_cat'];
     }

  // EDIT POST
  if(isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['title']) && !empty($_POST['title']) 
      && isset($_POST['submit']) && $_POST['submit']=='content_menu'){

    $id = $_POST['id'];
    $title = $_POST['title'];
    $alias = trim($_POST['alias']);
    $alias = str_replace(' ','',$alias);
    $titleOfHead = $_POST['titleOfHead'];
    $parent_id = $_POST['parent_id'];
    $keywords = $_POST['keywords'];
    $description = $_POST['description'];

    $update_query = "UPDATE `links` SET `title` = '$title', `alias` = '$alias', `titleOfHead` = '$titleOfHead', `parent_id` = '$parent_id', `keywords` = '$keywords', `description` = '$description'  WHERE `id`='$id'";
    mysql_query($update_query) or die('Unable to Update values'.mysql_error());
    if(mysql_affected_rows()>0){
      $msg =  "Link Updated Successfully";
    }
  }
// END EDIT POST

// SELECT LINK DETAILS
  if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = $_GET['id'];
    $query_edit = "SELECT * FROM `links` WHERE `id`='$id'";
    $result_edit = mysql_query($query_edit) or die(mysql_error().' Unable to select record to edit');
    $editans = mysql_fetch_assoc($result_edit);
    $last_parent_id = $editans['parent_id'];
    $child_parent_id = 0;//initially we imagine that there is no subCat
    $linkHref = 'content.php?id='.$id;
  }

// DATA POSTED INSERT NEW LINK
  //if($_POST['id']=="" && $_POST['title']!=""){
  if(isset($_POST['id']) && empty($_POST['id']) && isset($_POST['title']) && !empty($_POST['title']) 
      && isset($_POST['submit']) && $_POST['submit']=='content_menu' ){

    $title = $_POST['title'];
    $alias = $_POST['alias'];
    $titleOfHead = $_POST['titleOfHead'];
    $parent_id = $_POST['parent_id'];
    $keywords = $_POST['keywords'];
    $description = $_POST['description'];


    if($parent_id == '0'){

      $query_max_parent_id_0 = "SELECT MAX(`position`) AS 'position' FROM `links` WHERE `parent_id` = '0'";
      $result_max_parent_id_0 = mysql_query($query_max_parent_id_0)or die('UNABLE TO SELECT query_max_parent_id_0 '.mysql_error());
        if(mysql_num_rows($result_max_parent_id_0) > 0){
          $ans_max_parent_id_0 = mysql_fetch_assoc($result_max_parent_id_0);
          $max_id = $ans_max_parent_id_0['position'] + 1;
        }else{
          $max_id = 0;
        }
    }else{
      $query_max_parent_id_0 = "SELECT MAX(`position`) AS 'position' FROM `links` WHERE `parent_id` = '$parent_id'";
      $result_max_parent_id_0 = mysql_query($query_max_parent_id_0)or die('UNABLE TO SELECT query_max_parent_id_0 '.mysql_error());
        if(mysql_num_rows($result_max_parent_id_0) > 0){
          $ans_max_parent_id_0 = mysql_fetch_assoc($result_max_parent_id_0);
          $max_id = $ans_max_parent_id_0['position'] + 1;
        }else{
          $max_id = 0;
        }
    }

    $alias = trim($alias);
    $alias = str_replace(' ','',$alias);
  $query = "INSERT INTO `links` ( `title`, `titleOfHead`, `position`, `parent_id`, `alias`, `keywords`, `description`, `status`) VALUES ('$title', '$titleOfHead', '$max_id','$parent_id', '$alias', '$keywords', '$description', '1');";

    mysql_query($query) or die('Unable to insert values'.mysql_error());
    $insertId = mysql_insert_id();
    if(mysql_affected_rows() > 0 ){
      $msg =  "Data inserted successfully";
      header("location:content.php?id=$insertId");exit;
    }
  }
// END POST

// SELECT PARENT POSTS
    $query_select_parent = "SELECT * FROM `links` WHERE `status`='1' AND `parent_id`='0' ORDER BY position";
    $result_select_parent = mysql_query($query_select_parent) or die('Selection Fails'.mysql_error());
    if(mysql_num_rows($result_select_parent) > 0){
      $links_title = array();
      $i = 0;
      while($ans = mysql_fetch_assoc($result_select_parent)){

        $links_title[$i]['title'] = $ans['title'];
        $links_title[$i]['id'] = $ans['id'];
        $links_title[$i]['alias'] = $ans['alias'];
        $links_title[$i]['position'] = $ans['position'];

        $query_select_child = "SELECT * FROM `links` WHERE `status`='1' AND `parent_id`='".$ans['id']."' ORDER BY position";
        $result_select_child = mysql_query($query_select_child) or die('Selection child Fails'.mysql_error());

            while($ans = mysql_fetch_assoc($result_select_child)){
              unset($ans['content']);
              if($ans['id'] == $last_parent_id){
                $child_parent_id = $ans['id'];
                $last_parent_id = $ans['parent_id'];
              }
              $links_title[$i]['child'][] = $ans;
            }
        $i++;
      }
    }
// End SELECT
?>

<div class="row">
	<div class="container">
	    <?php if($msg != null) {?>
    <div class="alert alert-success alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <i class="fa fa-check fa-2x"></i><?php echo $msg?>
    </div>
    <?php }?>
    
<div class="col-sm-8">
<!-- START OF ADDING MENU -->
<form class="form-horizontal" name='form1' action='' method='post'>
	<input type='hidden' name='id' value="<?=$id?>">
	<input type="hidden" name="last_parent_id" id="last_parent_id" value="<?=$last_parent_id?>">
	<input type="hidden" name="child_parent_id" id="child_parent_id" value="<?=$child_parent_id?>">

	  <div class="form-group">
		<label for="inputEmail3" class="col-sm-5 control-label">Menu Name</label>
		<div class="col-sm-7">
		  
		    <div class="input-group">
              <input type="text" class="form-control" name="title" id="menuNameId" value="<?=@$editans['title']?>">
              <div class="input-group-addon"><a title="Fill other fields" href="javascript:void(0)"><span id="copyId"><i class="fa fa-copy"></i></span></a></div>
            </div>
		</div>
	  </div>

	  <div class="form-group">
		<label for="inputEmail3" class="col-sm-5 control-label">Alias(*)</label>
		<div class="col-sm-7">
			<input type='text' class="form-control"  name='alias' id="aliasId" size='50' value="<?=@$editans['alias']?>">
		</div>
	  </div>
	  
	  <div class="form-group">
		<label for="inputEmail3" class="col-sm-5 control-label">TitleofHead</label>
		<div class="col-sm-7">
			<input type='text' class="form-control"  name='titleOfHead' id="titleOfHeadId" size='50' value="<?=@$editans['titleOfHead']?>">
		</div>
	  </div>
	  
	  <div class="form-group">
		<label for="inputEmail3" class="col-sm-5 control-label">Category</label>
		<div class="col-sm-7">
				  <select class="form-control"  name="parent_id" id="catId">
					<option value='0' <?php if($parent_id == '0')echo "selected";?>>Parent</option>
<?php
if(count($links_title) >0){
foreach($links_title as $val){
?>
				  <option value='<?=$val['id']?>' <?php if($last_parent_id == $val['id'])echo "selected";?>><?=$val['title']?></option>
<?php
	}
  }
?>
				  </select>
		</div>
	  </div>
	  

	  <div class="form-group">
		<label for="inputEmail3" class="col-sm-5 control-label">SubCategory</label>
		<div class="col-sm-7">
			<div id="subCatId">
				<select class="form-control"  name='sub_cat' >
				  <option value=''>-Select-</option>
				</select>
		  </div>
		</div>
	  </div>

	  <div class="form-group">
		<label for="inputEmail3" class="col-sm-5 control-label">Keywords</label>
		<div class="col-sm-7">
			<textarea class="form-control"  name='keywords' rows='5' cols='50'><?=@$editans['keywords']?></textarea>
		</div>
	  </div>
	  
	  <div class="form-group">
		<label for="inputEmail3" class="col-sm-5 control-label">Description</label>
		<div class="col-sm-7">
			<textarea class="form-control"  name='description' rows='5' cols='50'><?=@$editans['description']?></textarea>
		</div>
	  </div>

	    <div class="form-group">
			<div class="col-sm-offset-5 col-sm-10">
			  <button type="submit" name="submit" value="content_menu" class="btn btn-default">Update</button>
			</div>
		</div>
      
    </form>
    </div><!--- end col-->
</div><!--- end container-->
</div><!---- end row---->
