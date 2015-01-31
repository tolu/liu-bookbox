<h3 class="ui-widget-header ui-corner-all headerSpacing">Alla böcker som är till salu i systmet</h3>
<div id="searchResult">			
			<?php  include_component('shared', 'bookList', array('BookList' =>  $BookList)) ?>
</div>

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