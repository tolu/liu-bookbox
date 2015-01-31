

<div id="commentField" class="ui-widget-content ui-corner-all">
	<h3>Kommentera</h3>
	<form id="commentFieldForm" name="commentFieldForm" redir="<?php echo url_for('shared/bookComments?isbn10='.$isbn10)  ?>" action="<?php echo url_for('shared/addBookComment?isbn10='.$isbn10); ?>">
		<textarea id="commentContent" name="commentContent"></textarea>
		<input type="submit" value="Kommentera"/>
	</form>
	
</div>


<div id="commentList">
	<?php foreach($commentList as $comment):?>
	
	<div class="ui-widget-content ui-corner-all comment">
			<?php if($user == $comment->getUser()->getId() || $userType == "admin"):?> 
			<a class='removeCommentBtn ui-state-default ui-corner-all' href="<?php echo url_for('shared/removeComment?commentID='.$comment->getId()); ?>"><span class='ui-icon ui-icon-close'></span></a>
			<?php endif;?>
		<a href="<?php echo url_for('student/profile?userID='.$comment->getUser()->getId()); ?>"><?php echo $comment->getUser()->getFname()." ".$comment->getUser()->getLname() ?> </a>
		<p><?php echo $comment->getContent() ?></p> 

	</div>	
	
	<?php endforeach; ?>
</div>