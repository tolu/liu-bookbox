<!-- <h3 class="ui-widget-header ui-corner-all ">Sökfält</h3> -->
<form id="searchForm" action="<?php echo url_for($module.'/searchFieldResult'); ?>">
Sök: <input id="searchFieldInput" type="text" AUTOCOMPLETE="OFF" />
</form>
<div><span id="searchFieldResultClearBtn"  class="ui-icon ui-icon-circle-close "></span></div>


<div id="searchFieldResult">


</div>


