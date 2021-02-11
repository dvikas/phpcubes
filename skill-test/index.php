<?php
  require_once('db.php');
  ///////////////////////////////////////////////

  $query_cat = "SELECT * FROM `ques_cat`";

  $result = mysql_query($query_cat) or die(mysql_error());

  while($ans = mysql_fetch_array($result)) {

    $cat[$ans['id']] = $ans['name'];
  }
  ///////////////////////////////////////////////
  if(!empty($_POST)){
    $cat_id = $_POST['cat_id'];
    $idStr = @$_COOKIE['cat_'.$cat_id];
    $cleanStr = implode(',',array_filter(explode(',',$idStr)));
    $where = !empty($cleanStr) ? "WHERE `id` NOT IN ($cleanStr) AND `cat_id` = $cat_id " : "WHERE `cat_id` = $cat_id ";
    $resultRand = findAll("questions","id","$where","ORDER BY RAND()");
    while($ans  = mysql_fetch_assoc($resultRand)){

      $idArr[] = $ans['id'];

    }



    $_SESSION['id'] = $idArr;

    $_SESSION['quesToAttempt'] = count($idArr);

    $_SESSION['totalQues'] = count($idArr);

    $_SESSION['quesNo'] = 0;

    $_SESSION['cat_id'] = $cat_id;

    $_SESSION['cat_name'] = $cat[$cat_id];



    header("location:questions.php");



  } else {

      session_destroy();

  }

?>

<?php

#######################

require_once('header.php');

#######################

?>

      <div class="jumbotron">

    <!---<blockquote>-->

      <h3>Choose Category</h3>

          <form name="home" method="post" action="">

            <select name="cat_id">

              <?php foreach($cat as $k=>$v) : ?>

              <option value="<?=$k?>"><?=ucfirst(strtolower($v))?></option>

              <?php endforeach;?>

            </select>

          </form>

 <!--   </blockquote>-->

    <blockquote class="pull-right"><a class="btn btn-success" onClick="document.home.submit()" href="javascript:void(0)">Begin Test !!</a></blockquote>

    <div class="well">

    <blockquote>

      <h4>Features :</h4>

      <p>

        <ol>

          <li>Check answer with description of each question on same page.</li>

          <li>We will save all the questions,so that in your next visit you will not get questions repeated.</li>

          <li>No time limit.</li>

          <li>Questions may be multiple choice or objective type question.</li>

        </ol>

      </p>

    </blockquote>

    </div>

      </div>



      <hr>

    <!---------END ---------->



<?php

$count = file_get_contents('count.txt');

$count++;

file_put_contents('count.txt',$count);

#######################

require_once('footer.php');

#######################

?>

    <div id="disqus_thread"></div>


    </div> <!-- /container -->

    <script src="js/bootstrap.min.js"></script>

    <script src="js/application.js"></script>


  </body>

</html>

