<?php

/**
 * student actions.
 *
 * @package    switcharoo
 * @subpackage student
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class studentActions extends sfActions
{
	
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex()
  {
  	$this->userType =$this->getUser()->getAttribute("credential");
  	$this->userName =  $this->getUser()->getAttribute('name');

  }
  
  public function executeSearch($request)
  {
    $this->forward('shared', 'search');
  }
  
  public function executeSearchFieldResult($request)
  {	
  	$this->userType =$this->getUser()->getAttribute("credential");
  	$this->userName =  $this->getUser()->getAttribute('name'); 
  	
  	$isbn10  = $request->getParameter('isbn10');
  	$category  = $request->getParameter('category');
    $course  = $request->getParameter('course');
  	$title  = $request->getParameter('title');
  	$author  = $request->getParameter('title');
  	
  	$this->query = array('isbn10'=>$isbn10,'author'=>$author,'title'=>$title,'category'=>$category,'course'=>$course);
  }
  
  
  public function executeAddBook($request)
  {	
  	
	//put all bookinfo into an array and send away!
	$this->bookList = array( "isbn10"=> $request->getParameter('isbn10') );
	
	$this->bookList["isbn13"] = $request->getParameter('isbn13');
	$this->bookList["title"] = $request->getParameter('title');
	$this->bookList["authors"] = $request->getParameter('authors');
	$this->bookList["description"] = $request->getParameter('description');
	$this->bookList["imgUrl"] = $request->getParameter('imgUrl');
	$this->bookList["authors"] = $request->getParameter('authors');
	
  }
  
  public function executeProfile($request)
  {	

    $this->userType =$this->getUser()->getAttribute("credential");
    $userId = $request->getParameter('userID');
    
    $this->user = UserPeer::retrieveByPk($userId);
    
    if($this->user->getCredentials() == "teacher")
		{
			$this->redirect('teacher/profile?userID='.$userId);
		}
		
    $this->userName =  $this->getUser()->getAttribute('name');
		$this->loggedInId = $this->getUser()->getAttribute('loggedInId');
    
    $this->editable = false;
    
    if($this->getUser()->getAttribute('loggedInId') == $userId || $this->userType =="admin")
    {
      $this->editable = true;
    }	
  }
  
    public function executeEditProfile($request)
  {	

  		$this->userType =$this->getUser()->getAttribute("credential");
  		$userId = $request->getParameter('userID');
  		$this->userName =  $this->getUser()->getAttribute('name');
		$this->loggedInId = $this->getUser()->getAttribute('loggedInId');
  		
  		$this->editable = false;
  		
  		if($this->getUser()->getAttribute('loggedInId') == $userId   || $this->userType =="admin")
  		{
  			$this->editable = true;
  		}

  		$this->user = UserPeer::retrieveByPk($userId);

  }

   
  public function executeProfileContent($request)
  {	

  		$this->userType =$this->getUser()->getAttribute("credential");
  		$userId = $request->getParameter('userID');
  		$this->userName =  $this->getUser()->getAttribute('name');
		$this->loggedInId = $this->getUser()->getAttribute('loggedInId');
  		
  		$this->editable = false;
  		
  		if($this->getUser()->getAttribute('loggedInId') == $userId || $this->userType =="admin")
  		{
  			$this->editable = true;
  		}
  		

  		$this->user = UserPeer::retrieveByPk($userId);
  		
  		if($this->user->getCredentials() == "teacher")
		{
			$this->redirect('teacher/profile?userID='.$userId);
		}
  }
  
  
  public function executeAddUser($request)
  {	
  	$this->userType =$this->getUser()->getAttribute("credential");
	  	$this->userName =  $this->getUser()->getAttribute('name');
	  	
	  	$this->form = new UserForm();

	
  }
  public function executeAddBookForSale($request)
  {	
  	$this->userType =$this->getUser()->getAttribute("credential");
		$isbn = $request->getParameter('isbn10');
		$price = $request->getParameter('salePrice');
    $quality = $request->getParameter('quality');
    $kategoriID = $request->getParameter('kategori');
    
		$DBbook = BookPeer::retrieveByPK($isbn);
		
		if($DBbook)
		{
			
			$bookForSale = new Booksforsale();
			$bookForSale->setIsbn10($isbn);
			$bookForSale->setPrice($price);
      $bookForSale->setBookquality($quality);
			$bookForSale->setSellerId($this->getUser()->getAttribute('loggedInId'));
			$bookForSale->setAddedOn('now');
      $bookForSale->setIsCheckedOut(0); // set checked out to zero seconds, i.e => january 1 1970 00:00:00 GMT
			$bookForSale->save();
			
			$this->info = array('info'=> $DBbook->getTitle().' is now for sale' );
			
      //kolla om boken redan finns i kategorin, annar -> lägg till!
      if($kategoriID>0)
      {
        $c = new Criteria();
        $c->add(BookincategoryPeer::ISBN10, $isbn);
        $c->add(BookincategoryPeer::CATEGORY_ID, $kategoriID);
        $check = BookincategoryPeer::doSelect($c);
        if(count($check)==0)
        {
          $newBookInCategory = new Bookincategory();
          $newBookInCategory->setIsbn10($isbn);
          $newBookInCategory->setCategoryId($kategoriID);
          $newBookInCategory->save();
        }
        
      }
      
		} else {
			$this->info = array('info'=> $isbn.' something amiss' );
		}
    
		//return sfView::NONE;
  }
  
  //check out books when user puts them into cart
  public function executeCheckOutBook($request)
  {
    $bookId = $request->getParameter('id');
    $event = $request->getParameter('event');
    
    if($event == 'add')
    {
      $book = BooksforsalePeer::retrieveByPK($bookId);
      $book->setIsCheckedOut(date('U'));
      $book->setCheckedOutBy($this->getUser()->getAttribute('loggedInId'));
      $book->save();
      echo 'book checked out!';
    }
    if($event == 'remove')
    {
      $book = BooksforsalePeer::retrieveByPK($bookId);
      $book->setIsCheckedOut(date('U')-30*60);
      $book->save();
      echo 'book checked out time reverted!';
    }
    
    return sfView::NONE;
  }
  
  //buy some books why dont ya?
  public function executeBuyBooks($request)
  {
      $user = UserPeer::retrieveByPK($this->getUser()->getAttribute('loggedInId'));
  
      $saleList = array();
      $bookList = array();
      $sellerName = array();
      $sellerEmail = array();
      
      $booksToBuy = $request->getParameter('bookId');
      foreach($booksToBuy as $bookId)
      {
          $book = BooksforsalePeer::retrieveByPK($bookId);
          
          //lägg till i sales tabellen
          $sale = new Sales();
          $sale->setIsbn10(   $book->getIsbn10() );
          $sale->setPrice(    $book->getPrice() );
          $sale->setSellerId( $book->getSellerId() );
          $sale->setBuyerId(  $user->getId() );
          $sale->setSoldOn(   'now' );
          $sale->setAddedOn(  $book->getAddedOn() );
          $sale->save();
          
          //remove from Books_for_sale
          $book->delete();
          
          //get the person selling the book
          $seller = UserPeer::retrieveByPK($book->getSellerId());
          
          //add info to arrays
          $saleList[] = $sale;
          $bookList[] = BookPeer::retrieveByPK($book->getIsbn10());
          $sellerName[] = $seller->getFname().' '.$seller->getLname();
          $sellerEmail[] = $seller->getEmail();
      }
      
      //forward some info
      $this->userEmail = $user->getEmail();
      $this->userName = $user->getFname().' '.$user->getLname();
      $this->nrOfSales = count($booksToBuy);
      $this->saleList = $saleList;
      $this->bookList = $bookList;
      $this->sellerName = $sellerName;
      $this->sellerEmail = $sellerEmail;
      
  }
  
  public function executeEditMyBookPrice($request)
  {
    $bookid = $request->getParameter('id');
    $price = $request->getParameter('newPrice');
    
    $book = BooksforsalePeer::retrieveByPK($bookid);
    $book->setPrice($price);
    $book->save();
    
    return sfView::NONE;
  }
  public function executeRemoveBookforsale($request)
  {
    $bookid = $request->getParameter('id');
    $book = BooksforsalePeer::retrieveByPK($bookid);
    $book->delete();
    
    return sfView::NONE;
  }
}
