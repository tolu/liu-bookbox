<?php foreach ($BookList as $bookInfo): ?>

  <div class="ui-widget-content ui-corner-all book" id="<?php echo $bookInfo['book']->getIsbn10() ?>">
    <div class="bookContent">
      <?php echo image_tag("/uploads/books/".$bookInfo["book"]->getIsbn10().".jpg") ?>
      <h3><?php echo $bookInfo["book"]->getTitle() ?></h3>
      
      <!-- book additional details -->
      <div class="bookInfo">
      <div>isbn:<?php echo $bookInfo['book']->getIsbn10() ?></div>
        <div class="authors">Författare:
        
        <?php foreach($bookInfo['authors'] as $author): ?>
          <a class="authorSearchLink" href="<?php echo url_for('shared/search?author='.$author) ?>" title="sök efter fler böcker av författaren">
            <?php echo $author ?>
          </a>
        <?php endforeach; ?>
        
        </div>
        <div class="description"><?php echo $bookInfo['book']->getDescription() ?></div>
      </div>
    </div>
      
    <!-- buttons to display more info and remove from cart -->
    <a href="<?php echo url_for("shared/getPrice") ?>" class="BookDetailsBtn ui-state-default ui-corner-all" title="detaljer">
      <span class="ui-icon ui-icon-info"></span></a>
    <a href="#" title="Remove this item" class="removeIcon ui-state-default ui-corner-all">
      <span class="ui-icon ui-icon-close shoppingCartIcons"></span>
    </a>
     
    <!-- only echo cart icon if user is a student -->
    <?php if($is_a_student): ?>
      <a href="#" class="BookSellerBtn ui-state-default ui-corner-all" title="säljare">
        <span class="booksForSale"><?php echo count($bookInfo['moreInfo']) ?></span>
        <span class="ui-icon ui-icon-cart"></span>
      </a>
    <?php endif; ?>
      
      
    <!-- button to display comments if the user has credentials -->
    <?php if($can_comment): ?>
      <a href="<?php echo url_for('shared/bookComments?isbn10='.$bookInfo['book']->getIsbn10()) ?>" class="BookCommentBtn ui-state-default ui-corner-all" title="kommentarer">
        <span class='ui-icon ui-icon-comment'></span>
      </a>
    <?php endif; ?>

    <!-- additional info about sellers and prices -->
    <div class="bookSellerInfo">
    <?php foreach($bookInfo['moreInfo'] as $moreInfo): ?>
      <div class="bookSeller" isbn="<?php echo $bookInfo['book']->getIsbn10() ?>" id="<?php echo $moreInfo['bookId'] ?>" price="<?php echo $moreInfo['price'] ?>">
        <a href="#" title="lägg till i kundvagnen" class="addToCartFromSellerList ui-state-default ui-corner-all"><span class="ui-icon ui-icon-cart" /></a>
        <div class="ui-icon ui-icon-triangle-1-e"></div>
        <span class="sellersName"><?php echo $moreInfo['seller'] ?></span>
        <span class="sellersPrice"><?php echo $moreInfo['price']?> kr</span>
        <span class="book-quality-bar" value="<?php echo $moreInfo['quality'] ?>" title="bokens skick"></span>
      </div>
    <?php endforeach;?>
    </div>
  </div>
<?php endforeach;?>

<!-- se till att alla böcker blir draggable om man är inloggad-->
<?php if($can_comment): ?>
<script>
  //sätt alla böcker som draggable
  $(".book").draggable({ 
        helper: 'clone',
        opacity: 0.5,
        revert: 'invalid', //revertar bara om man släpper utanför kundvagnen
        distance: 5,
        containment: '#wrapper'
  });
</script>
<?php endif; ?>