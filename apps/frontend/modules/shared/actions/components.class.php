<?php

/**
 * menu actions.
 *
 * @package    switcharoo
 * @subpackage menu
 * @author     Your name here
 * @version    SVN: $Id: components.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class sharedComponents extends sfComponents
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeMenuItems()
  {
  		//generates a categorylist 
  		$c = new Criteria();
		$this->categoryMenuItems = CategoryPeer::doSelect($c);
  	
  		//generates a List of course litterature containing course litterature that are in the system
		$c = new Criteria();
		$c->addGroupByColumn(CourselitteraturePeer::COURSE_CODE);
		 			//$c->addJoin(BooksforsalePeer::ISBN10, CourselitteraturePeer::ISBN10); //add this row to exclude corses without course litterature
			$courseList = CourselitteraturePeer::doSelect($c);
		    
		    $courseMenuItems= array();
		    
		    foreach($courseList as $course)
		    {
		    	$courseMenuItems[] = $course->getCourseCode();		    	
		    }
		 
		    $this->courseMenuItems = $courseMenuItems;
		    
		    if($this->getUser()->getAttribute('credential') !="")
		    {
		    	$this->myUserType = $this->getUser()->getAttribute('credential');
		    }
		    else
		    {
		    	$this->myUserType = "public";
		    }
		
  }
  
  public function executeSendMail($request)
  {
    //get the parameters needed
    $to      = $this->to;
    $toName  = $this->toName;
    $subject = $this->subject;
    $message = $this->message;
    
    //send an email using the Zend framework
    ProjectConfiguration::registerZend();
    
    $config = array('auth' => 'login', 'ssl' => 'ssl', 'username' => 'sales.bookbox@gmail.com', 'password' => 'tddd272009');
    $transport  = new Zend_Mail_Transport_Smtp('smtp.gmail.com', $config);
    $mail = new Zend_Mail();
    $mail->setFrom('sales.bookbox@gmail.com', 'BookBox');
    
    $mail->addTo($to, $toName);
    $mail->setSubject(utf8_decode($subject));
    $mail->setBodyHtml(utf8_decode($message));
    
    $mail->send($transport);
    
    return sfView::NONE;
  }
  
  public function executeSearchField($request)
  {

  }
  
  public function executeInitializeInfoBox($request)
  {

  }
  
  // handles the input content from the searchField and creates a wellformed query
  public function executeSearchFieldResult($request)
  {
  	$this->userType = $this->getUser()->getAttribute("credential");
 	$parsedSearchResult= array();
 	$searchString = $request->getParameter('searchString');
 	
 	$this->searchType = $request->getParameter('searchType');
 	$searchString = str_replace("_", " ", $searchString);
 	$semicolonSplittedString = explode(";", $searchString);			
 		
	$searchStringLength = count($semicolonSplittedString);
 	
 	
 	//if the string contains specified search parameters do this
 	if($searchStringLength > 1)
 	{
 		//explode the string on token ":" and place the parameters in an array
 		for($i=0;$i<count($semicolonSplittedString)-1;$i++)
 		{
 			$colonSplittedString = explode(":", $semicolonSplittedString[$i]);
 			$parsedSearchResult[$colonSplittedString[0]] =$colonSplittedString[1];
 		}

		//construct  a criteria from the advanced query
	 	$c = new Criteria();
	
	 	if( isset($parsedSearchResult['isbn']))
	 	{
	
	 		$isbn = $parsedSearchResult['isbn'];
	 		
			$c->add(BooksforsalePeer::ISBN10, $isbn.'%', Criteria::LIKE);
			$c->addJoin(BooksforsalePeer::ISBN10, BookPeer::ISBN10);
			$c->addGroupByColumn(BooksforsalePeer::ISBN10);
	 	}
	 	if( isset($parsedSearchResult['title']) )
	 	{
	
	 		$title = $parsedSearchResult['title'];
	 		
			$c->addJoin(BooksforsalePeer::ISBN10, BookPeer::ISBN10);
			$c->add(BookPeer::TITLE, '%'.$title.'%', Criteria::LIKE);
			$c->addGroupByColumn(BooksforsalePeer::ISBN10);
	 	}
	 	
		$myBooks = BookPeer::doSelect($c);
 	}
 	
 	//if the string is'n parsed do this
 	else
 	{
 		$myBooks = array();	
	 	$c = new Criteria();
	 		$c->addJoin(BooksforsalePeer::ISBN10, BookPeer::ISBN10);
			$c->add(BookPeer::TITLE, '%'.$searchString.'%', Criteria::LIKE);
			$c->addGroupByColumn(BooksforsalePeer::ISBN10);
		$myBooks = BookPeer::doSelect($c);
		
		$d = new Criteria();
			$d->add(BooksforsalePeer::ISBN10, $searchString.'%', Criteria::LIKE);
			$d->addJoin(BooksforsalePeer::ISBN10, BookPeer::ISBN10);
			$d->addGroupByColumn(BooksforsalePeer::ISBN10);

		$myBooks = array_merge((array)$myBooks, (array)BookPeer::doSelect($d));

 		//TODO: gör selecten distinct så att en bok bara tas med om den inte finns i föregåendeselect 
 	}
	$this->BookList = $myBooks;

  }
  

  public function executeFooterContent()
  {
    

  }  
  
  public function executeShoppingCart()
  {
    

  } 
  
  public function executeSearchResult($request)
  {
      //get the query parameters
      $course = ($request->getParameter('course'));
      $category = ($request->getParameter('category'));
      $author = ($request->getParameter('author'));
      
      //build the search criterias
      $c = new Criteria();
      
      //extend with query parameters, if they exist
      if($course != "")
      {
        $c->addJoin(BookPeer::ISBN10, CourselitteraturePeer::ISBN10);
        $c->add(CourselitteraturePeer::COURSE_CODE, $course);
      }
      if($category != "")
      {
        //hämta id för kategori med namn $category
        $cat = new Criteria();
        $cat->add(CategoryPeer::NAME, $category);
        $categoryID = CategoryPeer::doSelect($cat);
        
        //om det fanns någon sådan kategori:
        if(count($categoryID)>0)
        {
          $c->addJoin(BookPeer::ISBN10, BookincategoryPeer::ISBN10);
          $c->add(BookincategoryPeer::CATEGORY_ID, $categoryID[0]->getID());
        }
      }
      if($author != "")
      {
        $author = str_replace('+', ' ', $author);
        $c->addJoin(BookPeer::ISBN10, AuthorPeer::ISBN10);
        $c->add(AuthorPeer::NAME, $author);
      }
      
      //select books from DB
      $this->BookList = BookPeer::doSelect($c);
  } 
  
  public function executeBookList()
  {
    //check users credentials
    $is_a_teacher_or_admin = $this->getUser()->hasCredential(array('teacher', 'admin'), false);
    $this->is_a_student = $this->getUser()->hasCredential('student');
    $this->can_comment = $this->getUser()->hasCredential(array('student', 'teacher', 'admin'), false);
    
    $allBooks = array();
    $books = $this->BookList;
    foreach($books as $book)
    {
        // array to store all book info
        $allBookInfo = array();
        //array for authors
        $authors = array();
        //array to put sellers prices and book-id's in!
        $varInfo = array();
        
        //get book isbn used for all searches
        $isbn = $book->getISBN10();
        
        //get authors and put in array
        //****************************
        $c = new Criteria();
        $c->add(AuthorPeer::ISBN10, $isbn);
        $tmpAuthors = AuthorPeer::doSelect($c);
        foreach($tmpAuthors as $tmp)
        {
            //add authors to author array
            $authors[] = $tmp->getName();
        }
        
        //bool för att bara visa köpbara böcker för studenter
        $book_in_stock = true;
        
        if(!$is_a_teacher_or_admin)
        {
          //get sellers and put in array
          //****************************
          $c = new Criteria();
          $c->add(BooksforsalePeer::ISBN10, $isbn); //välj bara ut rätt böcker
          $c->add(BooksforsalePeer::IS_CHECKED_OUT, date('U')-30*60, Criteria::LESS_THAN); // bara outcheckade böcker
          $c->addAscendingOrderByColumn(BooksforsalePeer::PRICE); //se till att billigast hamnar först
          $tmpBooksforsale = BooksforsalePeer::doSelect($c);
          
          if(count($tmpBooksforsale)==0)
          {
            $book_in_stock = false;
          }
          
          foreach($tmpBooksforsale as $tmp)
          {
              $tmpVarInfo = array();
              //get user from users
              $userId   = $tmp->getSellerId();
              $user = UserPeer::retrieveByPK($userId);
              //add seller name
              $tmpVarInfo['seller'] = $user->getFname().' '.$user->getLname();
              //add book_for_sale id
              $tmpVarInfo['bookId']  = $tmp->getId();
              //add different prices
              $tmpVarInfo['price'] = $tmp->getPrice();
              //add different qualyties
              $tmpVarInfo['quality'] = $tmp->getBookquality();
              $varInfo[] = $tmpVarInfo;
          }
        }
        
        if($book_in_stock)
        {
          $allBookInfo['book'] = $book;
          $allBookInfo['authors'] = $authors;
          $allBookInfo['moreInfo'] = $varInfo;
          $allBooks[] = $allBookInfo;
        }
    }
    
    $this->BookList = $allBooks;
  } 
  
  public function executeGetProjectName()
  {
	if(preg_match( "/windows/"  , strtolower($_SERVER['HTTP_USER_AGENT'])))
	{
		$test =explode( "\\" ,sfConfig::get('sf_root_dir'));
	} else {
		$test =explode( "/" ,sfConfig::get('sf_root_dir'));
	}
  	$this->projectName = $test[count($test)-1];

  }
  public function executeAddBook($request)
    {	  	  
	//get some variables
 	$isbn10 = $this->isbn10;
 	$isbn13 = $this->isbn13;
 	$title = $this->title;
	$authors = explode(',', $this->authors); //dela upp författarna

	//save book to DB
	$newBook = new Book();
	$newBook->setIsbn10($isbn10);
	$newBook->setIsbn13($isbn13);
	$newBook->setTitle($title);
	$newBook->setDescription($this->description);
	$newBook->save();
	
	//copy image to local directory from adlibris
	$src = imagecreatefromjpeg($this->imgUrl);
	$path = sfConfig::get('sf_upload_dir').'/books/';
	if(is_writeable($path)){
		imagejpeg($src, $path.$this->isbn10.'.jpg',100);
		imagedestroy($src);
	}


	//save authors to DB
	$nr = count($authors);
	$i=1;
	foreach ( $authors as $author )
	{
		if($i < $nr) // sista fältet är alltid tomt, så det läser vi bort
		{
			$bookAuthor = new Author();
			$bookAuthor->setIsbn10($isbn10);
			$bookAuthor->setName($author);
			$bookAuthor->save();
		}
		$i++;
	}
  } 
  
  public function executeGetBookInfo($request)
  {
	//functionality for travering the html DOM
    include_once('simple_html_dom.php');
	
    $isbn = $request->getParameter('isbn');
    
    // Turn off all error reporting
    error_reporting(0);

    //create output to send back as json
    $bookinfo = array("success"=>'true');

    //some adlibris id´s and labels:
    $error_label = '#ctl00_main_frame_ctrlproduct_lblError';
    $title_label = '#ctl00_main_frame_ctrlproduct_lblProductTitle';
    $imageurl_label = '#ctl00_main_frame_ctrlproduct_imgProduct_ProductImageNotLinked';
    $descr_label = '#ctl00_main_frame_ctrlproduct_lblDescription';
    $author_label = '#ctl00_main_frame_ctrlproduct_ProductTable span[id^="ctl00_main_frame_ctrlproduct_rptAuthor_"]';
    $price_label = '.price';
    $isbn10_label = '#ctl00_main_frame_ctrlproduct_lblIsbn';
    $isbn13_label = '#ctl00_main_frame_ctrlproduct_lblIsbn13';

		// Create DOM from URL
		$html = file_get_html("http://www.adlibris.com/se/product.aspx?isbn=".$isbn); 
		

		// Check if the search was successful
		$exists = $html->find($error_label);
		if(!$exists)
		{
			//make sure that tha javascript knows the book is found
			$bookinfo["success"] = 'true';
			$bookinfo["info"] = 'found on AdLibris';

		// OK
			//get book isbn10 and isbn13
			$tmpISBN   = $html->find($isbn10_label, 0);
			
			$tmp       = explode(" ", $tmpISBN->innertext); //läser bort 'ISBN10: '
			$bookinfo["isbn10"] = utf8_encode($tmp[1]);
			
			$tmpISBN   = $html->find($isbn13_label, 0);
			$tmp       = explode(" ", $tmpISBN->innertext); //läser bort 'ISBN13: '
			$bookinfo["isbn13"] = utf8_encode($tmp[1]);
			
		// OK
			//get book title
			$title = $html->find($title_label, 0);
			$bookinfo["title"] = utf8_encode($title->innertext);

		// OK
			//get book image url
			$img_url = $html->find($imageurl_label, 0);
			$bookinfo["imgUrl"] = utf8_encode($img_url->src);


		// OK
			//get book description
			$html->find($descr_label.' site', 0)->innertext = '';
			$html->find($descr_label.' a', 0)->innertext = '';
			$description = $html->find($descr_label, 0);
			
			$bookinfo["description"] = utf8_encode($description->plaintext);

		// OK	
			//get book authors
			$authors = $html->find($author_label);
			$authTmp = '';
			foreach($authors as $author)
			{
				if(utf8_encode($author->plaintext) == 'Författare'){
					$authTmp .= $author->next_sibling()->plaintext.',';
				}
			}
			$bookinfo["authors"] = utf8_encode($authTmp);
			

		//OK
			//get book price
			$price = $html->find($price_label,0);
			$bookinfo["price"] = utf8_encode($price->plaintext);
		}
		else {
			$bookinfo["success"] = 'false';
			$bookinfo["info"] = 'Book not found on adlibris';
		}

		// clean up memory
			$html->clear();
			unset($html);
//	}	

	//pass findings forward to be echoed by the view
	$this->bookinfo = $bookinfo;
	
	
  }
  public function executePopulateCart()
  {
      $booksInCart = array();
      $details = array();
      
      $c = new Criteria();
      $c->add(BooksforsalePeer::CHECKED_OUT_BY, $this->getUser()->getAttribute("loggedInId"));
      $c->add(BooksforsalePeer::IS_CHECKED_OUT, date('U')-30*60, Criteria::GREATER_THAN);
      $books = BooksforsalePeer::doSelect($c);
      foreach($books as $book)
      {
        $booksInCart[] = $book;
        $details[] = BookPeer::retrieveByPK($book->getIsbn10());
      }
      
      $this->booksInCart = $booksInCart;
      $this->details = $details;
      if(count($books)==0)
      {
        return sfView::NONE;
      }
  }
}
