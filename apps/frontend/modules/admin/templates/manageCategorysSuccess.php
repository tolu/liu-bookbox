<h3 class="ui-widget-header ui-corner-all headerSpacing">Hantera Kategorier</h3>
	<a id="addCategoryBtn" class='floatRight ui-state-default ui-corner-all' href="<?php echo url_for('admin/addCategory'); ?>"><span class='ui-icon ui-icon-plus'></span>Lägg till kategori</a>
<div id="categoryList">
	<?php foreach($categoryList as $category):?>
		<div class="ui-widget-content ui-corner-all category">
			<a href="" class="categoryName"><?php echo $category->getName();?></a>
			<a href="<?php echo url_for('admin/removeCategory?categoryId='.$category->getId()); ?>" title="Ta bort denna kategori" class="removeCategoryBtn ui-state-default ui-corner-all">
				<span class="ui-icon ui-icon-close shoppingCartIcons"></span>
			</a>
			
		</div>
	<?php endforeach; ?>
</div>

<?php slot('accountMenu') ?>
	<div id="accountMenu" class="ui-widget-content ui-corner-all widgetInitializer"> 
		<ul>
			<li><b><?php echo $userName; ?></b></li>
				<?php  include_component($userType, 'editAccountMenu') ?>
		</ul>
</div>
<?php end_slot() ?>

<?php slot('rightContentWidgets') ?>
	<?php include_component($userType, 'rightContentWidgets'); ?>
<?php end_slot() ?>