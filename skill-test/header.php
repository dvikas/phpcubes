<?php
//if( $_SERVER['REMOTE_ADDR'] != '115.112.129.194' ) {
    if( 1 ) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>TEST PHP SKILLS: Online PHP Test | PHP Certification Practice | PHP Interview Questions | PHP Test Series </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Meta Tage Work start from here -->
<META NAME="Description" CONTENT="Test my PHP skills online with answers on same page.Show multiple choice with instant answer on same page.PHP test series for interview and certification with description of each question.">

<META NAME="Classification" CONTENT="PHP question and answer,PHP quiz,PHP exam,PHP assessment,PHP skills MySQL quiz,mySQL exam,mySQL assessment,MySQL skills">

<META NAME="Keywords" CONTENT="PHP question,PHP interview,quiz,PHP quiz,PHP exam,PHP skills MySQL quiz,mySQL exam,mySQL assessment,MySQL skills">

<!-- Meta Tage Work ends here -->

    <!-- Le styles -->
    <link href="bootstrap.min.css" rel="stylesheet">
    <link href="SyntaxHighlighter.css" rel="stylesheet">
    <script type="text/javascript" src="jquery-1.7.2.min.js"></script>
    <?php

if(strpos($_SERVER['SCRIPT_FILENAME'],'questions.php') !== false || strpos($_SERVER['SCRIPT_FILENAME'],'show.php') !== false)
{
?>
    <script type="text/javascript">
 $(document).ready(function(){$("#checkMe").click(function(){var b=$("#ansId").val();$('input[type="radio"]').each(function(){if($(this).attr("id")==("op"+b)){$(this).closest(".controls").removeClass("muted");$(this).closest(".controls").removeClass("text-error");$(this).closest(".controls").addClass("text-success");$(this).closest("li").addClass("text-success");}else{if($(this).is(":checked")==true&&$(this).attr("id")!=("op"+b)){$(this).closest(".controls").removeClass("text-success");$(this).closest(".controls").removeClass("muted");$(this).closest(".controls").addClass("text-error")}else{$(this).closest(".controls").removeClass("text-success");$(this).closest(".controls").removeClass("text-error");$(this).closest(".controls").addClass("muted")}}});var a=b.split(",");$('input[type="checkbox"]').each(function(){var c=$(this).attr("id").replace("op","");if($.inArray(c,a)!=-1){$(this).closest(".controls").removeClass("muted");$(this).closest(".controls").removeClass("text-error");$(this).closest(".controls").addClass("text-success");$(this).closest("li").addClass("text-success")}else{if($(this).is(":checked")==true&&$.inArray(c,a)==-1){$(this).closest(".controls").removeClass("text-success");$(this).closest(".controls").removeClass("muted");$(this).closest(".controls").addClass("text-error")}else{$(this).closest(".controls").removeClass("text-success");$(this).closest(".controls").removeClass("text-error");$(this).closest(".controls").addClass("muted")}}});$(".alert").show()})});
    </script>
    <style type="text/css">
body{padding-top:20px;padding-bottom:40px}.container-narrow{margin:0 auto;max-width:700px}.container-narrow>hr{margin:30px 0}.jumbotron{margin:60px 0;text-align:justify}.jumbotron h1{font-size:72px;line-height:1}.jumbotron .btn{font-size:21px;padding:14px 24px}.marketing{margin:60px 0}.marketing p+h4{margin-top:28px}div.subnav{-moz-border-bottom-colors:none;-moz-border-image:none;-moz-border-left-colors:none;-moz-border-right-colors:none;-moz-border-top-colors:none;background-color:#fff;background-image:none;border-color:#eee -moz-use-text-color;border-radius:0;border-style:solid none;border-width:2px medium;box-shadow:none;height:54px}.subnav{background-color:#eee;background-image:-moz-linear-gradient(center top,#f5f5f5 0,#eee 100%);background-repeat:repeat-x;border:1px solid #e5e5e5;border-radius:4px 4px 4px 4px;height:36px;margin-bottom:60px;width:700px}div.subnav.subnav-fixed{top:0;/*position:fixed*/}.controls{font:italic bold 12px/30px Georgia,serif}ul,ol{list-style-type:upper-alpha;margin:0 0 10px 25px;padding:0;font-size: 20px;}code{font-size: 15px;}
body.jumbotron {
    color: #333333;
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 27px;
    line-height: 20px;
}
 .text-success {border: 1px dotted lightgray;color: green;}
 input[type="checkbox"],input[type="radio"] {height: 18px;}
    </style>

<?php
} else {
?>

<style type="text/css">
body{padding-top:20px;padding-bottom:40px}.container-narrow{margin:0 auto;max-width:700px}.container-narrow>hr{margin:30px 0}.jumbotron{margin:60px 0;text-align:justify;height:300px;float:left;}.jumbotron h1{font-size:72px;line-height:1}.jumbotron .btn{font-size:21px;padding:14px 24px}.marketing{margin:60px 0}.marketing p+h4{margin-top:28px}div.subnav{-moz-border-bottom-colors:none;-moz-border-image:none;-moz-border-left-colors:none;-moz-border-right-colors:none;-moz-border-top-colors:none;background-color:#fff;background-image:none;border-color:#eee -moz-use-text-color;border-radius:0;border-style:solid none;border-width:2px medium;box-shadow:none;height:54px}.subnav{background-color:#eee;background-image:-moz-linear-gradient(center top,#f5f5f5 0,#eee 100%);background-repeat:repeat-x;border:1px solid #e5e5e5;border-radius:4px 4px 4px 4px;height:36px;margin-bottom:60px;width:700px}div.subnav.subnav-fixed{top:0;position:fixed}ul,ol{list-style-type:upper-alpha;margin:0 0 10px 25px;padding:0}


select {
    font-size: 25px;
    height: 40px;
    width: 680px;
}

img {
    border: 0 none;
    float: left;
    max-width: 100%;
    vertical-align: middle;
    margin-top: -20px;
}
hr{
  float:left;
}

.footer{
  float:left;
}
    </style>

<?php }?>
<link  href="/favicon.ico" rel="icon" type="image/x-icon" />

  </head>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-49057019-1', 'testphpskills.com');
  ga('send', 'pageview');

</script>

  <body>

    <div class="container-narrow">

      <div class="masthead">
        <div >
          <ul class="nav nav-pills pull-right">
            <li class="active"><a href="">Home</a></li>
            <!---<li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>-->
          </ul>
        </div>

        <div style="float:left">
          <img src="test_php_skills.jpg" >
        </div>

        <div style="float:left">
          <h1 class="muted" style="display:none">TEST PHP SKILLS</h1>
          <img src="test-php-skills.png" title="TEST PHP SKILLS" alt="TEST PHP SKILLS" >
        </div>

        <div style="float:left">
          <hr>
        </div>
      </div>
<!---------START ---------->
<?php
}
