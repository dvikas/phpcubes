<?php

$title =(isset($title)) ? ($title) : 'PHPCUBES: LEARN PHP WITH SAMPLE CODES | BEGINNERS PHP TUTORIALS | SAMPLE PHP APPS | LEARN LAMP | PHP MYSQL APACHE LINUX ';
$description =(isset($description)) ? ($description) : 'PHP is the most popular server-side open source language,PHP is easy to learn and contain OOPS concept with Design Pattern';
$keywords = (isset($keywords)) ? ($keywords) : 'php,mysql, jquery, ajax,training,tutorial,basics,online test,learn php basics tutorial jquery mysql javascript linux';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Meta Tage Work start from here -->
    <meta name="Description" content="<?php echo $description;?>">
    <meta name="Classification" content="<?php echo $keywords;?> ">
    <meta name="Keywords" content="<?php echo $keywords;?>">


    <script type="text/javascript">var BASE_URL = '<?=BASE_URL?>'</script>


    <title><?php echo $title;?></title>

    <link rel="shortcut icon" href="<?=BASE_URL?>/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?=BASE_URL?>/favicon.ico" type="image/x-icon">

    <!-- Bootstrap core CSS -->
<!--
    <link href="<?=BASE_URL?>/css/bootstrap.css" rel="stylesheet">
-->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
<link rel="stylesheet" href="<?=BASE_URL?>/css/font-awesome.min.css">
    <!-- Add custom CSS here -->
    <link href="<?=BASE_URL?>/css/shop-homepage.css" rel="stylesheet">
    <link href="<?php echo BASE_URL?>/Styles/SyntaxHighlighter.css" rel="stylesheet">
    <link href="<?php echo BASE_URL?>/css/site.css" rel="stylesheet">
<!--
    <link href="<?php echo BASE_URL?>/fluidfiles/bootstrap-responsive.css" rel="stylesheet">
-->
    <link href="<?php echo BASE_URL?>/highlight/hilight.css" rel="stylesheet">

<!--
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL?>/css/fluid-default.css">
-->
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL?>/css/fluid-component.css">

  </head>

  <body>


<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-49010473-1', 'phpcubes.com');
  ga('send', 'pageview');

</script>


<h1 style="display:none">php sample codes and tutorial with mysql jquery and ubuntu</h1>

    <div class="navbar navbar-default navbar-static-top" role="navigation">
      <div class="container">
        <div class="navbar-header">

          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

          <a class="navbar-brand" style="color: #2a6496;" href="<?=BASE_URL?>"><i class="fa fa-cubes"></i> PHP Cubes </a>
        </div>
        <div class="navbar-collapse collapse">
<?php

$isHome = '';
$isDiff = isset($search_data) && $search_data=='differences' ?'class="active"':'';
$isAbout = strpos($_SERVER['REQUEST_URI'],'vikas-dwivedi') ?'class="active"':'';
$isContact = strpos($_SERVER['REQUEST_URI'],'contact/') ?'class="active"':'';
if(!$isDiff && !$isAbout && !$isContact){
  $isHome = 'class="active"';
}
?>
          <ul class="nav navbar-nav">
            <li <?=$isHome?> ><a href="/">Home</a></li>
            <li <?=$isDiff?> ><a href="<?php echo BASE_URL?>/tag/differences">A Vs B</a></li>
            <li <?=$isContact?>><a href="<?php echo BASE_URL?>/contact">Contact</a></li>
            <li <?=$isAbout?>><a href="<?php echo BASE_URL?>/vikas-dwivedi">About Us</a></li>
          </ul>

          <form role="search" class="navbar-form navbar-right">
            <div class="form-group">
                    <input class="typeahead form-control" title="3 characters minimum" required type="text" placeholder="Search on phpcubes" required data-provide="typeahead" autocomplete="off">
            </div>
            <button class="btn btn-default searchIt" data-toggle="button" type="button">
              <span class="glyphicon glyphicon-search"></span>&nbsp;Open Link
            </button>
          </form>

        </div><!--/.nav-collapse -->
      </div>




    </div>
