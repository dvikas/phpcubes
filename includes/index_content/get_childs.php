<?php
pr('GET CHILDS', __LINE__ ,__FILE__);
?>
<?php

//if(!isset($content_with_thumb) || $content_with_thumb==false)
if(true)

{?>
  <div >

  <p>
       <ul class="breadcrumb">
      <li><a href="/">Home</a> </li>

      <?php
      if(isset($ans_select_post['p_alias']) && $breadcrum_parent_alias != $ans_select_post['p_alias']) {
        //if(1){
      ?>

         <li><a href="/<?=$breadcrum_parent_alias?>"><?=$breadcrum_parent_title?></a> </li>

      <?php
      }
      ?>

      <?php
      if(isset($ans_select_post['p_alias']) && !empty($ans_select_post['p_alias'])) {
      ?>
      <li><a href="<?=BASE_URL.'/'.$ans_select_post['p_alias']?>"><?=$ans_select_post['p_title']?></a></li>
      <?php }?>

     </ul>

  </p>


  <hr>
  </div>
<?php
}// end check if $content_with_thumb i.e No Need of footer breadcrum when there is only one parent
?>
<!------------------------------------------------>
  <div >
<?php
// pr($allParents , __LINE__ , __FILE__);

    # If search not found , check search_logic.php
    if(isset($searchAndTag) && $searchAndTag == true) {
      if(isset($content) ) {
        echo '<div class="alert alert-danger  bg-danger">'.$content.'</div>';
      } else { # search success
        echo "<div class=\"alert alert-info bg-primary\">Your search <strong>$search_data</strong> match <span class=\"badge\">".count($searchResult)."</span> records.</div>";
      }
    }

    $thumbClass = '';
    $currentThumbIsAlias = false;
    $isOkOrViewed = '';
    foreach ($isSearch as $key => $value) {

# for search and tag it will not set
if(isset($ans_select_post['c_id'])) {
  if($ans_select_post['c_id'] == $value['id'] ){
    $thumbClass = 'alert alert-danger';
    $currentThumbIsAlias = true;
    $isOkOrViewed = '<span class="pull-right glyphicon glyphicon-eye-open"></span>';

  } else if($currentThumbIsAlias == true){
    $thumbClass = 'alert alert-warning';
    $isOkOrViewed = '<span class="pull-right glyphicon glyphicon-search"></span>';

  } else if($content_with_thumb){
    //var_dump($onlyOneParent);exit;
    $thumbClass = 'alert alert-success';
    $isOkOrViewed = '<span class="pull-right glyphicon glyphicon-ok"></span>';
  }

}
    ?>
        <div >
          <div class="thumbnail <?=$thumbClass?>">
            <!-- <img src="http://placehold.it/350x100/AAF7CB/0000FF&text=<?=(strip_tags($value['title']))?>" alt="<?=$value['title']?>"> -->
            <div class="caption">
<?php

$tagBtn = '';
$tagValueArrayForList = explode(',',$value['tags']);
$tagValueArrayForList = array_filter($tagValueArrayForList);

if(!empty($tagValueArrayForList)) {
  $tagBtn = '&nbsp;<span class="glyphicon glyphicon-tags"></span>&nbsp;';

  foreach($tagValueArrayForList as $tagId){
    $tagTxt = $tags[$tagId];
    $tagBtn .='&nbsp;<a href="'.BASE_URL.'/tag/'.$tagTxt.'"><button type="button" class="btn btn-info btn-xs tag-txt-list">'.$tagTxt.'</button></a>';

  }
}
?>
              <h4><a href="<?=BASE_URL.'/'.$value['alias']?>"><?=$value['title']?></a>
                <span ><?=$tagBtn?></span>
                <?=$isOkOrViewed?>
              </h4>
              <p><?=$value['description']?></p>
            </div>

          </div>
        </div>
    <?php
    }

?>
  </div>
