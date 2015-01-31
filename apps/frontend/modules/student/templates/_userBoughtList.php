<div id="userBoughtList">
  <?php for( $i = 0; $i < $nr; $i++ ): ?>
    <div class="my-bought-book ui-widget-content ui-corner-all">
      <span class="bought-title"><?php echo $myBooks[$i]->getBook()->getTitle() ?></span>
      <span class="bought-price"><?php echo $myBooks[$i]->getPrice() ?> kr</span>
      <span class="bought-on">Köpdatum: <?php echo $myBooks[$i]->getSoldOn('Y-m-d') ?></span>
      <span class="bought-from">Säljare: <?php echo $sellerNames[$i] ?></span>
    </div>
  <?php endfor; ?>
</div>
