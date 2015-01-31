<?php include_component('public', 'home') ?>

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
