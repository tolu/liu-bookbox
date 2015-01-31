
	$(function() {

		var openAccord = 0;
		var anchorValue ="";
		var thisUrl = document.location;
		var strippedUrl = thisUrl.toString().split("#");
		openAccord = parseInt(strippedUrl[1]) -1;

		$("#profileContent").accordion({
			collapsible: true,
			autoHeight: false,
			active: openAccord
		});
    
    /*********************************************/
    /* visa dialogruta för att editera bokpriset */
		/*********************************************/
    $('.edit-price-btn').live('click', function(){
      var price = parseInt($(this).parent().attr('price'));
      var title = $(this).parent().attr('title');
      var id = $(this).parent().attr('id');
      var editPriceUrl = $(this).attr('href');
      
      var maxPrice = price+50;
      var halfprice = maxPrice/2;
      $('#infoBoxContent').html('<div class="change-book-price"></div>');
      $('#infoBoxContent .change-book-price').append('<strong>'+title+'</strong>');
      $('#infoBoxContent .change-book-price').append('<div id="slider"></div>');
      $('#infoBoxContent .change-book-price').append('<span id="price-lbl" class="currentPriceLbl"> '+halfprice+' kr</span>');
      $('#infoBoxContent .change-book-price').append('<button class="ui-state-default ui-corner-all">spara</button>');
      $('#infoBoxContent .change-book-price').append('<p>Dra i slidern tills du är nöjd och klicka på spara, så uppdateras priset</p>');
      $('#slider').slider({
        range:'min', 
        value:halfprice, 
        min:0, 
        max:maxPrice,
        step:10,
        slide: function(event, ui){
          $('#price-lbl').html(' ' + ui.value + ' kr');
        }
        });
      
      $('#infoBoxContent button').click(function(){
        $('#ajaxLoaderImage').clone().show().appendTo($('#infoBoxContent'));
        $.post(editPriceUrl, {newPrice: $('#slider').slider('option', 'value') }, function(){
          
          $('#infoBox').dialog('close');
          $('#'+id).find('.my-price').html($('#slider').slider('option', 'value')+' kr');
          $('#'+id).effect('highlight',{}, 2000);
        });
        return false;
      });
      
      $('#infoBox').dialog('open');
      return false;
    });
    
    /***************************************************************/
    /* funktion för att ta bort böcker som man själva har lagt upp */
    /***************************************************************/
    $('.remove-book-btn').live('click', function(){
      if(confirm('Vill du verkligen ta bort boken?'))
      {
        var id = $(this).parent().attr('id');
        $.post($(this).attr('href'), {}, function(){
          $('#'+id).effect('blind', {}, 1000);
        });        
      }
      return false;
    });
		
		//updates the parent container of the a-tag with the href content 
		$(".profileAjaxLink").click( function(){
			var parentContainer = $(this).parent().attr("id");
			$("#"+parentContainer).load($(this).attr("href"));
			return false;

		});
		
		$("#updateUserForm").submit( function(e){
			
			 //add the post variables
			$("#profilePersonalInfo").load($(this).attr("action"), {
				'street': $("#adress").val(), 
				'city': $("#city").val(),
				'postalcode': $("#postalcode").val(),
				'email': $("#email").val(),
				'userID': $("#userID").val(),
				'currPass': $("#currPass").val(),
				'newPass': $("#newPass").val(),
				'reNewPass': $("#reNewPass").val(),
				'credential': $("#credential option:selected").val()
				
				});

			$("#profilePersonalInfo").load($(this).attr("redir"));
			return false;

		});
		
		$(".removeableListItem").click( function(){
			if(confirm("Vill du verkligen ta bort dett objekt?"))
			{
				var removePath = $(this).attr("href");
				$(this).parent().parent().fadeTo("slow", 0.33);
				$(this).parent().append("<span>Item removed</span>");
				$.get(removePath);
				$(this).remove();
			}
			
			
			return false;

		});


//----admin stuff, move to seperate file !

		$(".removeUserBtn").click( function(){
			if(confirm("Vill du verkligen ta bort användaren?"))
			{
				var removePath = $(this).attr("href");
				$(this).parent().fadeTo("slow", 0.33);
			//	$(this).parent().append("<span>Borttagen</span>");
				$.get(removePath);
				$(this).remove();
			}
			
			return false;

		});

	});
	
	