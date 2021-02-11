<?php

  require_once('db.php');

  if(!isset($_SESSION['totalQues']) || empty($_SESSION['totalQues'])){

    header('location:index.php');

  }

    //pr($_SESSION);

  $id = array_pop($_SESSION['id']);

  $cat_id = $_SESSION['cat_id'];

  $idStr = @$_COOKIE['cat_'.$cat_id];

  $idStrCookieArray = explode(',',$idStr);

  array_push($idStrCookieArray, $id);

  setcookie( "cat_".$cat_id, implode(',',$idStrCookieArray), strtotime( '+1 Year' ) );



  $quesNo = ++$_SESSION['quesNo'] ;

  $_SESSION['quesToAttempt']-- ;

  if($quesNo > $_SESSION['totalQues']){

    header('location:success.php');

  }



  $result = findAll("questions","*"," WHERE `id`='$id'");

  $ans = mysql_fetch_assoc($result);

  $question = $ans['ques'];

  $ans = array_map('nl2br',$ans);

  $answer = $ans['ans'];

  $desc = trim($ans['desc']);



  $ans = array_map('htmlentities',$ans);

  $ans = array_map('stripslashes',$ans);

  $op1 = $ans['op1'];

  $op2 = $ans['op2'];

  $op3 = $ans['op3'];

  $op4 = $ans['op4'];

  $op5 = $ans['op5'];



  $inputType=($ans['isMulti'] == 2) ? 'checkbox':'radio';



    $pattern = '/(.*)\[PHP\]([^\]]+)\[\/PHP\](.*)/';





    while(preg_match($pattern, $question, $matches)!=0){



        if(isset($matches[2]) && isset($matches[0])){

            $text1 = "[PHP]".$matches[2]."[/PHP]";

            $str = @file_get_contents($matches[2]);

            if ($str) {

              $text2 = '<br><div class="dp-highlighter">'.highlight_string($str, true).'</div>';

            } else {

              $text2 = '<br><div class="dp-highlighter">'.highlight_string($matches[2], true).'</div>';

            }

            $question = str_replace($text1, $text2 , $question);

        }



    }// end while



  require_once('header.php');



?>



          <input type="hidden" name="ans" id="ansId" value="<?=$answer?>">



<!---------START ---------->

      <div class="jumbotron">

      <div class="subnav">

      <h3>Question <?=$quesNo?><span style="float:right;"><a href="">Next</a></span> </h3>



      </div>

        <p class="lead"><?=$question?></p>

        <ul  style="font-weight:bold;">

<?php if($op1!='') {?>

          <li><div class="controls"><label class="<?=$inputType?>"><input name="option" id="op1" type="<?=$inputType?>"><?=$op1?></label></div></li>

<?php }?>



<?php if($op2!='') {?>

          <li><div class="controls"><label class="<?=$inputType?>"><input name="option" id="op2" type="<?=$inputType?>"><?=$op2?></label></div></li>

<?php }?>



<?php if($op3!='') {?>

          <li><div class="controls"><label class="<?=$inputType?>"><input name="option" id="op3" type="<?=$inputType?>"><?=$op3?></label></div></li>

<?php }?>



<?php if($op4!='') {?>

          <li><div class="controls"><label class="<?=$inputType?>"><input name="option" id="op4" type="<?=$inputType?>"><?=$op4?></label></div></li>

<?php }?>



<?php if($op5!='') {?>

          <li><div class="controls"><label class="<?=$inputType?>"><input name="option" id="op5" type="<?=$inputType?>"><?=$op5?></label></div></li>

<?php }?>



        </ul>

<?php if(!empty($desc)) {?>

        <div class="alert alert-success" style="display:none;">

          <button type="button" class="close" data-dismiss="alert">&times;</button>

          <?=$desc?>

        </div>

<?php }?>

        <a class="btn btn-success" id="checkMe" href="javascript:void(0);">Check</a>
        <a class="btn btn-primary"  style="float:right" href="">Next</a>

      </div>



      <hr style="float:left">

    <!---------END ---------->



<?php

  require_once('header.php');

?>

    </div> <!-- /container -->

    <script src="js/bootstrap.min.js"></script>

    <script src="js/application.js"></script>



  </body>

</html>

