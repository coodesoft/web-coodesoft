
let base_path = '/web-coodesoft';

let createNewTeamCard = function(){
	var response;
	$.ajax({ 
		type: "GET",   
		url: base_path+'/wp-content/plugins/coode_team/admin/templates/team_card.html',   
		success : function(data){
			$('#coodeCardContainer>div').append(data);
		}
	});
	
}

let preloadImage = function (input, target) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      target.attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}

$(function(){
	
	$('#coodeTeamPanel').off().on('click', '#newCardButton',function(){
		createNewTeamCard();
	});
	
	$('#coodeTeamPanel').on('click', '.delete-card', function(){
		let parent = $(this).closest('.card-container');
		parent.remove();
	});
	
	$('#coodeTeamPanel').on('change', '.form-control-file', function() {
		let img = $(this).closest('.card-container').find('.card-img-top'); 
		preloadImage(this, img);
	});
	
	$('#coodeTeamPanel').on('submit', 'form', function(e){
		e.preventDefault();
		e.stopPropagation();

		let form = $(this)[0]; // You need to use standard javascript object here
		let formData = new FormData(form);
		formData.append("action", "ct_create_team_card");
		$.ajax({
			url: ajaxurl,
			data: formData,
			type: 'POST',
			processData: false,
			contentType: false,
	        cache: false,
			success: function (data) {
				console.log(data);
			},
			error: function(data){
				console.log(data);	
			},
		});

	});
	
	
})