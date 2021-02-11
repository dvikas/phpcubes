<?php
pr('CONTENT WITH ONLY ONE PARENT', __LINE__ ,__FILE__);
?>
  <!-- the actual blog post: title/author/date/content -->
  <h1><?=($titleOfLink)?>
      <?php
    if(isset($_SESSION['id'])) {
		echo '<a href="/rajan/pages/content.php?id='.$ans_select_post['c_id'].'"><i class="fa fa-pencil-square-o"></i></a>';}
    ?>
  <!-- <span class="glyphicon glyphicon-flag"></span> --></h1>
   <form method="post" class="form-inline" action="">
    <div class="form-group">
		<?php if(!empty($saved_tags)) {?>
                <span class="glyphicon glyphicon-tags"></span>
        <?php }?>
    </div>
    <div class="form-group">
                <input name="tags" style="display:none" type="text" id="singleFieldTags2" value="<?=$saved_tags?>">

    </div>
    <?php
    if(isset($_SESSION['id'])) {
    ?>
                  <input type="submit" class="btn" value="Add">
    <?php
    }//end if
    ?>
     </form>



       <ul class="breadcrumb">
      <li><a href="/">Home</a> </li>

      <?php
      if($breadcrum_parent_alias != $ans_select_post['p_alias']) {
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




  <hr>
<!--
  <img src="http://placehold.it/900x100" class="img-responsive">
  <hr>
-->
<?php





/////////////////// HIghlight PHP ///////////////////////////////////////////////
    $pattern = '/(.*)\[PHP\]([^\]]+)\[\/PHP\](.*)/';
    $i = 1;
    while(preg_match($pattern, $content, $matches)!=0){

        if(isset($matches[2]) && isset($matches[0])){
            $text1 = "[PHP]".$matches[2]."[/PHP]";
            $phplinks[$i] = $matches[2];
            $text2 = "[DWS_EXPLODEPHP]";
            $content = str_replace($text1, $text2 , $content);
        }
        $i++;
    }// end while

    $allContent = explode("[DWS_EXPLODEPHP]",$content);
    echo $allContent[0];

    for($i=1 ; $i<count($allContent) ;$i++){

        $str = @file_get_contents($phplinks[$i]);
      //  $str = ($phplinks[$i]);

        if ($str) {unset($str);
            echo "<div class='dp-highlighter'>";
            //highlight_string($str);

highlight_num($phplinks[$i]);
            echo "</div>";
        } else {
//            echo "<div class='dp-highlighter'>";
            highlight_string($phplinks[$i]);
//            echo "</div>";
        }

        echo $allContent[$i];
    }
