<div style="float:left;width:508px;" class="ui-widget-header ui-corner-all headerSpacing">
<b style="float:left;"><b>Sökresultat:</b></b>
  <a href="#" class="displayStyleBtn ui-state-default ui-corner-all" title="visa listvy">
    <?php echo image_tag('list-icon.png', 'class="my-display-icon my-list"')?>
  </a>
  <a href="visa ikoner" class="displayStyleBtn ui-state-default ui-corner-all" title="visa ikonvy">
    <?php echo image_tag('thumb-icon.png', 'class="my-display-icon my-thumb"')?>
  </a>
</div>
<div id="searchResult">
  <?php include_component('shared', 'bookList', array('BookList' =>  $BookList)) ?>
</div>

<!--Init book infobox dialog-->
<div id='bookDetailsBox'>
  <?php echo image_tag("ajax-loader.gif", "class='ajax-loader-image' style='display:none;'")?>
  <div id='bookDetails'></div>
</div>