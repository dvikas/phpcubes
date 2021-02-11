<?php
require_once('header.php');
// DELETE REQUEST
  if(isset($_GET['delete']) != ''){
    $id = $_GET['delete'];
    $query_delete = "UPDATE `links` SET `status`='0' WHERE `id`='$id' OR `parent_id`='$id'";
    mysql_query($query_delete) or die(mysql_error().' Unable to update status 0 of links');
    echo "Links Moved To Trash";
  }
// END LINK DELETE
$parentQuery = "SELECT `id`,`title`,`position`,`status` FROM `links` WHERE `status`='1' AND `parent_id`=0 ORDER BY `position`";
$parentResult = mysql_query($parentQuery) or die("Unbale to fetch Records from parent");

while($parent = mysql_fetch_assoc($parentResult)) {


  $childQuery = "SELECT `id`,`title`,`position`,`parent_id`,`status` FROM `links` WHERE  `status`='1' AND  `parent_id`=".$parent['id']." ORDER BY `position`";
  $childResult = mysql_query($childQuery) or die("Unbale to fetch Records from child");

  while($child = mysql_fetch_assoc($childResult)) {

    $subChildQuery = "SELECT `id`,`title`,`position`,`parent_id`,`status` FROM `links` WHERE  `status`='1' AND  `parent_id`=".$child['id']." ORDER BY `position`";
    $subChildResult = mysql_query($subChildQuery) or die("Unbale to fetch Records from sub child");
     $child['title'] = '<i class="fa fa-circle-thin"></i>&nbsp;&nbsp;&nbsp;'.$child['title'];
    $childRows[] = $child;
    if(mysql_num_rows($subChildResult) > 0){
      while($subChild = mysql_fetch_assoc($subChildResult)) {
        $subChild['title'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i><span class="text-muted">'.$subChild['title'].'</span>';
        $childRows[] = $subChild;
      }
    }
  }

  if(isset($childRows)) {
    $parent['child'] = $childRows;
  } else {
    $parent['child'] = array();
  }

  $parentRows[] = $parent;
  unset($parent);
  unset(  $childResult);
  unset(  $childRows);
}
//echo "<pre>";
//print_r($parentRows);

?>

<div class="col-sm-12">
<ul id="sort_parent" class="list-unstyled panel-group" aria-multiselectable="true" role="tablist">
<?php

foreach($parentRows as $pvalue) {

?>

  <li  class="panel panel-default" id="parent_<?=$pvalue['id']?>">

  <div id="heading_<?=$pvalue['id']?>" role="tab" class="panel-heading">
	  <h4 class="panel-title">
		<a aria-controls="collapse_<?=$pvalue['id']?>" aria-expanded="false" href="#collapse<?=$pvalue['id']?>" data-parent="#accordion" 
		data-toggle="collapse" class="collapsed"><?=$pvalue['title']?></a>

		<?=' <span class="badge">'.count($pvalue['child']).'</span>'?>
		<span style="float:right;margin-left:10px;"><a href="index.php?delete=<?=$pvalue['id']?>" onclick="return confirm('sure ?');"><i class="fa fa-trash"></i></a></span>

		<span style="float:right;margin-left:10px;" ><a href='edit-links.php?edit=<?=$pvalue['id']?>' ><i class="fa fa-pencil-square-o"></i></a></span>

	  </h4>
  </div>



    <div aria-labelledby="heading_<?=$pvalue['id']?>" role="tabpanel" class="panel-collapse collapse" 
    id="collapse<?=$pvalue['id']?>" aria-expanded="false" style="height: 0px;" id="child_<?=$pvalue['id']?>">
		<ul class="list-group sort_child">
<?php
if(isset($pvalue['child']) && !empty($pvalue['child'])) {
foreach($pvalue['child'] as $cvalue) {
  if($cvalue['status'] == 0 ) {
    $style = 'style="color:red"';
    $enableBtn = '<button class="btn btn-mini btn-warning enableDelete" type="button" id="'.$cvalue['id'].'">Enable</button>';
  } else {
    $style = '';
    $enableBtn = '';
  }
?>

      <li class="list-group-item" id="child_<?=$cvalue['id']?>" <?=$style?>>
        <span>
          <span style="float:left" class="handle"><?=$cvalue['title']?></span>

		  <span style="float:right;margin-left:20px;"><a href="menu.php?delete=<?=$cvalue['id']?>" onclick="return confirm('sure ?');"><i class="fa fa-trash-o"></i></a></span>

		  <a style="float:right;margin-left:20px;" href='edit-links.php?edit=<?=$cvalue['id']?>' ><i class="fa fa-pencil-square-o"></i></a><?=$enableBtn?>

		  <a style="margin-left:20px;" id="menuFancyId" title="Open Edit" target="__blank"  href='content.php?id=<?=$cvalue['id']?>' >
		  <i class="fa fa-paper-plane"></i></a>

        </span>
      </li>

<?php
}
}
?>
    </ul>

  </div>

<?php
}
?>
</ul>
</div>

<?php include('footer.php'); ?>
