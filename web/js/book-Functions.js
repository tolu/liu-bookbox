  
	$(function bookFunctions() {
  
    //hide ajax loader animation
    $('.ajax-loader-image').hide();
    
    /*******************************
       BIND SOM FUNCTIONS TO EVENTS
    ********************************/
    
    //visa information
    $('.BookDetailsBtn').live('click', displayBookInfo);
    $('.BookSellerBtn').live('click', displaySellerDetails);
    $('.BookCommentBtn').live('click', displayComments);
    //ta bort ur kundvagnen
    $('.removeIcon').live('click', removeFromCart);
    //lägg till i kundvagnen
    $('.addToCartFromSellerList').live('click', addToCartViaClick);
    //ändra mellan ikonvy och listvy för böcker
    $('.displayStyleBtn').live('click', toggleBookView);
    //sök på authors via länk
    $('.authorSearchLink').live('click', searchForAuthor);
    
    /*******************************************************************
      DIALOGRUTAN - initieras i shared/_searchResult och i public/_home
    ********************************************************************/
   
   /*********************************************
      show more info when user clicks "i" button
    **********************************************/
    function displayBookInfo() {
      //set title of dialog box
      $('#infoBox').dialog('option', 'title', 'Detaljer om boken');
      
      //get book info
      var bookInfo = $(this).parent().html();
      
      //set book details to null and open dialog
      $('#infoBoxContent').html('');
      $('#infoBoxContent').html(bookInfo);
      $('#infoBoxContent .bookInfo').children().clone().appendTo('#infoBoxContent .bookContent');
      $('#infoBoxContent .bookInfo').remove();
      
      $('#infoBox').dialog('open');
      
      //get the latest price from adlibris
      getUpdatedPrice('#infoBoxContent', $(this).parent().attr('id'));
      
      return false;
    }
    
    /**********************************************
     show info about sellers when clicking the "cart-icon"
    **********************************************/
    function displaySellerDetails() {
      
      //set title of dialog box
      $('#infoBox').dialog('option', 'title', 'Säljare');
      
      $('#infoBoxContent').html(''); //clears box
      $('#infoBoxContent').append('<span class="sellerInfoHeader"><span class="name">Säljare</span><span class="price">Pris</span><span class="skick">Bokens skick</span><span>');
      
      $(this).parent().find('.bookSellerInfo').children().clone(true).appendTo('#infoBoxContent');
      $('#infoBoxContent .moved-to-cart').hide();
      
      //show book quality for each book
      $('#infoBoxContent .book-quality-bar').each(function(){
          $(this).progressbar({ value: $(this).attr('value')*10});
      });
      
      $('#infoBox').dialog('open');
      
      //get latest adlibris price
      getUpdatedPrice('#infoBoxContent', $(this).parent().attr('id'));
      
      return false;
    }
    
   //Display all comments fo the selected book
   function displayComments(){
      
      //get book info
      var bookInfo = $(this).parent().html();
      var commentPath = $(this).attr("href");
      //set book details to null and open dialog
      $('#infoBoxContent').html('');
      $('#infoBoxContent').load(commentPath);
      $('#infoBox').dialog('open');
      
      return false;
   	}
    
    /************************************************
    DRAG-N-DROP  (.book initieras i shared/_bookList)
    *************************************************/
    //add to cart by dropping in cart area
    $("#shoppingCart").droppable({
          accept: '.ui-draggable',
          tolerance: 'touch',
          activeClass: 'ui-state-hover',
          drop: function(event, ui) {
            dropInCart(ui.draggable);
          }
    });
    
    function dropInCart($item)
    {
      
      //sätt lite klasser på objektet så att det blir lättmanipulerat
      var $sellerInfo = $item.find('.bookSeller:not(.moved-to-cart)').eq(0);
      $sellerInfo.addClass('last-clicked');
      moveToCart();
    }
    
    /************************
         KÖPFUNKTIONALITET
    *************************/
    //add to cart via BOOK DETAILS DIALOG
    function addToCartViaClick() {
      var id = $(this).parent().attr('id');
      
      //sätt lite klasser så att det blir lätt att gömma och hitta senare
      $('.book .bookSeller[id="'+id+'"]:hidden').eq(0).addClass('last-clicked');
      
      //empty and close dialog
      $('#infoBox').dialog('close');
      $('#infoBoxContent').children().remove();
      moveToCart();
      
      return false;
    }
    
    
    /************************************************
      FUNKTIONER FÖR ATT FLYTTA BÖCKER TILL KUNDVAGN
    *************************************************/
    function moveToCart()
    {
        //spara klickad bok i variabel
        var $book = $('.last-clicked');
        $book.removeClass('last-clicked');
        
        
        //hämta bokens id och isbn
        var id = $book.attr('id');
        var isbn = $book.parent().parent().attr('id');
        
        //sätt klassen moved-to-cart
        $('*[id='+id+']').addClass('moved-to-cart');
        
        //clone book so we can add clone to cart
        $cartBook = $book.parent().parent().clone();
        
        //remove all unimportant seller info from cloned book
        $cartBook.find('.bookSeller[id!='+id+']').remove();
        //remove comments button
        $cartBook.find('.BookCommentBtn').remove();
        
        //change title length to fit cart size
        var title = $cartBook.find('h3').html();
        if(title.length > 40)
        {
          title = title.substring(0,40)+'...';
          $cartBook.find('h3').html(title);
        }
        
        //insert some price information
        $cartBook.find('h3').after('<span class="priceTag"> '+$cartBook.find('.bookSeller').attr('price')+' kr</span>');
        
        //change some classes for the cloned book
        $cartBook.removeClass('book');
        $cartBook.removeClass('list-book');
        $cartBook.addClass('bookInList');
        
        var booksStillForSale = $book.siblings(':not(.moved-to-cart)').length;
        if(booksStillForSale == 0)
        {
            //hide book(s) if it was the last available
            $('*[id="'+isbn+'"]').hide();
            
            //count down the number of available books
            $('*[id="'+isbn+'"]').find('.booksForSale').html(booksStillForSale);
            
            //move cloned book to cart
            $cartBook.appendTo('#shoppingCartContent');
            
        } else {
            //count down the number of available books
            $('*[id="'+isbn+'"]').find('.booksForSale').html(booksStillForSale);
            
            //move cloned book to cart
            $cartBook.appendTo('#shoppingCartContent');
        }
        
        //ta bort klassen last-clicked
        $('.last-clicked').removeClass('last-clicked');
        
        shoppingCartChanged("add", id);
    }
    
    /**************************
      TA BORT BOK UR KUNDVAGN
    ***************************/
    
    //bind click event to removeIcon
    function removeFromCart(){
        //get isbn and id of book in cart
        var id   = $(this).nextAll('.bookSellerInfo').children().attr('id');
        var isbn = $(this).nextAll('.bookSellerInfo').children().attr('isbn');
        
        //kolla om vi är kvar i searchresult fönstret
        if($('#content #searchResult').length == 1)
        {
          if($(this).hasClass('populatedByPHP'))
          {
              //add info to bookSellerInfo
              $('#searchResult #'+isbn).find('.bookSellerInfo').prepend($(this).next().html());
              
              //räkna upp antalet böcker
              var nob = parseInt($('#searchResult #'+isbn).find('.booksForSale').html());
              $('#searchResult #'+isbn).find('.booksForSale').html(nob+1);
          } 
          else 
          {
            //remove class "moved-to-cart" from info in search result
            $('*[id='+id+']').removeClass('moved-to-cart');
            
            //kolla antalet tillgängliga böcker av samma sort
            var booksStillForSale = $('*[id='+id+']').eq(0).siblings().not('.moved-to-cart').length;
            
            //räkna upp antalet böcker
            $('*[id='+isbn+']').find('.booksForSale').html(booksStillForSale+1);
            if(booksStillForSale == 0)
            {
                //glöm inte att visa den gömda boken igen
                $('*[id='+isbn+']').show();
            }
          }
        } 
        
        //ta bort klonen i kundvagnen
        $(this).parent().remove();
        
        shoppingCartChanged("remove", id);
        return false;
    }
    
    /**************************
       NÄR KUNDVAGNEN ÄNDRAS
    ***************************/
    function shoppingCartChanged(type, bookId)
    {
        var totalPrice = 0;
        $('#shoppingCartContent').find('.bookSeller').each(function()
        {
            totalPrice += parseInt($(this).attr('price'));
        });
        $('#priceLabel').html('Totalpris: <span>'+totalPrice+':-</span>');
        
        //check out/in book
        $.post('student/checkOutBook',{ event: type, id : bookId });
    }
    
    /**************************
      ändra hur böckerna visas
    ***************************/
    function toggleBookView()
    {
      if($(this).children().eq(0).hasClass('my-thumb'))
      {
        $('.list-book').removeClass('list-book').addClass('book');
      } else {
        $('.book').removeClass('book').addClass('list-book');
      }
      
      return false;
    }
    
    /**************************
      sök efter förf. via länk
    ***************************/
    function searchForAuthor()
    {
      //display ajax loader animation
      $('#content').html($('#ajaxLoaderImage').clone().show().addClass('mongoBongo'));
      $('.mongoBongo').wrap('<div style="text-align:center;margin-top:4em;"></div>');
      $('#infoBox').dialog('close');
      
      //load search result into content
      $('#content').load($(this).attr('href'));
      return false;
    }
    
    /**************************************/
    /*get updated book price from adlibris*/
    /**************************************/
    function getUpdatedPrice(selector, isbn10)
    {
      //show loader animation
      var element = $('.ui-dialog-content:visible').find(selector);
      element.append($('#ajaxLoaderImage').clone().show().addClass('mongoBongo').css({'float':'left','clear':'left'}));
      //get price and append to selector
      $.post('/bookbox/web/shared/getPrice', {isbn : isbn10}, function(data){
          element.append('<h4 style="float:left;">Aktuellt pris på AdLibris: <span style="color:red;">'+data.price+' kr</span></h4>');
          $('.mongoBongo').remove();
      }, 'json');
    }
    
	});