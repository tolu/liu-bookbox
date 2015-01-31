
	<div id="profileContent">
		<h3><a href="#1" name="1">Profil</a></h3>
		<div id="profilePersonalInfo">
			<?php	include_partial('teacher/profileContent', array('user'=> $user, 'editable'=>$editable,'loggedInId'=>$loggedInId));  ?> 	
		</div>
<!--
		<h3><a href="#2" name="2">Kurser</a></h3>
		<div id="profileCourseInfo">
			<?php include_component('teacher', 'courseList'); ?>

		</div>
		-->
		<h3><a href="#2" name="2">Kurslitteratur</a></h3>
		<div id="profileCourseLitterature">
			<?php include_component('teacher', 'courseLitteratureList'); ?>

		</div>


		
	</div>

<?php slot('accountMenu') ?>
	<div id="accountMenu" class="ui-widget-content ui-corner-all widgetInitializer"> 
		<ul>
			<li><b><?php echo $userName;?></b></li>
			<?php  include_component($userType, 'editAccountMenu') ?>
		</ul>
	</div>
<?php end_slot() ?>

<?php slot('rightContentWidgets') ?>
	<?php include_component($userType, 'rightContentWidgets'); ?>
<?php end_slot() ?>