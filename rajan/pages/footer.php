    <?php if(!isset($no_visible_elements) || !$no_visible_elements) { ?>
      <!-- content ends -->
      </div><!--/#content.span10-->
    <?php } ?>
    </div><!--/fluid-row-->
    <?php if(!isset($no_visible_elements) || !$no_visible_elements) { ?>

    <hr>

    <footer>
      <p class="pull-left">&copy; <a href="http://phpcubes.com" target="_blank">cubes</a> <?php echo date('Y') ?></p>
      <p class="pull-right">Powered by: <a href="#">Vikas Dwivedi</a></p>
    </footer>
    <?php } ?>

  </div><!--/.fluid-container-->

          <!-- Modal -->
        <div class="loadingWrapper" style="display: block;">
            <div class="modal fade top76" id="courseModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  
                  <div class="modal-body">
                    <div class="loading"></div>
                        <div class="content text-center">
                           <i class="fa fa-spinner fa-spin"></i>
                            <span id="txt-loader-id"></span>
                        </div>
                  </div>
                </div>
              </div>
            </div>            
        </div>
        
  <!-- external javascript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->

    <!-- jQuery -->
    <script src="../js/jquery-1.11.2.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
  <!-- jQuery UI -->
  <script src="../js/jquery-ui.min.js"></script>


<script type="text/javascript">
  // When the document is ready set up our sortable with it's inherant function(s)
  $(document).ready(function() {
    //$(".child").hide();

    $('.enableDelete').on('click',function(){
    var id = $(this).attr('id');
       $.ajax({
        url:'enableDelete.php',
        data:{'id':id},
        dataType:'json',
        type:'POST',
        beforeSend:function(){  },

        success:function(data){
          $.each(data, function(i,message) {


          })
        },
       });
    });

    $('.parent1').click( function() {
      //$(".child").hide();
      //alert($(this).parent().find('.child').is(':visible'))
      if($(this).closest('li').find('.child').is(':visible')) {

        $(this).closest('li').find('.child').hide();
      } else {
        $(this).closest('li').find('.child').show();
      }
    });

	//child
    $(".sort_child").sortable({
      cursor : 'move',
      placeholder: "ui-state-highlight",
      update : function () {
      var order = $(this).sortable('serialize');
      $.ajax({
        url:"process-sortable.php?"+order,
        data:{},
        dataType:'json',
        type:'POST',
        beforeSend:function(){  
            $('#txt-loader-id').text('Updating...');
        	$('#courseModal').modal('show');
            },

        success:function(data){

        },
        complete:function(data){
        	$('#courseModal').modal('hide');

            }
       });


      }
    });

	//parent
    $("#sort_parent").sortable({
	  cursor : 'move',
	  placeholder: "ui-state-highlight",
      update : function () {
      var order = $(this).sortable('serialize');
      $.ajax({
        url:"process-sortable.php?"+order,
        data:{},
        dataType:'json',
        type:'POST',
        beforeSend:function(){  
            $('#txt-loader-id').text('Updating...');
        	$('#courseModal').modal('show');
            },

        success:function(data){

        },
        complete:function(data){
        	$('#courseModal').modal('hide');

            }
       });
      }
    });

});
</script>

    <style>
      .test-list li:hover{
        background:#DBEAF9;
      }
    .ui-state-highlight { 
        height: 3em; 
    	border:1px dashed #FAA523;
    	background-color: lightyellow;
    	margin:5px 0px; 
    }
      
    </style>

<script type="text/javascript">
  $(document).ready(function(){

    function getCat(id){
      var URL = 'ajax_get_sub_cat.php';
      $.ajax({
        url:URL,
        data:{'id':id},
        dataType:'json',
        type:'POST',
        beforeSend:function(){  },

        success:function(data){
          var selectHtml='<select class="form-control" name="sub_cat" >\
          <option value="">-Select-</option>';
          var parentId = $("#child_parent_id").val();
          $.each(data, function(i,message) {
            if ( parentId != 0 ){
              var selected = (message.id == parentId) ? 'selected':'';
            }
            selectHtml += '<option '+selected+' value="'+message.id+'">'+message.title+'</option>';
          });
          $('#subCatId').html(selectHtml);
        },
        complete:function(){

        },
        error: function(xhr,status,error) { alert('Error: ' + status) ; }
      });
    }// end getCat()

    $('#catId').change(function(){
        getCat($(this).val());
    });
    // select default on load
    getCat($('#catId').val());

    $('#copyId').on('click',function(){
      var val = $.trim($('#menuNameId').val());
      $('#menuNameId').val(val);
      $('#aliasId').val(val.toLowerCase().replace(/ /g,'-')+'.html');
      $('#titleOfHeadId').val(val);

    });
});
</script>

<!-------------END EDIT LINKS------------------------------->

</body>
</html>
