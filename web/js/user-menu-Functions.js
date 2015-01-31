	$(function() {
		
		/* ADD BOOK FUNCTIONALITY */
		/**************************/
		
		// store fields in arrays for easy tömning =)
		var allInputFields = $([]).add('#author').add('#bookTitle').add('#description').add('#price').add('#isbn');
		var allOtherFields = $([]).add('#bookimage');
		var getBookInfoUrl = $('#addBookDialog').attr('href');
		var addToBookDbUrl = $('#addBookURL').attr('href');
		var addBookForSaleUrl = $('#addBookForSale').attr('href');
		
		//trixa lite för att få fram path till upload dir
		var imageDir = $('#bookimage').attr('src');
    if(imageDir)
    {
      var x = new Array();
      x = imageDir.split('.'); //dela upp orginalsträngen
      imageDir = x[0];         //använd bara den vettiga delen
    }
		
		// open dialog when user clicks button
		$('#addbook').click( function () {
      $('.add-book-help').show();
      $('#addBookDialog').dialog('option', 'title', 'Lägg upp bok till försäljning');
			$('#addBookDialog').dialog('open');
			$('.ajax-loader-image').hide();
      clearForm();
			return false;
		});
		
		//initiate info dialog boc
		$('#infoDialog').dialog({
			bgiframe: true,
			autoOpen: false,
			height:   100,
			width:    200
		});
    
    //initialize quality slider
    $("#qualitySlider").slider({
      range:"min",
      value:5,
      min: 0,
      max: 10,
      step: 1,
      slide: function(event, ui) {
        $(".bokens-skick").html(' ' + ui.value+'/10');
      }
    });
    
    //initialize quality slider
    $("#priceSlider").slider({
      range:"min",
      value:0,
      min: 0,
      max: 100,
      step: 10,
      slide: function(event, ui) {
				$(".currentPriceLbl").html('$' + ui.value+' kr');
			}
    });
		
		// initiate the dialog
		$('#addBookDialog').dialog({
      bgiframe: true,
      autoOpen: false,
      width:  350,
      position: ['center',55],
      modal: true,
      overlay: {
        backgroundColor: '#000',
        opacity: 0.5
      },
      buttons: {
        GetBookInfo: getBookInfo,
        ClearFields: clearForm,
        AddBookForSale: addBookForSale
      }
    });
    
    //*********************************************
    //hide all input elements and remove user input
    //*********************************************
    function clearForm(){
      //nollställ labels för kvalitet och pris
      $('.sliderTag').find('.currentPriceLbl').html('$0 kr');
      $('.sliderTag').find('.bokens-skick').html(' 5/10');
     $('#priceSlider').slider('option', 'value', 0);
     $('#qualitySlider').slider('option', 'value', 5);
      
      $('.add-book-help').show();
      allInputFields.val( '' );
      allOtherFields.html( '' );
      $('#bookimage').attr( {src: imageDir } );
      $('#bookimage').hide();
      $('#hiddenFormElements').addClass('hidden');
      $('#qualitySlider').slider('option', 'value', 5);
      
      //make addBtn un-clickable
      $('button:contains("AddBookForSale")').attr('disabled', 'disabled').css('color', '#91b0d4');
      
      //remove error state style
      $('#addBookDialog input').removeClass('ui-state-error');
    }
    
    //************************
    // close dialog
    //************************
    function closeDialog(){
      $('#addBookDialog').dialog('close');
      $('#qualitySlider').slider('option', 'value', 5);
      $('.add-book-help').show();
    }
    
    //***************************
    //get book info button click
    //***************************
    function getBookInfo()
    {
      $('.add-book-help').hide();
      //show loader bar!
      $('#getBookInfoErrorField').html( $('#ajaxLoaderImage').clone().show() );
      $('#addBookDialog p img').css({ 'margin-left': '13em' });
      
      //reset slider value
      $('#qualitySlider').slider('option', 'value', 5);
      
      //get the value entered as isbn
       var isbn = $('#isbn').attr('value');
      
      //get book info via database, or adlibris if its not in the db
      $.post(getBookInfoUrl, { isbn : isbn, editable: 'true' }, processBookInfo, "json");
    }
    
    //***************************************
    //add book to Booksforsale database table
    //***************************************
    function addBookForSale()
    {
      //get isbn and price info
      var isbn = $('#isbn').attr('value');
      var price = $('#priceSlider').slider('option', 'value');
      
      //get the category id related to the book by the user
      var categoryId = $('#setBookCategory option:selected').val();
      
      /* save the book quality in a variable */
      var kvalitet = $("#qualitySlider").slider("value");
      
      if(checkInputFields())
      {    
        //open info dialog with ajax loader animation
        $('#ajaxLoaderImage').clone().appendTo('#infoDialog p');
        $('#infoDialog').find('#ajaxLoaderImage').show();
        $('#infoDialog').dialog('open');
        
        //add book for sale and give some response to the user
        $.post(addBookForSaleUrl, {isbn10 : isbn, salePrice : price, quality : kvalitet, kategori : categoryId }, function( info ){
            $('#infoDialog p').html(info.info);
        }, "json");
        
        //clear the fields, close dialog
        clearForm();
        closeDialog();
      } else {
        $('#addBookDialog').dialog('option', 'title', 'Var vänlig och fyll i alla fält');
      }
    }
    
    //*******************************************
    //   check that all fields are filled
    //*******************************************
    function checkInputFields()
    {
      var flag = true;
      // isbn bookTitle author price
      $('#addBookDialog input').each(function(){
        //remove possible error fields
        $(this).removeClass('ui-state-error');
        
        if(this.value.length<2)
        {
          //add error class if text length is insufficient
          $(this).addClass('ui-state-error');
          flag = false;
        }
      });
      
      return flag;
    }
    
    //*******************************************
    //process data retrieved from db or adlibris
    //*******************************************
    function processBookInfo(data){
    
      //check if the book was found
      if( data.success == 'true' ) {
          //leave some response to the user
          $('#addBookDialog').dialog('option', 'title', data.info);
          
          //add book to database if it wasnt in there already
          if( data.info != 'foundInDB' ){
                $.post(addToBookDbUrl, {isbn10 : data.isbn10, isbn13 : data.isbn13, authors : data.authors, 
                title : data.title, imgUrl : data.imgUrl, description : data.description} );
          }
          //fill the form with info
          $('#author').val(      data.authors);
          $('#bookTitle').val(   data.title );
          $('#description').val( data.description );
          if( data.info == 'foundInDB' ){
              $('#bookimage').attr( {src: imageDir+data.imgUrl} );
          } else {
              $('#bookimage').attr( {src: data.imgUrl} );
          }
          
          //set a slider with value 0 -> adlibris price
          $.post('/bookbox/web/shared/getPrice', { isbn:data.isbn10 }, function(price){
            var pris = parseInt(price.price);
            if(pris == -1){ pris = 1000; }
            $("#priceSlider").slider('option', 'max', pris);
          }, 'json');
          
          //show the info
          $('#hiddenFormElements').removeClass('hidden');
          $('#bookimage').show();
      } else {
          //leave response to user
          $('#addBookDialog').dialog('option', 'title', data.info + '<br/>Var vänlig och fyll i informationen själv');
          //clear the fields
          allInputFields.val( '' );
          allOtherFields.html( '' );
          $('#bookimage').attr( {src: imageDir } );
          $('#bookimage').show();
          $('#hiddenFormElements').removeClass('hidden');
          $("#priceSlider").slider('option', 'max', 1000);
      }
        //hide loader animation
        $('#addBookDialog').find('#ajaxLoaderImage').hide();
        
        //make addForSale button clickable again
        $('button:contains("AddBookForSale")').attr('disabled', '').css('color', '#2e6e9e');
    }
      
	});