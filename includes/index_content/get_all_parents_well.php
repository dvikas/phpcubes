<?php
pr('', __LINE__ ,__FILE__);
?>
  <div>
          <ul style="position: relative;" class="grid effect-3" id="grid" >

<?php
ini_set('display_errors','On');
error_reporting(1);
// pr($allParents , __LINE__ , __FILE__);
$i=1;
foreach ($allParents as $key => $value) {
  $homeGridQuery = "SELECT `title`,`alias` FROM `links` WHERE `parent_id`='".$value['id']."' AND `status`='1' ORDER BY `position`";
  $homeGridResult =  mysql_query($homeGridQuery) or die(mysql_error());
?>

          <li class="shown" style="position: absolute;">
            <div class="thumbnail" style="border:0px;">
            <div >
          <h4><a href="<?=$value['alias']?>" class="label label-primary" style="text-decoration:none;line-height: 25px;text-align: left;"><span class="badge pull-left"  ><?=$i++?></span>&nbsp;&nbsp;<?=$value['title']?></a></h4>
          <p>
            <dl class="list-unstyled list-group">
            <?php
                while($ansHomeGrid= mysql_fetch_assoc($homeGridResult)){
                  //print_r($ansHomeGrid);exit;
            ?>
              <?='<dd ><a class="list-group-item" href="'.BASE_URL.'/'.$ansHomeGrid['alias'].'">'.$ansHomeGrid['title'].'</a></dd>'?>
            <?php }?>
            </dl>
            </p>
            </div>
            </div>
          </li>

<?php
}
?>
</ul>
  </div>
