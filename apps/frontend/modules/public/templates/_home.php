<div id="searchResult" style="float:left; width:100%;">
<h3 class="ui-widget-header headerSpacing ui-corner-all">Nyast upplagda böcker till salu</h3>
  <?php
    include_component('shared','bookList', array('BookList'=>$newlyAddedBooks));
  ?>
</div>

<div style="float:left; width:100%;">
<h3 class="ui-widget-header headerSpacing ui-corner-all">Böcker som aldrig legat i en kundvagn</h3>
  <?php
    include_component('shared','bookList', array('BookList'=>$possibleBargains,'dontShowInfoBox'=>'true'));
  ?>
</div>

<div style="float:left; width:100%;">
<h3 class="ui-widget-header headerSpacing ui-corner-all">Böcker som köpts flest gånger</h3>
  <?php
    include_component('shared','bookList', array('BookList'=>$popularSales,'dontShowInfoBox'=>'true'));
  ?>
</div>

<!--Init book infobox dialog-->
<div id='bookDetailsBox'>
  <?php echo image_tag("ajax-loader.gif", "class='ajax-loader-image' style='display:none;'")?>
  <div id='bookDetails'></div>
</div>
<script>
  $('#bookDetailsBox').dialog({
    title: 'Book details',
    bgiframe: true,
    autoOpen: false,
    width: 380,
    modal: true,
    position: ['center', 50]
  });
</script>