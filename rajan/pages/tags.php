<?php
require_once('header.php');

    $id = 0; $edit_tag_name = '';
    $btn_txt = 'Add';
    if(isset($_GET['edit']) && !empty($_GET['edit'])) {
        $id = $_GET['edit'];
        $query = "select * from tags where id = '$id'";
        $run = mysql_query($query)or die(mysql_error());
        $row = mysql_fetch_assoc($run);
        $btn_txt = 'Update';
        //print_r($row);
        $edit_tag_name = $row['name'];
    }
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

    if(isset($_POST['tag_name']) && !empty($_POST['tag_name'])) {
        $tag_name = $_POST['tag_name'];
        if($id == 0){
            $query = "INSERT INTO tags SET name='$tag_name'";
            mysql_query($query)or die(mysql_error());
        } else {
            $query = "UPDATE tags SET name='$tag_name' WHERE id='$id'";
            mysql_query($query)or die(mysql_error());
        }
    }

    $totalRecords = "SELECT COUNT(*) as count FROM tags";
    $totalRecords_result = mysql_query($totalRecords) or die(mysql_error());
    $totalRecords_ans = mysql_fetch_assoc($totalRecords_result);
    $totalTags = $totalRecords_ans['count'];
?>
    <link href="dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

<div class="row" style="margin:40px;">
    <div class="container col-sm-5">


        <form class="form-inline" method="post">
          <div class="form-group">
            <input type="hidden" name="id" value="<?=$id?>">
            <input type="text" required name="tag_name" value="<?=$edit_tag_name?>" class="form-control"  placeholder="Tag Name">
          </div>
          <button type="submit" class="btn btn-default"><?=$btn_txt?></button>
        </form>
        TOTAL TAGS : <em><?=$totalTags?></em>
        <table class="table table-hover table-bordered table-striped">
            <tr><th colspan="3"> View Tags</th></tr>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
    <?php

        if(isset($_GET['del'])){
            $del_id = $_GET['del'];
            if(mysql_query("delete from tags where id='$del_id'")){
                echo"selected tags of id $del_id";
            }
        }


             $query= mysql_query("select*from tags");
        while($row=mysql_fetch_array($query)){
            $showid=$row['id'];
        $showname=$row['name'];
          echo "<tr>
                <td>$showid</td>
                <td>$showname</td>
                <td><a onClick='return confirm(\"Are you sure ?\")' href='tags.php?del=$showid'><i class='fa fa-trash'></i></a>&nbsp;&nbsp;&nbsp;
                <a href='tags.php?edit=$showid'><i class='fa fa-edit'></i></a></td>
            </tr>";
                }
    ?>


    </table>
    </div>
</div>
<?php include('footer.php'); ?>
