<?php
  require_once('db.php');
  if(!isset($_SESSION['totalQues']) || empty($_SESSION['totalQues'])){
    header('location:index.php');
  }
    //pr($_COOKIE);
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

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Test my skills in php</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="bootstrap.min.css" rel="stylesheet">
    <link href="SyntaxHighlighter.css" rel="stylesheet">
    <script type="text/javascript" src="jquery-1.7.2.min.js"></script>
    <script type="text/javascript">
 $(document).ready(function(){$("#checkMe").click(function(){var b=$("#ansId").val();$('input[type="radio"]').each(function(){if($(this).attr("id")==("op"+b)){$(this).closest(".controls").removeClass("muted");$(this).closest(".controls").removeClass("text-error");$(this).closest(".controls").addClass("text-success");$(this).closest("li").addClass("text-success");}else{if($(this).is(":checked")==true&&$(this).attr("id")!=("op"+b)){$(this).closest(".controls").removeClass("text-success");$(this).closest(".controls").removeClass("muted");$(this).closest(".controls").addClass("text-error")}else{$(this).closest(".controls").removeClass("text-success");$(this).closest(".controls").removeClass("text-error");$(this).closest(".controls").addClass("muted")}}});var a=b.split(",");$('input[type="checkbox"]').each(function(){var c=$(this).attr("id").replace("op","");if($.inArray(c,a)!=-1){$(this).closest(".controls").removeClass("muted");$(this).closest(".controls").removeClass("text-error");$(this).closest(".controls").addClass("text-success");$(this).closest("li").addClass("text-success")}else{if($(this).is(":checked")==true&&$.inArray(c,a)==-1){$(this).closest(".controls").removeClass("text-success");$(this).closest(".controls").removeClass("muted");$(this).closest(".controls").addClass("text-error")}else{$(this).closest(".controls").removeClass("text-success");$(this).closest(".controls").removeClass("text-error");$(this).closest(".controls").addClass("muted")}}});$(".alert").show()})});
    </script>
    <style type="text/css">
body{padding-top:20px;padding-bottom:40px}.container-narrow{margin:0 auto;max-width:700px}.container-narrow>hr{margin:30px 0}.jumbotron{margin:60px 0;text-align:justify}.jumbotron h1{font-size:72px;line-height:1}.jumbotron .btn{font-size:21px;padding:14px 24px}.marketing{margin:60px 0}.marketing p+h4{margin-top:28px}div.subnav{-moz-border-bottom-colors:none;-moz-border-image:none;-moz-border-left-colors:none;-moz-border-right-colors:none;-moz-border-top-colors:none;background-color:#fff;background-image:none;border-color:#eee -moz-use-text-color;border-radius:0;border-style:solid none;border-width:2px medium;box-shadow:none;height:54px}.subnav{background-color:#eee;background-image:-moz-linear-gradient(center top,#f5f5f5 0,#eee 100%);background-repeat:repeat-x;border:1px solid #e5e5e5;border-radius:4px 4px 4px 4px;height:36px;margin-bottom:60px;width:700px}div.subnav.subnav-fixed{top:0;position:fixed}.controls{font:italic bold 12px/30px Georgia,serif}ul,ol{list-style-type:upper-alpha;margin:0 0 10px 25px;padding:0;font-size: 20px;}code{font-size: 15px;}
body.jumbotron {
    color: #333333;
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 27px;
    line-height: 20px;
}
    </style>


  </head>


  <body>
    <input type="hidden" name="ans" id="ansId" value="<?=$answer?>">
    <div class="container-narrow">

      <div class="masthead">
        <ul class="nav nav-pills pull-right">
          <li class="active"><a href="http://testphpskills.com">Home</a></li>
          <!---<li><a href="#">About</a></li>
          <li><a href="#">Contact</a></li>-->
        </ul>
        <h3 class="muted">Test PHP Skills</h3>
      </div>

      <hr>
<!---------START ---------->
      <div class="jumbotron">
      <div class="subnav">
      <h3>Question <?=$quesNo?><span style="float:right;"><a href="">Next</a></span> </h3>

      </div>
        <p class="lead"><?=$question?></p>
        <ul  style="font-weight:bold;">
<?php if(!empty($op1)) {?>
          <li><div class="controls"><label class="<?=$inputType?>"><input name="option" id="op1" type="<?=$inputType?>"><?=$op1?></label></div></li>
<?php }?>

<?php if(!empty($op2)) {?>
          <li><div class="controls"><label class="<?=$inputType?>"><input name="option" id="op2" type="<?=$inputType?>"><?=$op2?></label></div></li>
<?php }?>

<?php if(!empty($op3)) {?>
          <li><div class="controls"><label class="<?=$inputType?>"><input name="option" id="op3" type="<?=$inputType?>"><?=$op3?></label></div></li>
<?php }?>

<?php if(!empty($op4)) {?>
          <li><div class="controls"><label class="<?=$inputType?>"><input name="option" id="op4" type="<?=$inputType?>"><?=$op4?></label></div></li>
<?php }?>

<?php if(!empty($op5)) {?>
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
      </div>

      <hr>
    <!---------END ---------->

      <div class="footer">
        <p> &copy; 2011 - <?=date('Y')?> by <a href="http://testphpskills.com">testphpskills.com</a>. All rights reserved.</p>
      </div>

    </div> <!-- /container -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/application.js"></script>

  </body>
</html>
