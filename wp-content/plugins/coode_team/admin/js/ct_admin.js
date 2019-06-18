
(function($){

	let base_path = '/web-coodesoft';

	let createNewTeamCard = function(){
		var response;
		$.ajax({
			type: "GET",
			url: base_path+'/wp-content/plugins/coode_team/admin/templates/team_card.html',
			success : function(data){
				$('#coodeCardContainer>div').prepend(data);
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


	$('#coodeTeamPanel').off().on('click', '#newCardButton',function(){
		createNewTeamCard();
	});

	$('#coodeTeamPanel').on('click', '.delete-card', function(){
		let parent = $(this).closest('.card-container');
		let form = parent.find('form');

		if( $(form).attr("data-uid") && $(form).attr("data-uid")>0){

			let toDelete = {
				'uid': $(form).attr("data-uid"),
				'action': 'ct_delete_team_card',
			};

			$.ajax({
				url: ajaxurl,
				data: toDelete,
				type: 'POST',
				success: function (data){
					data = JSON.parse(data);
					if ( data['result'] )
						parent.remove();
					else
						console.log(data);
				},
				error: function (data){
					console.log(data);
				},
			});
		} else
			parent.remove();
	});


	$('#coodeTeamPanel').on('change', '.form-control-file', function() {
		let img = $(this).closest('.card-container').find('.card-img-top');
		preloadImage(this, img);
	});

	$('#coodeTeamPanel').on('submit', 'form', function(e){
		e.preventDefault();
		e.stopPropagation();

		let form = $(this); // You need to use standard javascript object here
		let formData = new FormData(form[0]);
		formData.append("action", "ct_create_team_card");

		$.ajax({
				url: ajaxurl,
				data: formData,
				type: 'POST',
				processData: false,
				contentType: false,
		        cache: false,
				success: function (data) {
					data = JSON.parse(data);
					let classname = 'alert-' + data['status'];
					$('.ct_result').addClass(classname);
					$('.ct_result').removeClass('d-none');
					$('.ct_result').html(data['msg']);

					if (data['uid']>0){
						form.attr('data-uid', data['uid']);
						form.find('input').attr('disabled', 'true');
						form.find('.card').addClass('border border-success');
					}

					setTimeout(function(){
						$('.ct_result').removeClass(classname);
						$('.ct_result').addClass('d-none');
						$('.ct_result').empty();
					}, 3000);
				},
				error: function(data){
					console.log(data);
				},
		});

	});



})(jQuery)
