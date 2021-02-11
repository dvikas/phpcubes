<?php
//ini_set('display_errors','on');
//error_reporting(E_ALL);

  require_once('includes/logic.php');
  require_once('includes/header.php');
  #if(isset($isChild) && $isChild == true){
  require_once('includes/tags.php');
  #}
?>


    <div class="container">

      <div class="row">
        <!--------------------------->
        <div class="slide">
        <?php require_once('includes/slide.php');?>
        </div><!--class="slide"--->
        <!--------------------------->
        <div class="col-xs-12 col-sm-9">
<!--
    <p class="pull-right visible-xs">
      <button data-toggle="offcanvas" class="btn btn-primary btn-xs" type="button">Toggle nav</button>
    </p>
-->

<!------------------------------------------------------------------------------------------>
<?php


    pr('IS ONLY ONE PARENT ->'.$content_with_thumb,__LINE__,__FILE__);


  if(($content_with_thumb==true && isset($isSearch)) || isset($onlyOneParent)) {
    pr('ONLY ONE PARENT',__LINE__,__FILE__);
    require_once('includes/index_content/content_with_only_one_parent.php');
  }//end if not isSearch
  if(($content_with_thumb==true && isset($isSearch)) || ($content_with_thumb==false && isset($isSearch))) {  //pr($isSearch);
    pr('GET CHILDS ',__LINE__,__FILE__);
    require_once('includes/index_content/get_childs.php');
  }
  if(isset($isChild) && $isChild == false){
    pr('GET ALL PARENTS WELL ',__LINE__,__FILE__);
    require_once('includes/index_content/get_all_parents_well.php');
  }

?>
<!-------------------------------------------------------------------------------------------->
        </div><!---class="col-md-9"--->

        <!-------RIGHT START----------->
        <div role="navigation" id="sidebar" class="col-xs-12 col-sm-3 sidebar-offcanvas">
          <?php require_once('includes/right.php');?>
        </div>
        <!-------RIGHT END----------->

      </div><!--class="row"-->

    </div><!-- /.container -->
<?php

require_once('includes/footer.php');
?>
