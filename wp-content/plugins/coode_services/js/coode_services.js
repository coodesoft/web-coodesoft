
(function($){

  $('.service').off().on('click', '.service-content', function(){
    $(this).toggleClass('service-hidden');
    $(this).siblings('.service-description').toggleClass('service-hidden');
  });

})(jQuery)
