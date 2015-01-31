	$(function() {
		
    //click event handler for shopping cart
		$("#shoppingCartForm").submit( function(){
      
      //get all books in cart
      var booksInCart = $('#shoppingCartContent .bookInList');
      //go to check out!
      checkoutItems(booksInCart);
      
      $('#priceLabel span').html('0 :-');
      
			return false;
		});
		
    function checkoutItems($items) {
        //get URL to action : buyBooks
        var buyBooksURL = $('#shoppingCartForm').attr('action');
        
        //create array for saving
        var cartItemArray = new Array();
        
        //loop over books in cart
        $($items).each( function() {
            cartItemArray.push($(this).find('.bookSeller').attr('id'));
        });
        
        if(confirm('Säkert att du vill handla dessa böcker?')){
          //show ajax Loader bar
          $('#content').html( $('#ajaxLoaderImage').clone() );
          $('#content #ajaxLoaderImage').show();
          $('#content #ajaxLoaderImage').css({'margin' : '7em 20em'});
      
          //remove items from cart
          $("#shoppingCartContent").html('');
        
          //send isbn of all books in cart
          $("#content").load(buyBooksURL, { 'bookId[]': cartItemArray },'html');
        }
		}

	});