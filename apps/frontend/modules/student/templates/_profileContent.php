
			<h1 class="spacerElement"><?php echo $user->getFname()." ".$user->getLname() ;?></h1>
			
      <?php if($editable): ?>
				<a href="<?php echo url_for('student/editProfile?userID='.$user->getId());?>"  id="editProfileBtn" class="profileAjaxLink floatRight ui-state-default ui-corner-all"><span class='ui-icon ui-icon-wrench'></span>Ändra</a>
			<?php endif;  ?>
      
			<div class="spacerElement">
				<p class="editableProfileElement">Adress: <?php echo $user->getStreet();?> </p>
				<p class="editableProfileElement"><?php echo $user->getPostalCode();?> <?php echo $user->getCity();?></p>
				<p class="editableProfileElement">E-mail: <?php echo $user->getEmail();?></p>
				<p class="editableProfileElement">Senast Inloggad: <?php echo $user->getLastLogin();?></p>
			</div>

