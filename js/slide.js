  var stickyHeaderTop =-1;

  $(document).ready(function(){

    if($('#titlebar').length == 0) {
      $('#ebook_toc, .ebook-side .pane_hide').css("top",0);
    }

    if($('#bottombar').length == 0) {
      $('#ebook_toc, .ebook-side .pane_hide').css("bottom",0);
    }

    $('.open_pane').on('click',function(){

      move_left = parseInt($('#ebook_toc')
                  .css('left'),10) == 0 ? -$('#ebook_toc').outerWidth() : 0;

      $('#ebook_toc').animate({
        left: move_left
      });

      $('.ebook-side').toggleClass("pane_hide").toggle();
      if(move_left == 0) {
        $('.open_pane .side-container').removeClass('yellow-arrow-right')
                                       .addClass('yellow-arrow-left');
      } else {
        $('.open_pane .side-container').removeClass('yellow-arrow-left')
                                       .addClass('yellow-arrow-right');
      }
        $(this).show();
      });/* end .open_pane click*/


      $('.container, .close_pane').on('click', function(){
        if(parseInt($('#ebook_toc').css("left"))>=0) {

          $('#ebook_toc').animate({
              left: -$('#ebook_toc').outerWidth()
          });
          $('.ebook-side').addClass("pane_hide").show();
          $('.open_pane .side-container').removeClass('yellow-arrow-left')
                                         .addClass('yellow-arrow-right');
        }
      });


    if( $(window).scrollTop() > stickyHeaderTop + 40) {
      $('#ebook_toc,.open_pane .side-container').css({top: '40px'});
    } else {
      $('#ebook_toc,.open_pane .side-container').css({top: '86px'});
    }

    if($('#bottombar').length < 1) {
       $('#ebook_toc,.open_pane .side-container').css({"bottom": 0});
    }

  });/** end ready **/

  /**
   * Do action while scroll down page
   * **/
  $(window).scroll(function(){

    if( $(window).scrollTop() > stickyHeaderTop+40) {
      $('#ebook_toc,.open_pane .side-container').css({top: '40px'});
    } else {
      $('#ebook_toc,.open_pane .side-container').css({top: '86px'});
    }
    if($('#bottombar').length < 1) {
      $('#ebook_toc,.open_pane .side-container').css({"bottom": 0});
    }

  });
