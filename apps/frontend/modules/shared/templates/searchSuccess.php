<?php include_component('shared', 'searchResult', $query) ?>

<?php if($userType == 'student' ||  $userType == 'teacher'):?>
  <?php slot('rightContentWidgets') ?>
    <?php include_component($userType, 'rightContentWidgets'); ?>
  <?php end_slot() ?>
<?php endif;?>

<?php if($userType != ''):?>
  <?php slot('accountMenu') ?>
  <div id="accountMenu" class="ui-widget-content ui-corner-all widgetInitializer"> 
    <ul>
      <li><b><?php echo $userName; ?></b></li>
      <?php  include_component($userType, 'editAccountMenu') ?>
    </ul>
  </div>	
  <?php end_slot() ?>
<?php endif;?>
