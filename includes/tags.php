<?php
if(isset($ans_select_post['c_id'])) {
	$post_id = $ans_select_post['c_id'];
	pr($ans_select_post);
}

  $tags_request = findAll('tags');
  while($tag = mysql_fetch_assoc($tags_request)){
    $tags[$tag['id']] = $tag['name'];
  }

//pr1('ALL TAGS');
//pr($tags);
  $new_tags_keys = array();
  // POST TAG ASD SAVE / UPDATE
  if(isset($_POST['tags']) && !empty($_POST['tags'])) {
    $posted_tags = explode(',',$_POST['tags']);
    $posted_tags = array_map('trim',$posted_tags);
    $extra_added_tag = array_diff($posted_tags, $tags);
    if(!empty($extra_added_tag)){
      foreach($extra_added_tag as $tag) {
        $newTagId = insert('tags', array('name'=>$tag));
        $tags[$newTagId] = $tag;
      }
    }
//pr1( 'EXTRA');
//pr($extra_added_tag);
//pr1( 'POSTED TAGS');
//pr($posted_tags);
//pr1( 'COMMON TAGS');
$new_tags_keys = array_keys(array_intersect($tags,$posted_tags));
//pr($new_tags_keys);
    update('links',array('tags'=>implode(',',$new_tags_keys)), "id=$post_id");
  }// end if posted

  $tags_string = implode(',',$tags);//for auto suggest on tags.php

//pr1('tags in DB');
//pr($ans_select_post['tags']);
  ////////////////////////////////
  $saved_tags_id = @$ans_select_post['tags'];//saved tags for current post (@ may be no tag )
  $saved_tags_id = explode(',',$saved_tags_id);
  $saved_tags_id = array_merge($saved_tags_id,$new_tags_keys);
  $saved_tags = array();
  $saved_tags_id = array_filter($saved_tags_id);

  if(!empty($saved_tags_id)) {
    foreach($saved_tags_id as $val){
      $saved_tags[] = $tags[$val];
    }
  }
  $saved_tags = implode(',',$saved_tags); // used in index.php as text field for pre loaded text
//pr1('Saved tAgs');
pr(  $saved_tags, __LINE__ , __FILE__);
  ////////////////////////////////

?>
<!----- All Tags get by JS for auto suggest---->
<input type="hidden" style="display:none;" readonly name="tags_hidden" id="tags_hidden_id" value="<?=$tags_string?>">


<?php
if(!isset($_SESSION['id'])) {
?>
   <style>
   ul.tagit li.tagit-new {
    display: block;
   }
   </style>
<?php
}
?>

