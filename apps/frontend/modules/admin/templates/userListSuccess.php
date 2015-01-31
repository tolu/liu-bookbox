<h3 class="ui-widget-header ui-corner-all headerSpacing">Hantera användare</h3>

<?php foreach($userList as $user):?>
	<div class="ui-widget-content ui-corner-all userInformation">
		<a href="<?php echo url_for("student/profile?userID=".$user->getId()); ?>"><h4><?php echo $user->getFname()." ".$user->getLname();?></h4><span>id: <?php echo $user->getId();?></span>
		<p><?php echo $user->getEmail();?></p></a>
		<a class='removeUserBtn ui-state-default ui-corner-all' href="<?php echo url_for("admin/removeUser?userID=".$user->getId()); ?>"><span class='ui-icon ui-icon-close'></span></a>
	</div>
	

<?php endforeach; ?>

<?php slot('accountMenu') ?>
	<div id="accountMenu" class="ui-widget-content ui-corner-all widgetInitializer"> 
		<ul>
			<li><b><?php echo $userName; ?></b></li>
				<?php  include_component($userType, 'editAccountMenu') ?>
		</ul>
</div>
<?php end_slot() ?>

<?php slot('rightContentWidgets') ?>
	<?php include_component($userType, 'rightContentWidgets'); ?>
<?php end_slot() ?>