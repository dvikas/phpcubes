
    <div class="container">

      <hr>

      <footer>
        <div class="row">
          <div class="col-lg-12">
            <p>Copyright &copy; phpcubes.com 2012-<?=date('Y')?></p>
          </div>
        </div>
      </footer>

    </div><!-- /.container -->

  <script src="<?=BASE_URL?>/js/jquery-1.10.2.js"></script>
  <link href="<?=BASE_URL?>/css/slide.css" rel="stylesheet">
  <script src="<?=BASE_URL?>/js/slide.js"></script>
<?php
if($_SERVER['REQUEST_URI'] == '/')
{
?>
    <script src="<?=BASE_URL?>/js/fluid-modernizr.custom.js"></script>
    <script src="<?=BASE_URL?>/js/fluid-masonry.js"></script>
    <script src="<?=BASE_URL?>/js/fluid-imagesloaded.js"></script>
    <script src="<?=BASE_URL?>/js/fluid-classie.js"></script>
    <script src="<?=BASE_URL?>/js/fluid-AnimOnScroll.js"></script>

    <script>
      new AnimOnScroll( document.getElementById( 'grid' ), {
        minDuration : 0.4,
        maxDuration : 0.7,
        viewportFactor : 0.2
      } );
    </script>
<?php
} else {
?>
    <script>
    $('pre.shell').each(function(){
          var txt = $(this).text();
          var txt1 = txt.split(':~$');
          var shell = '<span class="shell-root">'+txt1[0]+':~$</span>';
          var txt2 = txt1[1].split('\n');
          shell += '<span class="shell-keyword">'+txt2[0]+'</span><br>';
          for(var j=1 ; j<txt2.length ; j++) {
          shell += '<span class="text-primary">'+txt2[j]+'</span><br>';
          }
          $(this).html(shell);
    });
    </script>
<?php
}
?>


  <script src="<?=BASE_URL?>/js/prepengine-footer.js"></script>
<!--
  <script src="<?=BASE_URL?>/js/bootstrap.js"></script>
-->
  <script src="<?=BASE_URL?>/js/jquery-ui-1.js"></script>





      <script type="text/javascript">
    $(document).ready(function() {
      $('input.typeahead').typeahead({
        source: function (query, process) {
          $.ajax({
            url: BASE_URL+'/ajax_data.php',
            type: 'POST',
            dataType: 'JSON',
            data: 'query=' + query,
            success: function(data) {
              //console.log(data);
              process(data);
            }
          });
        }
      });

      function doClick()
      {
        var search = ( $.trim( $('.typeahead').val() ));
        //alert(BASE_URL+'/'+search);
        //window.location = '"'+BASE_URL+'/'+search+'"';
        if(search.length < 3){
          $('.typeahead').closest('.form-group').addClass('has-error');
          $('.typeahead').prop('placeholder','Min 3 char required.')
          return false;
        }
         var pos = search.indexOf(".htm");
         if (pos == -1) {
          searchUrl = BASE_URL+'/q/'+search;
         } else {
          searchUrl = BASE_URL+'/'+search;
         }
        setTimeout(function(){
          window.location.replace(searchUrl);
        },1000);
        //window.location.replace(searchUrl);
      }//end doclick()

      $('.searchIt').on('click',function(){
        doClick();
      });

      $('.typeahead').on('change',function(){
        if($.trim($(this).val()) != '') {
          doClick();
        }
      });


    });
    </script>

   <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL?>/css/jquery.tagit.css">
   <script src="<?php echo BASE_URL?>/js/tag-it.js" type="text/javascript" charset="utf-8"></script>

         <script>
        $(function(){
            var sampleTagsVal = $.trim($('#tags_hidden_id').val());
            var sampleTags = sampleTagsVal.split(',');
            //['c++', 'java', 'php', 'coldfusion', 'javascript', 'asp', 'ruby', 'python', 'c', 'scala', 'groovy', 'haskell', 'perl', 'erlang', 'apl', 'cobol', 'go', 'lua'];

            var eventTags =$('#singleFieldTags2');
            var addEvent = function(text,name) {
              console.log(name);
              console.log(text+'126');
              if(name == 'onTagClicked'){
				  window.location.replace(BASE_URL+'/tag/'+text);
			  }

var parser = document.createElement('a');
parser.href = window.location.href;

//parser.protocol; // => "http:"
//parser.host;     // => "example.com:3000"
//parser.hostname; // => "example.com"
//parser.port;     // => "3000"
//parser.pathname; // => "/pathname/"
//parser.hash;     // => "#hash"
//parser.search;   // => "?search=test"

             console.log(parser.pathname); 
            };

            // examples, so it automatically defaults to singleField.
            eventTags.tagit({
                availableTags: sampleTags,
                removeConfirmation: true,
<?php

if(!isset($_SESSION['id'])) {
?>
                readOnly: true,
<?php
}
?>

                //beforeTagAdded: function(evt, ui) {
                    //if (!ui.duringInitialization) {
                        //addEvent('beforeTagAdded: ' + eventTags.tagit('tagLabel', ui.tag));
                    //}
                //},
                //afterTagAdded: function(evt, ui) {
                    //if (!ui.duringInitialization) {
                        //addEvent('afterTagAdded: ' + eventTags.tagit('tagLabel', ui.tag));
                    //}
                //},
                //beforeTagRemoved: function(evt, ui) {
                    //addEvent('beforeTagRemoved: ' + eventTags.tagit('tagLabel', ui.tag));
                //},
                //afterTagRemoved: function(evt, ui) {
                    //addEvent('afterTagRemoved: ' + eventTags.tagit('tagLabel', ui.tag));
                //},
                onTagClicked: function(evt, ui) {
                    addEvent(eventTags.tagit('tagLabel', ui.tag),'onTagClicked');
                },
                //onTagExists: function(evt, ui) {
                    //addEvent('onTagExists: ' + eventTags.tagit('tagLabel', ui.existingTag));
                //}

            });

            $('#ebook_toc').css('display','block');

        });//end ready
    </script>
  <!------------------------------>
    <script src="<?php echo BASE_URL?>/js/site.js" type="text/javascript" charset="utf-8"></script>

    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="<?=BASE_URL?>/js/bootstrap3-typeahead.js"></script>


<?php
if($debug == true) {
  echo "<hr><hr>";
  foreach($debugArr as $val){
    echo $val;
  }
}
?>
  </body>
</html>
