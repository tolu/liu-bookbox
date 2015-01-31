<?php foreach($menuElements as $menuElement): ?>
	<li>
		<?php echo $menuElement?>
	</li>
<?php endforeach ?>

<li>
	<a href="<?php echo url_for('student/profile?userID='.$loggedInId); ?>">Din profil</a>
</li>
<li>


	<a href="#" id="addbook">Lägg till bok</a>

</li>

<li class="rightMenuItem">
	<a href="<?php echo url_for('public/logout'); ?>" >Logga ut</a>
</li>



<!--TODO addBook should be in shared-->
<!--a form for the add book dialog-->
<div id="addBookDialog" href="<?php echo url_for('shared/getBookInfo'); ?>">
	<form>
			<label for="isbn">ISBN</label>
			<input type="text" name="isbn" id="isbn" value=""/>
      
      <!-- lite hjälptext-->
      <p class="add-book-help">Fyll i bokens isbn och klicka på "getBookInfo"</p>
      
      <!-- dolda element -->
      <div id="hiddenFormElements" class="hidden">
        <?php echo image_tag('/uploads/books/', 'id="bookimage" style="display:none;"'); ?>
        <label for="Title">Titel</label>
        <input type="text" name="title" id="bookTitle"/>
        <label for="Author">Författare</label>
        <input type="text" name="author" id="author"/>
        <label for="Description" class="descr">Beskrivning</label>
        <textarea name="description" id="description" rows="5"  cols="45"> </textarea>
        
        <!--SLIDER FÖR PRISINMATNING-->
        <div class="sliderTag"><label>Ditt pris:</label><div id="priceSlider" style="width:100%;"></div>
          <span class="currentPriceLbl">$0 kr</span>
        </div>
        
        <!--SLIDER FÖR KVALITETSINMATNING-->
        <div class="sliderTag"><label>Bokens Skick:</label><div id="qualitySlider" style="width:100%;"></div>
          <span class="bokens-skick"> 5/10<span>
        </div>
        
        <!--DROP DOWN FÖR KATEGORIVAL-->
        <div>
          <label>Boken tillhör följande kategori</label>
          <select id="setBookCategory" name="category">
            <option value="0">välj en kategori...</option>
            <?php foreach($categories as $category):?>
              <option value="<?php echo $category->getId()?>"><?php echo $category->getName()?></option>
            <?php endforeach;?>
          </select>
        </div>
        
        <!--some links needed for ajax calls-->
        <div id="addBookURL" href="<?php echo url_for('student/addBook'); ?>"></div>
        <div id="addBookForSale" href="<?php echo url_for('student/addBookForSale'); ?>"></div>
      </div>
	</form>
</div>
<!--a info dialog box-->
<div id="infoDialog" title="InfoBox">
	<p style="text-align:center;"></p>
</div>