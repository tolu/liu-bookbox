<form id="addUserForm" action="<?php echo url_for('shared/insertUser') ?>" method="POST">
  <table>
	<tr>
	
	    <?php echo $form['Fname']->renderRow(array('class' => 'required')) ?>
	    <?php echo $form['Lname']->renderRow(array('class' => 'required')) ?>
	 	<?php echo $form['email']->renderRow(array('class' => 'vemail required')) ?>
	 	<?php echo $form['phone']->renderRow() ?>
	 	<?php echo $form['street']->renderRow(array('class' => 'required')) ?>
	 	<?php echo $form['city']->renderRow(array('class' => 'required')) ?>
	 	<?php echo $form['postalcode']->renderRow(array('class' => 'required')) ?>
	 	<?php echo $form['pass']->renderRow(array('class' => 'required')) ?>
	 	<?php echo $form['repass']->renderRow(array('class' => 'required')) ?>
	</tr>
    <tr>
      <td colspan="2">
        <input id="userFormSendBtn" type="submit" />
      </td>
    </tr>
  </table>
</form>


