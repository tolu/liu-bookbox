<div id="courseListWidget-container">
<?php $i=0; foreach( $courseList as $course): $i++;?>
	<div id="<?php echo $course->getId()?>" redir="<?php echo url_for('teacher/addCourseLitterature'); ?>" class="courseListWidget-item <?php if(($i % 2) == 0){echo "even";}else{echo "odd";}?>">

			<h3><?php echo $course->getId()?></h3> 
			<p><?php echo $course->getCourseName()?></P>

	</div>
<?php endforeach;?>
</div>