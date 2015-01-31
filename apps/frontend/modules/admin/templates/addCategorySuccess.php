<form id="addCategoryForm" redir="<?php echo url_for('admin/manageCategorys'); ?>" action="<?php echo url_for('admin/insertCategory') ?>" method="POST">
  <table>
    <?php echo $form ?>
    <tr>
      <td colspan="2">
        <input type="submit" value="Lägg till kateori"/>
      </td>
    </tr>
  </table>
</form>