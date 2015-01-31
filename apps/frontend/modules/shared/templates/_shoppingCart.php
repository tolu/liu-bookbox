<h3 class="ui-widget-header ui-corner-all">
    <span class='ui-icon ui-icon-cart floatNone'></span>Kundvagn
</h3>
<form method="post" id="shoppingCartForm" action="<?php echo url_for('student/buyBooks')?>">
	
  <div id="checkOutUrl" link="<?php echo url_for('student/checkOutBook')?>"></div>
		
    <div id="shoppingCartContent"><?php include_component('shared', 'populateCart')?></div>
	
  	<!--<input type="submit" value="Rensa"/> -->
    
  	<input  type="submit" value="Köp" class="ui-state-default ui-corner-all"/>
    <span id="priceLabel"></span>
  </form>

