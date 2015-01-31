<?php if($searchType == "ENTER"): ?>
  <div id="searchResult">
    <h3 class="ui-widget-header ui-corner-all headerSpacing">Sök resultat:</h3>
    <?php  include_component('shared', 'bookList', array('BookList' =>  $BookList)) ?>
  </div>
<?php else: ?>
  <ul>
	<?php $i=0;foreach($BookList as $book): $i++;?>
		<li class="<?php if(($i % 2) == 0){echo "even";}else{echo "odd";}?>">
			<a id="<?php echo $book->getIsbn10() ?>" class="searchFieldItem" href="<?php echo url_for($userType.'/searchFieldResult')?>">
				<?php echo subStr($book->getTitle(),0,25); if(strlen($book->getTitle())>=25){echo "..";} ?>
			</a>
		</li>
	<?php endforeach; ?>
</ul>
<?php endif; ?>


