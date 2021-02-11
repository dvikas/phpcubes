<?php
pr('', __LINE__ ,__FILE__);
  /****** UPDATE HITS ***/
  $hits_query = "UPDATE `links` SET `hits` = `hits` + 1 WHERE `alias` = '$link'";
  query($hits_query,__LINE__,__FILE__);
 //  $recent_query = "SELECT * FROM `links` WHERE `parent_id` != '0' AND `id`!='2' AND `status`='1' ORDER BY modified_date DESC LIMIT 0,10";
 // $recent_result = query($recent_query,__LINE__,__FILE__) or die(mysql_error());
  //pr($hits_query);exit;
  /////////////////////////////////

  $isChild  = false;
  $content_with_thumb = false;
  // START SELECT POSTS
  $query_select_post = "SELECT
   p.`id` as p_id,
   p.`parent_id` as p_pid,
   p.`title` as p_title,
   p.`alias` as p_alias,
   c.`id` as c_id,
   c.`parent_id` as c_pid,
   c.`content`,
   c.`keywords`,
   c.`description`,
   c.`title`,
   c.`alias`,
   c.`tags`,
   c.`titleOfHead`
    FROM links AS p LEFT JOIN links AS c  ON c.parent_id = p.id WHERE c.alias LIKE '$link' AND c.`status`='1'";

  $result_select_post = query($query_select_post,__LINE__,__FILE__) or die('Selection of link Fails<br>'.mysql_error());


  if(mysql_num_rows($result_select_post) > 0){

    $ans_select_post = mysql_fetch_assoc($result_select_post);
    $isChild = true;
  }
  // END SELECT POST
  //$ans_select_post = array_map('stripslashes',$ans_select_post);
//print_r($ans_select_post);

  // If $ans_select_post is not set then some one is looking for parent most
  if(!isset($ans_select_post)){
     $query_select_parent_most = "SELECT `id`,`parent_id`,`title`,`titleOfHead`,`content`,`alias`,`description`,`tags` FROM `links` WHERE
    `status`='1' AND `parent_id`=(SELECT `id` FROM `links` WHERE `alias`='$link' AND `status`='1')  ORDER BY `position`";
    $result_select_parent_most = query($query_select_parent_most,__LINE__,__FILE__) or die("Unable to get parent posts<br>".mysql_query());


    $child_ul = '<ul class="list-unstyled list-group well c">';
    $i=0;
    while($ans = mysql_fetch_assoc($result_select_parent_most)){

      $selected = ($i++ == 0)?'active':'';// make frist post selected
      $child_ul .= '<li ><a class="list-group-item '.$selected.'" href="'.BASE_URL.'/'.$ans['alias'].'"><i class="icon-caret-right"></i>'.$ans['title'].'</a></li>';
      $ans_select_parent_most[] = $ans;

    }
    $isSearch = $ans_select_parent_most;
    $child_ul .= '</ul>';
  } else
  if(isset($ans_select_post) && $ans_select_post['p_pid'] == 0 ){ // It has only one parent
    $query_select_parent_most = "SELECT `id`,`parent_id`,`title`,`titleOfHead`,`alias`,`description` FROM `links` WHERE `status`='1' AND `parent_id`='".$ans_select_post['c_pid']."'  ORDER BY `position`";
    $result_select_parent_most = query($query_select_parent_most,__LINE__,__FILE__) or die("Unable to get parent posts<br>".mysql_query());

    $child_ul = '<ul class="list-unstyled list-group well b">';
    while($ans = mysql_fetch_assoc($result_select_parent_most)){
#echo $ans_select_post['c_pid'],"-",$ans['id'],"<br>";
      $selected = ($ans_select_post['c_id'] == $ans['id'])?'active':'';
      $child_ul .= '<li ><a class="list-group-item '.$selected.'" href="'.BASE_URL.'/'.$ans['alias'].'"><i class="icon-caret-right"></i>'.$ans['title'].'</a></li>';
      $ans_select_parent_most[] = $ans;
    }
    $child_ul .= '</ul>';
         /*************** SHOW THUMB***************/
$isParentLinkQuery = "SELECT `id`,`title`,`alias`,`titleOfHead`,`description`,`tags` FROM `links` WHERE `status`='1' AND `parent_id` = ".$ans_select_post['c_id']."  ORDER BY `position`";

$isParentLinkResult = query($isParentLinkQuery,__LINE__,__FILE__) or die(mysql_error());
if (mysql_num_rows($isParentLinkResult) > 0 ) {
  while($ans = mysql_fetch_assoc($isParentLinkResult)) {
    $isSearch[] = $ans;
  }
}
        /******************************************/
    if(!isset($isSearch)){
      $onlyOneParent = true;
    }

  } else
  if(isset($ans_select_post) ){ // It has two parent
    $query_select_parent_most = "SELECT `id`,`parent_id`,`title`,`titleOfHead`,`alias`,`description` FROM `links` WHERE `status`='1' AND `parent_id`='".$ans_select_post['p_pid']."'  ORDER BY `position`";
    $result_select_parent_most = query($query_select_parent_most,__LINE__,__FILE__) or die("Unable to get parent posts<br>".mysql_query());
    $child_ul = '<ul class="list-unstyled list-group a">';
    while($ans = mysql_fetch_assoc($result_select_parent_most)){
#echo $ans_select_post['c_pid'],"-",$ans['id'],"<br>";

      $selected = ($ans_select_post['c_pid'] == $ans['id'])?'active':'';
      $child_ul .= '<li ><a class="list-group-item '.$selected.'" href="'.BASE_URL.'/'.$ans['alias'].'"><i class="icon-caret-right"></i>'.$ans['title'].'</a></li>';
      $ans_select_parent_most[] = $ans;
    }
    $child_ul .= '</ul>';

        /*************** SHOW THUMB***************/
$isParentLinkQuery = "SELECT `id`,`title`,`alias`,`titleOfHead`,`description`,`tags` FROM `links` WHERE `status`='1' AND `parent_id` = ".$ans_select_post['c_pid']."  ORDER BY `position`";
$isParentLinkResult = query($isParentLinkQuery,__LINE__,__FILE__) or die(mysql_error());
if (mysql_num_rows($isParentLinkResult) > 0 ) {
  while($ans = mysql_fetch_assoc($isParentLinkResult)) {
    $isSearch[] = $ans;
  }
}
        /******************************************/
    $content_with_thumb = true;
  } else {
    die("no match found");
  }
  
  #print_r($ans_select_parent_most);
  // SELECT ALL PARENTS
  $left_ul_parent = '<div  ><ul class="list-unstyled list-group d">';
  $query_select_parent = "SELECT `id`,`title`,`titleOfHead`,`alias` FROM `links` WHERE `parent_id`='0' AND `status`='1' ORDER BY `position`";
  $result_select_parent = query($query_select_parent,__LINE__,__FILE__) or die("Unable to get parent posts<br>".mysql_query());
  $left_ul = '';
  while($ans = mysql_fetch_assoc($result_select_parent)){
#print_r($ans_select_parent_most[0]['parent_id']);

    if($ans_select_parent_most[0]['parent_id'] == $ans['id'] && isset($child_ul)){
      $left_ul_parent .= '<li ><a  class="list-group-item" href="'.BASE_URL.'/'.$ans['alias'].'"><i class="icon-chevron-sign-right"></i>'.$ans['title'].'</a>';
      $left_ul_parent .= $child_ul;
      $left_ul_parent .= '</li>';

      $breadcrum_parent_alias = $ans['alias'];
      $breadcrum_parent_title = $ans['title'];

    } else {
      $left_ul .= '<li><a  class="list-group-item" href="'.BASE_URL.'/'.$ans['alias'].'"><i class="icon-chevron-sign-right"></i>'.$ans['title'].'</a>';
      $left_ul .= '</li>';

    }

  }
  $left_ul = $left_ul_parent.$left_ul;
  $left_ul .= '</ul></div>';
  
