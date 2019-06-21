
(function($){

  $('.service').off().on('click', '.service-content', function(){
      
      if ( !$(this).hasClass('service-hidden') ){
          $('.service-content').removeClass('service-hidden');  
          $('.service-content').siblings('.service-description').addClass('service-hidden');  
          $('.service-content').siblings('.service-hexagon').removeClass('service-hexagon-active');  

          $(this).addClass('service-hidden');
          $(this).siblings('.service-description').removeClass('service-hidden');
          $(this).siblings('.service-hexagon').addClass('service-hexagon-active');  
      } else{
          $(this).removeClass('service-hidden');  
          $(this).siblings('.service-description').addClass('service-hidden');  
          $(this).siblings('.service-hexagon').removeClass('service-hexagon-active');  
      }
      
  });

  
    
})(jQuery)
