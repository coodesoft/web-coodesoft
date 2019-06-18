
(function($){
	
		$('.coode-categories').off().on('click', 'li.category-item', function(){
			
			let $grid = $('.porftolio-elements').isotope();	
					
			let data = {
					'category' : $(this).attr('data-id'),
					'action' : 'coode_filter_portfolio',
				};
			
			$.ajax({
				data: data,
				type: 'POST',
				url: ajaxurl,
				success: function(response){	
					$grid.isotope('remove', $('.portfolio-wrapper'));
					
					$response = $(response);
					$grid.append($response).isotope('appended', $response).isotope('layout');
				},
				error: function(response){
					console.log('Se produjo un error al filtrar el portfolio: '+portfolio);
				},
				
			});
			
		});
			
	

})(jQuery);
