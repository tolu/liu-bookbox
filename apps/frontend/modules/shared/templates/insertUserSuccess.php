<?php if($success):?>
  <div><?php echo $hash ?></div>
  <div><?php $this->redirect('public/index?msg='.$msg.' hash: '.$hash) ?></div>
<?php else:?>
  <div><?php $this->redirect('public/index?msg='.$msg) ?></div>
<?php endif;?>

