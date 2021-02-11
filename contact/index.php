<?php

  $title = "Phpcubes | Contact Us";

  require_once('../includes/connection.php');
  require_once('../includes/header.php');

  if(isset($_POST['email']) && !empty($_POST['email'])) {

    $flag = true;
	  

    if (empty($_SESSION['captcha']) || trim(strtolower($_REQUEST['captcha'])) != $_SESSION['captcha']) {

        echo '<div class="alert alert-danger fade in">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
          Invalid security code
        </div>';

    } else {
    #unset($_SESSION['captcha']);


     $email = trim($_POST['email']);

      if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Read POST request params into global vars
        $to      = 'vikas.nice@gmail.com';
        $from    = $_POST['from'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $message .= "\n\n Email ID : $email";

        // Obtain file upload vars
         $fileatt      = $_FILES['fileatt']['tmp_name'];
         $fileatt_type = $_FILES['fileatt']['type'];
         $fileatt_name = $_FILES['fileatt']['name'];
        $aa=filesize($fileatt);
        $headers = "From: $from";

        if (is_uploaded_file($fileatt)) {
          // Read the file to be attached ('rb' = read binary)
          $file = fopen($fileatt,'rb');
          $data = fread($file,filesize($fileatt));
          fclose($file);

          // Generate a boundary string
          $semi_rand = md5(time());
          $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

          // Add the headers for a file attachment
          $headers .= "\nMIME-Version: 1.0\n" .
                      "Content-Type: multipart/mixed;\n" .
                      " boundary=\"{$mime_boundary}\"";

          // Add a multipart boundary above the plain message
          $message = "This is a multi-part message in MIME format.\n\n" .
                     "--{$mime_boundary}\n" .
                     "Content-Type: text/plain; charset=\"iso-8859-1\"\n" .
                     "Content-Transfer-Encoding: 7bit\n\n" .
                     $message . "\n\n";

          // Base64 encode the file data
          $data = chunk_split(base64_encode($data));

          // Add file attachment to the message
          $message .= "--{$mime_boundary}\n" .
                      "Content-Type: {$fileatt_type};\n" .
                      " name=\"{$fileatt_name}\"\n" .
                      //"Content-Disposition: attachment;\n" .
                      //" filename=\"{$fileatt_name}\"\n" .
                      "Content-Transfer-Encoding: base64\n\n" .
                      $data . "\n\n" .
                      "--{$mime_boundary}--\n";
        }

        // Send the message
        $ok = mail($to, $subject, $message, $headers);
        if ($ok) {
          echo '<div class="alert alert-success fade in">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
          Thanks, <strong>'.$from.'</strong> we will contact you soon.
        </div>';
        } else {
          echo '<div class="alert alert-danger fade in">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
          Sorry, <strong>'.$from.'</strong> mail could not be send.Please try again.
        </div>';
        }

      } else {
                echo '<div class="alert alert-danger fade in">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
          This <strong>'.$email.'</strong> address is considered invalid..
        </div>';
        echo " $email ";
      }
    }
  }
?>

    <!-- Begin page content -->
    <div class="container">

      <form class="form-horizontal" method="post" role="form" enctype="multipart/form-data" id="contactUs" >

        <div class="form-group">
          <label class="col-sm-2 control-label" >To :</label>
          <div class="col-xs-4 form-control-static"><span class="">contact@phpcubes.com</span></div>
        </div>

    <div class="form-group">
      <label class="col-sm-2 control-label" required>From :</label>
      <div class="col-xs-4">
        <input type="text" class="form-control " value="<?=@$_POST['from']?>" name="from"  placeholder="My name is.."/>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label"  required>Email :</label>
      <div class="col-xs-4">
        <input type="text" class="form-control " name="email" value="<?=@$_POST['email']?>" placeholder="My email id is.."/>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label "  required>Subject :</label>
      <div class="col-xs-4">
        <input type="text" class="form-control" name="subject" value="<?=@$_POST['subject']?>" placeholder="Email subject is.."/>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label"  required>Message :</label>
      <div class="col-xs-4">
        <textarea  class="form-control" name="message" placeholder="My message is ...."><?=@$_POST['message']?></textarea>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label"  required>File Attachment :</label>
      <div class="col-xs-4">
        <input type="file"  class="form-control" style="padding:0px" name="fileatt" />
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label"  required>Security Code :</label>
      <div class="col-xs-3">
        <!-- Captcha Start -->
        <img src="captcha/captcha.php" id="captcha" /><br/>
        <a href="javascript:void(0)" onclick="document.getElementById('captcha').src='captcha/captcha.php?'+Math.random();
            document.getElementById('captcha-form').focus();"
            id="change-image">Not readable? Change text.</a><br/><br/>
        <input type="text" class="form-control" name="captcha" id="captcha-form" maxlength="10"/><br/>
        <!-- Captcha End-->

      </div>
    </div>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button class="btn btn-success" type="submit">I am done</button>
        </div>
      </div>


      </form>

    </div>
<hr>
    <div id="footer">
      <div class="container">
            <p>Copyright &copy; phpcubes.com 2012-<?=date('Y')?></p>
      </div>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="../js/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.min.js"></script>
    <script type="text/javascript" src="../js/contactus.validate.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

  </body>
</html>
