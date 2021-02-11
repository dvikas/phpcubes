<?php

      $search_data = urldecode( trim(mysql_real_escape_string($isSearch)) );
      $where = '';
      $dataArray = explode(' ',$search_data);
      $dataArray = array_map('trim',$dataArray);
      foreach($dataArray as $val){
        $where .= " `alias` LIKE '%{$val}%' OR";
      }
      foreach($dataArray as $val){
        $where .= " `title` LIKE '%{$val}%' OR";
      }
      $where = rtrim($where,"OR");

$isChild = true;

//echo $query = "SELECT `alias`,`title`,`titleOfHead`,`description`,`keywords`,`tags` FROM `links` WHERE  $where AND `status`='1' AND `parent_id` != '0' AND `parent_id` NOT IN(SELECT `id` FROM `links` WHERE `parent_id`='0' AND `status`='1')";
          
       $query = "SELECT `alias`,`title`,`titleOfHead`,`description`,`keywords`,`tags`  FROM `links` WHERE ( $where ) AND `status`='1' AND `id` NOT IN(SELECT DISTINCT(`parent_id`) FROM `links`) AND `content` <> ''";
          
if($search_data !='') {
  $result = query($query,__LINE__ , __FILE__) or die(mysql_error());
  $searchResult = array();
  while($ans = mysql_fetch_assoc($result)) {
    $searchResult[] = $ans;
  }
  if(empty($searchResult)){
    $content = "sorry, <strong>$search_data</strong> didn't not match any result.";
  }
}
//print_r($searchResult);exit;
/////////////////////////////////////////////////////////////////
  $isSearch = $searchResult;

############################
  $left_ul_parent = '<div  ><ul class="list-unstyled list-group">';
  $query_select_parent = "SELECT `id`,`title`,`titleOfHead`,`description`,`content`,`alias` FROM `links` WHERE `parent_id`='0' AND `status`='1' ORDER BY `position`";
  $result_select_parent = query($query_select_parent,__LINE__,__FILE__) or die("Unable to get parent posts<br>".mysql_query());
  $left_ul = '';
  $i=0;
  while($ans = mysql_fetch_assoc($result_select_parent)){
#print_r($ans_select_parent_most[0]['parent_id']);
  $allParents[] = $ans;
    if($i++ == 0){
      $left_ul_parent .= '<li><a class="list-group-item active" href="'.BASE_URL.'/'.$ans['alias'].'"><i class="icon-chevron-sign-right"></i>'.$ans['title'].'</a>';
      $left_ul_parent .= @$child_ul;
      $left_ul_parent .= '</li>';

      $breadcrum_parent_alias = $ans['alias'];
      $breadcrum_parent_title = $ans['title'];

    } else {
      $left_ul .= '<li ><a class="list-group-item" href="'.BASE_URL.'/'.$ans['alias'].'"><i class="icon-chevron-sign-right"></i>'.$ans['title'].'</a>';
      $left_ul .= '</li>';

    }

  }
  $left_ul = $left_ul_parent.$left_ul;
  $left_ul .= '</ul></div>';
#############################

  $content_with_thumb = false;


