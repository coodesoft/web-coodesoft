<?php

function the_team_card($card){ ?>
<div id="myModal"></div>
	<div class="col-sm-6 col-12 card-container card-stored">
	<form enctype="multipart/form-data" data-uid="<?php echo $card['member_id'] ?>">
		<div class="card">
			<div class="card-header">
				<div class="col-12">
					<img class="card-img-top" src="<?php echo TEAM_PHOTOS_URL."/".get_file_name($card['img_path'])?>" alt="Card image cap">
				</div>
			</div>
			<div class="card-body">
				<div class="form-group">
					<input type="file" class="form-control-file" id="photoInput" name="photo" disabled>
				</div>
				<div class="form-group">
					<label for="nameInput">Nombre</label>
					<input type="text" class="form-control" id="nameInput" name="TeamMember[name]" disabled value="<?php echo $card['name']?>">
				</div>
				<div class="form-group">
					<label for="emailInput">Email</label>
					<input type="email" class="form-control" id="emailInput" placeholder="Correo electrónico" name="TeamMember[email]" value="<?php echo $card['mail']?>" disabled>
				</div>
				<div class="form-group">
					<label for="linkedinINput">Linkedin</label>
					<input type="text" class="form-control" id="linkedinINput" placeholder="Usuario de Linkedin" name="TeamMember[linkedin]" value="<?php echo $card['linkedin']?>" disabled>
				</div>
				<div class="form-group">
					<label for="freelancerInput">Freelancer</label>
					<input type="text" class="form-control" id="freelancerInput" placeholder="Usuario de Freelancer" name="TeamMember[freelancer]" value="<?php echo $card['freelancer']?>" disabled>
				</div>
			</div>

			<div  class="card-footer" style="text-align: center">
				<button type="button" class="delete-card btn btn-dark">Eliminar</button>
				<button type="submit" class="save-card btn btn-dark" disabled>Guardar</button>
			</div>
		</div>
	</form>
	</div>
<?php } ?>
