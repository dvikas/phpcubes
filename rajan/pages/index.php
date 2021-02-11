<?php
require_once('header.php');
?>

<div class="filtering">
<br>
	<form class="form-inline">

	  <div class="col-lg-6">
	      	  <div class="form-group">
    		<select id="selectInId" name="selectIn" class="form-control ">
    		  <option  value="title">Title</option>
    		  <option selected="selected" value="alias">Alias</option>
    		</select>
    	  </div>
        <div class="input-group">
          <input type="text" name="name" id="name" class="form-control" placeholder="Search for...">
          <span class="input-group-btn">
            <button class="btn btn-default" class="btn btn-default" id="LoadRecordsButton" type="submit">Go!</button>
          </span>
          
        </div><!-- /input-group -->
      </div><!-- /.col-lg-6 -->
  
	</form>

<hr>

</div>
<div id="StudentTableContainer"></div>
<!---<link href="jtable/themes/metro/blue/jtable.css" rel="stylesheet" type="text/css" />-->
<link href="jtable/themes/metro/darkgray/jtable.css" rel="stylesheet" type="text/css" />


<?php include('footer.php'); ?>
  
    <link href="./jtable/jquery-ui-1.10.1.custom.min.css" rel="stylesheet" type="text/css" />
    <link href="./jtable/jtable_jqueryui.css" rel="stylesheet" type="text/css" />

    
    
<script type="text/javascript" src="jtable/jquery.jtable.js"></script>
<script type="text/javascript">

    $(document).ready(function () {

        $('#StudentTableContainer').jtable({
            title: 'Manage Lists',
            paging: true, //Enable paging
            pageSize: 10, //Set page size (default: 10)
            sorting: true, //Enable sorting
            defaultSorting: 'title ASC', //Set default sorting
            actions: {
                listAction: 'ajax_all_links.php',
                //deleteAction: 'ajax_all_links_edit.html',
                updateAction: 'ajax_all_links_edit.php'
                //createAction: '/Demo/CreateStudent'
            },
            fields: {
                id: {
                  key: true,
                  create: false,
                  edit: false,
                  list: false
                },
                display_id: {
                  key: false,
                  create: false,
                  edit: false,
                  list: true
                },
                title: {
                  type: 'textarea',
                  title: 'Title',
                  width: '23%'
                },
                titleOfHead: {
                  type: 'textarea',
                  title: 'titleOfHead'
                },
                alias: {
                  title: 'Alias',
                  type: 'textarea',

                },
                keywords: {
                  type: 'textarea',
                  title: 'Keywords'
                },
                description: {
                  type: 'textarea',
                  title: 'Description'
                },
                hits: {
                    title: 'Hits'
                },
                status: {
                    title: 'Status',
                    type: 'radiobutton',
                    options: { '0': 'Inactive', '1': 'Active'}

                },
                modified_date: {
                    title: 'Date',
					create: false,
					edit: false,
					list: true

                }
            }
        });

        //Load student list from server
        $('#StudentTableContainer').jtable('load');
                //Re-load records when user click 'load records' button.
        $('#LoadRecordsButton').click(function (e) {
            e.preventDefault();
            $('#StudentTableContainer').jtable('load', {
                name: $('#name').val().trim(),
                select: $('#selectInId').val().trim()
            });
        });


    });

</script>
<!-------------------------------------------->
<style>
.ui-dialog{
	margin-top: 100px;
}

</style>
