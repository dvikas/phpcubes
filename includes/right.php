<?php
  $hits_query = "SELECT * FROM `links` WHERE `parent_id` != '0' AND `id`!='2' AND `status`='1' ORDER BY hits DESC LIMIT 0,15";
  $hits_result = query($hits_query,__LINE__,__FILE__) or die(mysql_error());

  $suggest_tagId = isset($ans_select_post['tags'])?$ans_select_post['tags']:'';
  $suggestedTagsFlag = false;
  if($suggest_tagId !='') {
    $suggest_tagId_array = explode(',',$suggest_tagId);
    $tagWhere = '(';
    foreach($suggest_tagId_array as $tagId){
      $tagWhere .="find_in_set( $tagId, tags ) OR ";
    }
    $tagWhere = rtrim($tagWhere,'OR ');
    $tagWhere .=")";

    $suggestedTagsFlag = true;
    $suggestedTagsquery = "SELECT `alias`,`title`,`titleOfHead`,`description`,`keywords`,`tags` FROM `links`
            WHERE $tagWhere  AND `status`='1' AND `parent_id` != '0' AND `id` <> $ans_select_post[c_id]";
    $suggestedTagsresult = query($suggestedTagsquery);

  }
?>
      <!-- Place this tag where you want the +1 button to render.
<div class="g-plusone" data-annotation="inline" data-width="300"></div>-->

<!-- Place this tag after the last +1 button tag.
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>-->

<!---------- SUGGESTED TAGS -------------->
<?php

if(   $suggestedTagsFlag == true && mysql_num_rows($suggestedTagsresult) > 0 ) {
?>
  <div class="well">
        <div class="col-lg-13">
                  <h4>Suggested Links</h4>
          <ul class="list-unstyled list-group">
<?php
while($ans = mysql_fetch_assoc($suggestedTagsresult)) {
?>
            <li><a class="list-group-item" href="<?php echo BASE_URL.'/'.$ans['alias'];?>"><?=stripslashes($ans['title'])?></a></li>
<?php
}//end while
?>
          </ul>
        </div>
  </div><!-- /well -->
<?php
}//end if for suggested tags
?>
<!---------- POPULAR LINkS --------------->
  <div class="well">
        <div class="col-lg-13">
                  <h4>Popular Links</h4>
          <ul class="list-unstyled list-group">
<?php
while($ans = mysql_fetch_assoc($hits_result)) {
?>
            <li><a class="list-group-item" href="<?php echo BASE_URL.'/'.$ans['alias'];?>"><?=stripslashes($ans['title'])?></a></li>
<?php
}//end while
?>
          </ul>
        </div>
  </div><!-- /well -->

