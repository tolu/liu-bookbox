
	<div id="profileContent">
		<h3><a href="#1" name="1">Din profil</a></h3>
		<div id="profilePersonalInfo">
      <?php	include_partial('student/profileContent', array('user'=> $user, 'editable'=>$editable,'loggedInId'=>$loggedInId));  ?>
		</div>

		<h3><a href="#2" name="2">Dina upplagda böcker</a></h3>
		<div>
			<div class="spacerElement">
        <?php include_component('student', 'userSellList') ?>
      </div>
		</div>
    
    <h3 ><a href="#3" name="4">Böcker som du köpt</a></h3>
		<div>
			<div class="spacerElement">
				<?php include_component('student', 'userBoughtList') ?>
			</div>
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