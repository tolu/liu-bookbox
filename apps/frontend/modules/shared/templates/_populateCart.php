<?php for($i=0; $i < count($booksInCart); $i++): ?>
<?php 
    //REFACTOR:  fix title length in action instead of here
    $bookId = $booksInCart[$i]->getID();
    $price = $booksInCart[$i]->getPrice();
    $usr = UserPeer::retrieveByPK($booksInCart[$i]->getSellerId());
    $seller = $usr->getFname().' '.$usr->getLname();
    $isbn = $details[$i]->getIsbn10();
    
    //shorten length of title to fit in shopping cart
    $title = $details[$i]->getTitle();
    if(strlen($title) > 40 )
    {
      $title = substr($title, 0, 40);
      $title .= '...';
    }
?>
<div class="ui-widget-content ui-corner-all bookInList" id="<?php $isbn ?>">
  <div class="bookContent">
    <h3><?php echo $title ?></h3>
    <span class="priceTag"><?php echo $price ?> kr</span>
  </div>
  <!--buttons to display more info and remove from cart-->
  <a href="#" class="BookDetailsBtn ui-state-default ui-corner-all" title="detaljer">
    <span class="ui-icon ui-icon-info"></span></a>
  <a href="#" title="Remove this item" class="removeIcon ui-state-default ui-corner-all populatedByPHP">
      <span class="ui-icon ui-icon-close shoppingCartIcons"></span></a>
  <!--additional info about sellers and prices-->
  <div class="bookSellerInfo">
    <div class="bookSeller" isbn="<?php echo $isbn ?>" id="<?php echo $bookId ?>" price="<?php echo $price ?>">
      <a href="#" class="addToCartFromSellerList ui-state-default ui-corner-all">
        <span class="ui-icon ui-icon-cart"></span>
      </a>
      <span class="ui-icon ui-icon-triangle-1-e"></span>
      Säljs av: <?php echo $seller ?> För: <?php echo $price ?> kr
    </div>
  </div>
</div>
<?php endfor; ?>