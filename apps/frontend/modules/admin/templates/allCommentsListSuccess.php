<h3 class="ui-widget-header ui-corner-all headerSpacing">Alla kommentarer i systemet</h3>
<div id="commentList">
	<?php foreach($commentList as $comment):?>
	
	<div class="ui-widget-content ui-corner-all comment"> 
			<a class='removeCommentBtn ui-state-default ui-corner-all' href="<?php echo url_for('shared/removeComment?commentID='.$comment->getId()); ?>"><span class='ui-icon ui-icon-close'></span></a>
		<a href="<?php echo url_for('student/profile?userID='.$comment->getUser()->getId()); ?>"><?php echo $comment->getUser()->getFname()." ".$comment->getUser()->getLname() ?> </a>
		<p><?php echo $comment->getContent() ?></p> 

	</div>	
	
	<?php endforeach; ?>
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