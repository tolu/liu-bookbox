<div id="userSellList">
	<?php  foreach($myBooks as $myBook):?>
    <!-- definiera några variabler -->
    <?php $title = $myBook->getBook()->getTitle(); $id = $myBook->getId();  
    $price = $myBook->getPrice(); $upDays = floor((date('U')-$myBook->getAddedOn('U'))/86400); ?>
    <div id="<?php echo $id?>" class="my-book-for-sale ui-widget-content ui-corner-all" price="<?php echo $price ?>" title="<?php echo $title ?>">
      <span class="my-title"><?php echo $title ?></span>
      <span class="my-price"><?php echo $price ?> kr</span>
      <span class="up-days">Boken har varit upplagd i <?php echo $upDays ?> dagar</span>
      <a href="<?php echo url_for('student/editMyBookPrice?id='.$id);?>" class="ui-state-default ui-corner-all edit-price-btn">ändra pris</a>
      <a href="<?php echo url_for('student/removeBookforsale?id='.$id);?>" class="ui-state-default ui-corner-all remove-book-btn">ta bort</a>
    </div>
  <?php endforeach; ?>
</div>