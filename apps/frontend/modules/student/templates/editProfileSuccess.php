<script type='text/javascript' src="/<?php include_component('shared', 'getProjectName') ?>/web/js/profile-Functions.js"></script>

<form id="updateUserForm" method="POST" redir="<?php echo url_for('student/profileContent?userID='.$user->getId()) ?>" action="<?php echo url_for('shared/updateUser') ?>">

			<h1 class="spacerElement"><?php echo $user->getFname()." ".$user->getLname() ;?></h1>
			
			<div class="spacerElement">
			<table id="editTable">
			<tr>
				<th><label for="adress">Adress: </label></th><td><input type="text" name="adress" id="adress" value="<?php echo $user->getStreet();?>"/></td>
			</tr>
			<tr>
			 <th> <label for="city">Stad: </label></th><td><input type="text" name="city" id="city" value="<?php echo $user->getCity();?>"/>
			  </td></tr>
			<tr>
			  <th><label for="postalcode">Postnummer: </label></th><td><input type="text" name="postalcode" id="postalcode" value="<?php echo $user->getPostalCode();?>"/></td>
			  </tr>
			<tr>
				<th><label for="email">E-mail: </label></th><td><input type="text" name="email" id="email" value="<?php echo $user->getEmail();?>"/></td>
			</tr>
			<tr>
			<tr><th></th><td><label for="adress">Uppdatera lösenord </label></td></tr>
			<tr>
				<th><label for="adress">Lösenord: </label></th><td><input type="password" name="currPass" id="currPass" value=""/></td>
			</tr>
						<tr>
				<th><label for="adress">Nytt Lösenord: </label></th><td><input type="password" name="newPass" id="newPass" value=""/></td>
			</tr>
						<tr>
				<th><label for="adress">Upprepa nytt Lösenord: </label></th><td><input type="password" name="reNewPass" id="reNewPass" value=""/></td>
			</tr>
			
			
			<?php if($userType == "admin"): ?>
			<tr>
			
			
			<th><label for="credential">Användartyp: </label></th>
			<td>

				<select type="text" name="credential" id="credential">
	  				<option value="student" <?php if($user->getCredentials() =="student"){echo("selected='selected'");}?> >student</option>
	  				<option value="teacher" <?php if($user->getCredentials() =="teacher"){echo("selected='selected'");}?> >teacher</option>
	 				<option value="admin" <?php if($user->getCredentials() =="admin"){echo("selected='selected'");}?> >admin</option>
				</select>
			</td>
			
			
			
			
			</tr>
			<?php endif; ?>
			
			
			<th></th>
			<td>
			<input type="hidden" name="userID" id="userID" value="<?php echo $user->getId();?>"/>
			<input type="submit" class="floatRight" value="Spara"/></td>
			</tr>
			</table>
			</div>
			
			</form>

