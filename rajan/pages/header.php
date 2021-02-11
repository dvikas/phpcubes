<?php
require_once("../../includes/connection.php");
if(!isset($_SESSION['id'])){
    header("location: ".BASE_URL);
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>PHP Cubes Admin</title>
    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
<header role="banner" class="navbar navbar-default navbar-static-top">
            <div class="navbar-header">
                <a href="#" class="navbar-brand"><i class="fa fa-cubes"></i> Admin</a>
            </div>
            <!-- /.navbar-header -->
<nav class="collapse navbar-collapse bs-navbar-collapse">
            <ul class="nav navbar-nav navbar-top-links navbar-right">

                <!-- /.dropdown -->
<?php 

$filename = pathinfo($_SERVER['REQUEST_URI'])['filename'];
$tags = $file_manager = $menu = $all_links  = $edit_links = "";
switch($filename){
    case 'index':$all_links = "active";break;    
    case 'menu':$menu = "active"; break;    
    case 'edit-links':$edit_links = "active"; break;    
    case 'file-manager':$file_manager = "active"; break;    
    case 'tags':$tags = "active"; break;    
}
?>
                <!-- /.dropdown -->
                <li class="<?=$file_manager ?>"><a  href="file-manager.php"><i class="icon-home"></i>
                    <span class="hidden-tablet"> <i class="fa fa-file-code-o"></i> Manage Files</span></a></li>
                <li class="<?=$menu ?>"><a href="menu.php"><i class="icon-home"></i>
                    <span class="hidden-tablet"> <i class="fa fa-list"></i> Manage Menu</span></a></li>
                <li class="<?=$edit_links ?>"><a href="content.php"><i class="icon-home"></i>
                    <span class="hidden-tablet"><i class="fa fa-plus"></i> Add Page</span></a></li>
                <li class="<?=$all_links ?>"><a href="index.php"><i class="icon-home"></i>
                    <span class="hidden-tablet"> <i class="fa fa-link"></i> All Links</span></a></li>
                <li class="<?=$tags ?>"><a href="tags.php"><i class="icon-home"></i>
                    <span class="hidden-tablet"> <i class="fa fa-tag"></i> Tags</span></a></li>
                <!-- /.dropdown -->
                 <li><a href="logout.php"><i class="fa fa-user"></i> Logout</a></li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
</nav>
        </header>

  <div class="container-fluid">
    <div class="row-fluid">
    <?php if(!isset($no_visible_elements) || !$no_visible_elements) { ?>

      <div id="content" class="span9">
      <!-- content starts -->
      <?php } ?>
