<?php
  require_once('left.php');
pr('LEFT.PHP',__LINE__ , __FILE__ );

  if(isset($isChild) && $isChild == true){
    $content = stripslashes($ans_select_post['content']);
    $keywords = stripslashes($ans_select_post['keywords']);
    $description = stripslashes($ans_select_post['description']);
    $title = stripslashes($ans_select_post['titleOfHead']);
        $titleOfLink = stripslashes($ans_select_post['title']);
    $requestParentId = $ans_select_post['c_pid'];

    $content = (utf8_encode($content));

//////////////////////////////   DOWNLOAD ZIP  ////////////////////////////////
    $pattern = '/(.*)\[ZIP\]([^\]]+)\[\/ZIP\](.*)/';

    while(preg_match($pattern, $content, $matches)!=0){

        if(isset($matches[2]) && isset($matches[0])){
          $isdownload = true;

          $filePath = ($matches[2]);

          $text1 = "[ZIP]".$filePath."[/ZIP]";
          $text2 = '<div class="zip-link" style="float:left;margin-top:10px;margin-left:20px;"><a target="_blank" href="'.BASE_URL.'/download.php?file='.encrypt($filePath).'" class="btn btn-info btn"><i class="icon-download-alt icon-white"></i>download zip</a></div><br><hr>';
          $content = str_replace($text1, $text2 , $content);
        }
    }// end while
//////////////////////////////   HIGHLIGHT JS/HTML ////////////////////////////////

//////////////////////////////   GREEN DEMO  ////////////////////////////////
    $pattern = '/(.*)\[DEMO\]([^\]]+)\[\/DEMO\](.*)/';
    $i = 1;
    while(preg_match($pattern, $content, $matches)!=0){

        if(isset($matches[2]) && isset($matches[0])){
          $filePath = $matches[2];
          $text1 = "[DEMO]".$filePath."[/DEMO]";
          $text2 = '<div class="demo-link" style="float:left;margin-top:10px;"><a target="_blank" href="http://demo.phpcubes.com/'.$filePath.'" class="btn btn-success btn"><i class="icon-play-circle icon-white"></i>try demo</a></div>';
if(!isset($isdownload)) {
          $text2 .= '<div class="demo-link" style="float:left;margin-top:10px;margin-left:20px;"><a target="_blank" href="'.BASE_URL.'/download.php?file='.encrypt($filePath).'" class="btn btn-info btn"><i class="icon-download icon-white"></i>download source</a></div><br><hr>';
}
          $content = str_replace($text1, $text2 , $content);
        }
        $i++;
    }// end while
//////////////////////////////   HIGHLIGHT JS/HTML ////////////////////////////////
    $pattern = '/(.*)\[CODE\]([^\]]+)\[\/CODE\](.*)/';
    $i = 1;
    while(preg_match($pattern, $content, $matches)!=0){

        if(isset($matches[2]) && isset($matches[0])){
          $text1 = "[CODE]".$matches[2]."[/CODE]";
          if(is_file(trim($matches[2]))) {
            $text2 = file_get_contents($matches[2]);
          } else {
            $text2 = $matches[2];
          }
          $highlighter =& Text_Highlighter::factory('javascript');
          $text2 = $highlighter->highlight($text2);
          $content = str_replace($text1, $text2 , $content);
        }
        $i++;
    }// end while
//////////////////////////////   HIGHLIGHT SQL ////////////////////////////////
    $pattern = '/(.*)\[SQL\]([^\]]+)\[\/SQL\](.*)/';
    $i = 1;
    while(preg_match($pattern, $content, $matches)!=0){

        if(isset($matches[2]) && isset($matches[0])){
          $text1 = "[SQL]".$matches[2]."[/SQL]";
          if(is_file(trim($matches[2]))) {
            $text2 = file_get_contents($matches[2]);
          } else {
            $text2 = $matches[2];
          }
          $highlighter =& Text_Highlighter::factory('mysql');
          $text2 = $highlighter->highlight($text2);
          $content = str_replace($text1, $text2 , $content);
        }
        $i++;
    }// end while

   // $content = str_replace('[Q]', '<span class="glyphicon glyphicon-question-sign" style="color:#FA8072;font-size:25px;"></span>&nbsp;' , $content);
   // $content = str_replace('[A]', '<span class="glyphicon glyphicon-ok-sign" style="color:#008000;font-size:25px;"></span>&nbsp;' , $content);

  }//end if()
