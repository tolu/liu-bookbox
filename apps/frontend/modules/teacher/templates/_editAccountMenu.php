<?php foreach($menuElements as $menuElement): ?>
	<li>
		<?php echo $menuElement?>
	</li>
<?php endforeach ?>
<li>
	<a href="<?php echo url_for('teacher/profile?userID='.$loggedInId); ?>">Ändra Konto</a>
</li>
<li>
	<a href="<?php echo url_for('teacher/profile?userID='.$loggedInId); ?>#2">Hantera Kurser</a>
</li>


<li class="rightMenuItem">
	<a href="<?php echo url_for('public/logout'); ?>" >Logga ut</a>
</li>