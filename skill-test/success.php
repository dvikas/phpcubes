<?php
session_start();
//session_destroy();

#######################
require_once('header.php');
#######################
$cat_id = $_SESSION['cat_id'];
$cat_name = $_SESSION['cat_name'];
?>

      <div class="jumbotron">
        <h3>Questions complete !</h3>
        <p class="lead">We saved all the questions you attempted in this session, so that when you will try next time then you will not get boared to get repeated questions.</p>
    <p class="lead">If you want to try those questions again then you have to <a href="javascript:void(0)" title="<?=$cat_id?>" id="del_history">delete your saved history</a> <br> for category: <em><?=$cat_name?></em>.</p>
        <a class="btn btn-large btn-success" href="index.php">I want to try again !!</a>
      </div>

      <hr>


<?php
#######################
require_once('footer.php');
#######################
?>

    </div> <!-- /container -->

<script>
$(document).ready(function(){

  $('#del_history').click(function(){
    var cat_id = $(this).attr('title');

    $.ajax({
      type: "POST",
      url: "clear_history.php",
      data: { cat_id: cat_id }
    }).done(function( msg ) {
        alert( "Data Saved: " + msg );
    });
  });

})
</script>
  </body>
 </html>
