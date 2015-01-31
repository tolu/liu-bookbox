<?php include_component('public','home') ?>

<?php slot('loginBox') ?>
	<div id="loginBox" class="ui-widget-content ui-corner-all widgetInitializer">
  		<h3 class="ui-widget-header ui-corner-all">Inloggning</h3>
			<form action="<?php echo url_for('public/login'); ?>" method="POST">
				<input class="inputFiled" id="myuser" name="username" type="text"/>
				<input class="inputFiled" id="pass" name="pass" type="password"/>
				  	<input  type="submit" value="Logga in"/>
			</form>
          <a href="<?php echo url_for('public/addUser'); ?>" class='addUserBtn ui-state-default ui-corner-all' title='skapa Användare'>
          	<span class='ui-icon ui-icon-plus'></span><span class='ui-icon ui-icon-person'></span><p> skapa användare</p>
          </a>
	</div>
<?php end_slot() ?>

<?php slot('messageBox') ?>
		<?php if(isset($message) && $message != ""):?>
			<div id="messageBox" class="<?php echo $alertClass;?> ui-corner-all widgetInitializer">
				<p>
					<span class="ui-icon ui-icon-alert"></span>
					<strong>Alert:</strong>
					<?php echo $message; ?>
          <?php if($newUserCreated): ?>
            <?php include_component('shared', 'sendMail', array('to'=>$email, 'toName'=>$userName, 'subject'=>'BookBox: Verifiera din e-post', 'message'=>$htmlMsg)) ?>
          <?php endif; ?>
				</p>
			</div>
		<?php endif;?>	
<?php end_slot() ?>








