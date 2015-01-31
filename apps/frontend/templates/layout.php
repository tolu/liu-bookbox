<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />  
  </head>
  <body>
  <?php  include_component('shared', 'initializeInfoBox') ?>
  <div id="spacer">
	<div id="wrapper">
		<div id="header">
		
			<div id="searchField">
				<?php  include_component('shared', 'searchField', array('module' =>  $this->getModuleName())) ?>
			</div>
		
		</div>
		
		<?php if (has_slot('messageBox')): ?>
 			<?php include_slot('messageBox') ?>
		<?php endif; ?>
		
		<?php if (has_slot('accountMenu')): ?>
 			<?php include_slot('accountMenu') ?>
		<?php endif; ?>
		

		
		<div id="menu" class="widgetInitializer">
			<?php  include_component('shared', 'menuItems', array('module' =>  $this->getModuleName())) ?>
		</div>
    
		<div id="content" class="ui-widget-content ui-corner-all">
      <?php echo $sf_content ?>
    </div>
		
    <div id="rightSidebar">
<!--
			<div id="searchField" class="ui-widget-content ui-corner-all widgetInitializer">
				<?php echo" ";//  include_component('shared', 'searchField', array('module' =>  $this->getModuleName())) ?>
			</div>
	-->		
			<?php if (has_slot('loginBox')): ?>
 				 <?php include_slot('loginBox') ?>
			<?php endif; ?>
			
			
			<?php if (has_slot('rightContentWidgets')): ?>
 				 <?php include_slot('rightContentWidgets') ?>
			<?php endif; ?>
			
			
			
			<?php if (has_slot('shoppingCart')): ?>
 				 <?php include_slot('shoppingCart') ?>
			<?php endif; ?>
			
			<?php if (has_slot('courseListWidget')): ?>
 				 <?php include_slot('courseListWidget') ?>
			<?php endif; ?>
						
			<?php if (has_slot('categoryListWidget')): ?>
 				 <?php include_slot('categoryListWidget') ?>
			<?php endif; ?>
			
		</div>
		<div id="footer"><?php  include_component('shared', 'footerContent') ?></div>
	</div>
  <?php echo image_tag('ajax-loader.gif','id="ajaxLoaderImage" style="display:none;"')?>
</div>
  
    
    
  </body>
</html>
