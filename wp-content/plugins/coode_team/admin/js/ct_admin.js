
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


$(function(){
	
	$('#customUploadPanel').off().on('click', '#newCardButton',function(){
		createNewTeamCard();
	});
	

})