<?php slot('courseListWidget') ?>


	<div id="courseListWidget" class="ui-widget-content ui-corner-all widgetInitializer">
  		<h3 class="ui-widget-header ui-corner-all">Mina kurser</h3>
  		
  		<?php include_component('teacher', 'courseListWidget'); ?>

	</div>
	
<?php end_slot() ?>