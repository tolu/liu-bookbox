<?php use_helper('Javascript') ?>
	<ul>
		<li class='menuTab'><a href="#tab-Category">Kategorier</a></li>
		<li class='menuTab'><a href="#tab-Course">Kurser</a></li>
	</ul>
	
	<div id="tab-Category" class="menuContent">
		<ul>
		<li class="menuItemWithSpaceAfter"><a href="<?php echo url_for($myUserType.'/search?category='); ?>" class='menuItemWithSpaceAfter menuAjaxLink'>Alla kategorier</a></li>
			<?php  
			foreach ($categoryMenuItems as $categoryMenuItem)
			{
				echo "<li><a href='".url_for($myUserType.'/search?category='.$categoryMenuItem->getName())."' class='menuAjaxLink'>".$categoryMenuItem->getName()."</a></li>";  

			}
			?>
		</ul>
	</div>
	
	<div id="tab-Course" class="menuContent">
		<ul>
			<?php  
			foreach ($courseMenuItems as $courseMenuItem)
			{
				echo "<li><a href='".url_for($myUserType.'/search?course='.$courseMenuItem)."' class='menuAjaxLink'>".$courseMenuItem."</a></li>"; 
				
			}
			?>

						
		</ul>
	</div>










