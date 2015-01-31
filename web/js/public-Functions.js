$(function() {

  //init infobox
	$('#infoBox').dialog({
			bgiframe: true,
			autoOpen: false,
      position: ['center', 20],
			width:    400
  });

  //show info about sellers
  $('.addUserBtn').live("click", function() {
    //hade ett problem med att loaden kördes två gånger vid varje click vilket var segt
    //därför lade jag till denna kontrollen om dialogrutan redan är öppen...
    if($('#infoBox').dialog('isOpen'))
    {
      return false;
    } else {
    
      var pathToForm = $(this).attr("href");
      $('#infoBoxContent').load(pathToForm);
      
      $('#infoBox').dialog('option', 'title', 'Skapa användare');
      $('#infoBox').dialog('open');
                
      return false;
    }
  });
	
  // open dialog when admin clicks button
  $('#handleUsers').click( function () { 

      var pathToForm = $(this).attr("href");
            
      $('#infoBoxContent').load(pathToForm);
      $('#infoBox').dialog('option', 'title', 'Hantera användare');
      $('#infoBox').dialog('open');
              
    return false;
  });
		
});