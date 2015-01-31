<div id="categoryListWidget-container">
<?php $i=0; foreach( $categoryList as $category): $i++;?>
	<div id="<?php echo $category->getId()?>" redir="<?php echo url_for('admin/AddBookToCategory'); ?>" class="categoryListWidget-item <?php if(($i % 2) == 0){echo "even";}else{echo "odd";}?>">

			<h3><?php echo $category->getName()?></h3> 

	</div>
<?php endforeach;?>
</div>

