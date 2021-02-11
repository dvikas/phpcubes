
 $(document).ready(function(){


  $('#mask').on('click', function() {
    $('#mask , .login-popup').fadeOut(300 , function() {
    $('#mask').remove();
    $('#searchDivUl').slideUp(200);
    $('#searchId').val('');
    });
    return false;
  });

  $('#searchId').on('keyup',function(){
    var URL = BASE_URL+'/ajax_search_suggest.php';
    var q = $.trim($(this).val());
    if(q == ''){
      $('#loaderSearch').html('');
      $('#searchDivUl').hide();
      return false;
    } else if(q.length < 3 || q.length %2 == 0){
      return false;
    }
    $.ajax({
      url:URL,
      data:{'q':q},
      dataType:'json',
      type:'POST',
      beforeSend:function(){
        $('#searchDiv').html('');
        $('#loaderSearch').html('<img src="'+BASE_URL+'/images/ajax-loader.gif">');
      },
      success:function(data){

        $('#searchDiv').html('');
        $('#searchDiv').append('<ul id="searchDivUl"></ul>');
        var a = 0;
        $.each(data, function(i,message) {
          var aWord = q.split(' ');
          var word = message.keywords;
          for(var i=0 ; i < aWord.length ; i++) {
             var n = word.indexOf("<span");

             if( -1 == n ) {
                var regex = new RegExp( '(' + aWord[i] + ')', 'gi' );
                word = word.replace( regex, '<span style="color:green">$1</span>' );
             }
          }
          $('#searchDivUl').append('<li><a  href="'+BASE_URL+'/'+message.alias+'">'+word+'</a></li>');
          a++;
        })

        /** Add the mask to body **/
        $('body').append('<div id="mask"></div>');
        $('#mask').fadeIn(300);
        if(a == 0){
          $('#searchDivUl').append("<li>Sorry, match not found...</li>");

        }
      },
      complete:function(){
        $('#loaderSearch').html('');
      },
      error: function(xhr,status,error) { console.log('Error: ' + status) ; }
    });
  });

  // Submission of form
  $('#submitId').on('click',function(){
    var oForm = document.getElementById('searchFormId');
    var query = $(this).prev().val();
    oForm.action = BASE_URL+"/search/"+query;
    oForm.submit();
  });

  var styleSwitcher = $('.row-fluid').find('.span3:first');

  styleSwitcher.hide(600);

  setTimeout(function(){
    $('.left-menu-switcher').html('Show&nbsp;<i class="icon-double-angle-down icon-1x"></i>');
  },600);


  $('.left-menu-switcher').toggle(

    function() {
      styleSwitcher.show(600);
      $('#mainContainerId').css('z-index','-14');
      setTimeout(function(){
        $('.left-menu-switcher').html('Hide&nbsp;<i class="icon-double-angle-up icon-1x"></i>');
        $('#mainContainerId').css('opacity','0.5');
      },600);
    },
    function() {
      styleSwitcher.hide(600);
      setTimeout(function(){
        $('.left-menu-switcher').html('Show&nbsp;<i class="icon-double-angle-down icon-1x"></i>');
        $('#mainContainerId').css('z-index','0');
        $('#mainContainerId').css('opacity','1');
      },600);
    }
  );

  $('div.dp-highlighter').each(function(i,j){

    $(this).find('td:eq(1)').attr('id','codeSelectId_'+i);
    $(this).after('<div class="show-links" style="width:100%;float:left;"></div>');
    var copyCode = $(this ).nextAll("div.copy-code:first").clone();

    var demoLink = $(this ).nextAll("div.demo-link:first").clone();
    var demoLink1 = $(this ).nextAll("div.demo-link:eq(1)").clone();
    var zip_link = $(this ).nextAll("div.zip-link:first").clone();
    $(this ).nextAll("div.copy-code:first").remove(  );
    $(this ).nextAll("div.demo-link:first").remove( );
    $(this ).nextAll("div.demo-link:first").remove( );
    $(this ).nextAll("div.zip-link:first").remove( );

    $(this).next('div.show-links').append('<div class="copy-code" style="float:left;\
    margin-top:10px;margin-right: 20px;margin-bottom: 10px;">\
    <button type="button" data-loading-text="Press CTRL+C" \
    onClick="javascript:selectText(\'codeSelectId_'+i+'\')" \
    id="selectBtn_'+i+'" class="btn btn-primary selectText">Copy Code</button></div>')
    $(this).next('div.show-links').append(demoLink);
    $(this).next('div.show-links').append(copyCode);
    $(this).next('div.show-links').append(demoLink1);
    $(this).next('div.show-links').append(zip_link);

  });
/*
    $('div.hl-main>pre').each(function(k,l){
      id = 'p'+k;
      $(this).attr('id','codeSelectId_'+id);

      $(this).after('<div class="show-links" style="width:100%;float:left;"></div>');
      var copyCode = $(this ).nextAll("div.copy-code:first").clone();

      var demoLink = $(this ).nextAll("div.demo-link:first").clone();
      var demoLink1 = $(this ).nextAll("div.demo-link:eq(1)").clone();
      var zip_link = $(this ).nextAll("div.zip-link:first").clone();
      $(this ).nextAll("div.copy-code:first").remove( );
      $(this ).nextAll("div.demo-link:first").remove( );
      $(this ).nextAll("div.demo-link:first").remove( );
      $(this ).nextAll("div.zip-link:first").remove( );


      $(this).next('div.show-links').append('<div class="copy-code" \
      style="float:left;margin-top:10px;margin-right: 20px;margin-bottom: 10px;">\
      <button type="button" data-loading-text="Press CTRL+C" class="btn btn-primary selectText"\
         onClick="javascript:selectText(\'codeSelectId_'+id+'\')"  \
      id="selectBtn_'+id+'">Copy Code</button></div>')

      $(this).next('div.show-links').append(demoLink);
      $(this).next('div.show-links').append(copyCode);
      $(this).next('div.show-links').append(demoLink1);
      $(this).next('div.zip-link').append(zip_link);

    });
*/
    // button state demo
    $('.selectText').click(function () {

      var btn = $(this);
      btn.button('loading');
      setTimeout(function () {
        btn.button('reset')
      }, 2000)
    })
  });/*** end jquery  ***/


    function selectText(elementId) {

      var el = document.getElementById(elementId);
      var body = document.body, range, sel;
      if (document.createRange && window.getSelection) {
        range = document.createRange();
        sel = window.getSelection();
        sel.removeAllRanges();
        try {
          range.selectNodeContents(el);
          sel.addRange(range);
        } catch (e) {
          range.selectNode(el);
          sel.addRange(range);
        }
      } else if (body.createTextRange) {
        range = body.createTextRange();
        range.moveToElementText(el);
        range.select();
      }
    }/*** end selectText()  **/
