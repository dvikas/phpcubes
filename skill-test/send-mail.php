<?php
  if(!isset($_GET['pass']) || $_GET['pass']!='rajan'){
    exit();
  }
  require_once('db.php');
    date_default_timezone_set('Asia/Kolkata');
    ini_set('display_errors','On');
    error_reporting(1);
  //require_once('header.php');

  $result = findAll("questions","*","","ORDER BY `mail_sent` DESC , RAND( ) ",'LIMIT 10');
  $quesNo = 1;
$out = '<html><body style="font-size: 20px;">';
  while($ques = mysql_fetch_assoc($result)){
  //  pr($ques);
    $ans = mysql_fetch_assoc($result);
    $question = $ans['ques'];
    $ans = array_map('nl2br',$ans);
    $answer = $ans['ans'];
    $desc = trim($ans['desc']);
    $ans = array_map('htmlentities',$ans);
    $ans = array_map('stripslashes',$ans);
    $id = encrypt($ans['id']);
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

$out .= '<div class="jumbotron" style="margin:0px;height:auto;">';

$out .='<p class="lead">'.sprintf("%c)",64+$quesNo++).'&nbsp;&nbsp;'.$question.'</p>
    <ul  style="font-weight:normal;list-style: none outside none;
    padding: 0;">';

if($op1!='') {
$out .='<li><div class="controls"><label class="'.$inputType.'"><input name="option" id="op1" type="'.$inputType.'">&nbsp;'.$op1.'</label></div></li>';
}

if($op2!='') {
$out .='<li><div class="controls"><label class="'.$inputType.'"><input name="option" id="op2" type="'.$inputType.'">&nbsp;'.$op2.'</label></div></li>';
}

if($op3!='') {
$out .='<li><div class="controls"><label class="'.$inputType.'"><input name="option" id="op3" type="'.$inputType.'">&nbsp;'.$op3.'</label></div></li>';
}

if($op4!='') {
$out .='<li><div class="controls"><label class="'.$inputType.'"><input name="option" id="op4" type="'.$inputType.'">'.$op4.'</label></div></li>';
}

if($op5!='') {
$out .='<li><div class="controls"><label class="'.$inputType.'"><input name="option" id="op5" type="'.$inputType.'">&nbsp;'.$op5.'</label></div></li>';
}

$out .='</ul>';

$out .='<a class="btn btn-success" id="checkMe" href="http://testphpskills.com/display.php?id='.$id.'">Check</a>
  </div>
  <hr>';

}
$out .='</div>';
$out .= '</body></html>';
echo $out;
$headers = "From:testphpskills.com <do.no.reply@testphpskills.com> \r\n";
$headers .= "Reply-To: testphpskills.com <do.no.reply@testphpskills.com> \r\n";
//$headers .= "CC: susan@example.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$subject = 'PHP Questions ('.date('d-M-Y').')';
mail('xamppdev@googlegroups.com', $subject, $out, $headers);
