<?php if($editable): ?>
	<a id="addCourseBtn" class='profileAjaxLink floatRight ui-state-default ui-corner-all' href="<?php echo url_for("teacher/addCourse");?>"><span class='ui-icon ui-icon-plus'></span>Lägg till kurs</a>
	<ul class="courseLitteratureList">
<?php endif;?>

<?php foreach( $courseList as $course):?>
	<li class="ui-widget-header ui-corner-all headerSpacing">
			<a href = "<?php echo url_for($myUserType.'/search?course='.$course->getId()) ;?> ">
				<span class="courseCode" id="<?php echo $course->getId() ?>"><?php echo $course->getId() ?></span> 
				- <?php echo $course->getCourseName()?> 
			</a>
				<?php if($editable): ?>
		<div class="courseList-icon">
			<a href="<?php echo url_for('teacher/removeCourse?courseCode='.$course->getId()) ?>" title="Ta bort denna kurs" class="removeableListItem ui-state-default ui-corner-all">
				<span class="ui-icon ui-icon-close shoppingCartIcons"></span>
			</a>
			</div>
		<?php endif;?>
	</li>
	<?php $i=0; foreach( $courseLitteratureList[$course->getId()] as $courseLitterature): $i++;?>
		<li class="<?php if(($i % 2) == 0){echo "even";}else{echo "odd";}?> courseLitteratureListItem">
				<a href = "">
					<?php echo $courseLitterature->getBook()->getTitle()?> 
				</a>
			
			<?php if($editable): ?>
				<div class="courseList-icon">
					<a href="<?php echo url_for('teacher/RemoveCourseLitterature?courseLitteratureId='.$courseLitterature->getId()) ?>" title="Ta bort denna bok" class="removeableListItem ui-state-default ui-corner-all">
						<span class="ui-icon ui-icon-close shoppingCartIcons"></span>
					</a>
				</div>
			<?php endif;?>
		</li>
	
	<?php endforeach;?>
	
<?php endforeach;?>
</ul>