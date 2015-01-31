<form action="<?php echo url_for('teacher/insertCourse') ?>" method="POST">
  <table>
    <?php echo $form ?>
    <tr>
      <td colspan="2">
        <input type="submit" />
      </td>
    </tr>
  </table>
</form>


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
			