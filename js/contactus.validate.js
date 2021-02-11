$(document).ready( function() {

  $("#contactUs").validate({
    rules: {
      "from" : {
          required: true,
          minlength: 5,
      },
      "email" : {
          required: true,
          email:true
      },
      "subject" : {
          required: true,
          minlength:10,
      },
      "message" : {
          required: true,
          minlength:10
      },
      "captcha" : {
          required: true
      }
    },
    'messages':{
      "from" : {
        required: 'Please enter your name',
        minlength: $.format('Please enter at least {0} characters.'),
      },
      "email" : {
        required: 'Please enter your email.',
        minlength:'Please enter valid email.'
      },
      "subject" : {
        required: 'Please enter your mail subject.',
        minlength: $.format('Please enter at least {0} characters.'),
      },
      "message" : {
        required: 'Please enter your message.',
        minlength: $.format('Please enter at least {0} characters.'),
      },
      "captcha" : {
        required: 'Please enter security code.'
      },
    },
   highlight: function (element) {
        $(element).closest('.form-group').removeClass('has-success').addClass('has-error').addClass('has-feedback');
        $(element).parent().find('span.form-control-feedback').remove();
        $(element).parent()
        .append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
  },
    success: function (element) {
        element.parent()
        .find('span.form-control-feedback').remove();

        element.closest('.form-group').removeClass('has-error').addClass('has-success').addClass('has-feedback');
        element.parent()
        .append('<span class="glyphicon glyphicon-ok form-control-feedback"></span>');
    }
  });

});// ready close
