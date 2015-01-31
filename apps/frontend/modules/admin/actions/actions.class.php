<?php

/**
 * admin actions.
 *
 * @package    switcharoo
 * @subpackage admin
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class adminActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  	$this->userType =$this->getUser()->getAttribute("credential");
  	$this->userName =  $this->getUser()->getAttribute('name');
  }
  
  public function executeAllBooksInStockList(sfWebRequest $request)
  {
  	$this->userType =$this->getUser()->getAttribute("credential");
  	$this->userName =  $this->getUser()->getAttribute('name');
  	
 	$c = new Criteria();

      

      $myBooks = BooksforsalePeer::doSelect($c);
      
      //create array to store book info from bookDB table
      $bookList = array();
      
      //traversera böckerna som hittades och hämta mer info
      foreach($myBooks as $book)
      {
          //hämta bokens info ifrån bookDB
          $bookList[] = BookPeer::retrieveByPK($book->getIsbn10());
      }

      
      //check if any books were found, if not send a note to the user
      if(count($bookList)==0)
      {
        $this->SearchInfo = "Systemet innehåller inga böcker";
      } elseif(count($bookList)==1) {
        $this->SearchInfo = "Det finns en bok i systemet.";
      } else {
        $this->SearchInfo = "Hittade ".count($bookList)." böcker i systemet.";
      }
      
      $this->BookList = $bookList;
  }
  
  
    public function executeUserList(sfWebRequest $request)
  {
  	$this->userType =$this->getUser()->getAttribute("credential");
  	$this->userName =  $this->getUser()->getAttribute('name');
  	
  	      $c = new Criteria();
          $c->add(UserPeer::CREDENTIALS, "admin", Criteria::NOT_EQUAL);
          $this->userList = UserPeer::doSelect($c);
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
  
  public function executeRemoveUser($request)
  {	
  	
  	$userId  = $request->getParameter('userID');
  	$user = UserPeer::retrieveByPk($userId);
	$user->delete();
		return sfView::NONE;
  }
  
  public function executeAllCommentsList($request)
  {	
  	$this->userType =$this->getUser()->getAttribute("credential");
  	$this->userName =  $this->getUser()->getAttribute('name'); 
  		$c = new Criteria();
        $c->addJoin(CommentPeer::USER_ID, UserPeer::ID);
  		$this->commentList =  CommentPeer::doSelectJoinUser($c);
  	
  }
  
  public function executeManageCategorys($request)
  {	
  	  	$this->userType =$this->getUser()->getAttribute("credential");
  		$this->userName =  $this->getUser()->getAttribute('name'); 
  		$c = new Criteria();
  		$this->categoryList =  CategoryPeer::doSelect($c);
  		
  	//	$c = new Criteria();
    //    $this->userList = UserPeer::doSelect($c);
  	
  }
  
  public function executeAddCategory($request)
  {	
  	//	$categoryName  = $request->getParameter('categoryName');
	//	$myCategory = new Category();
	//	$myCategory->setName($categoryName);
		
		$this->form = new CategoryForm();
		
	//	echo $myCategory->getName();
	//	return sfView::NONE;
  }
  
    public function executeInsertCategory($request)
  {	
  		$categoryName  = $request->getParameter('categoryName');
		$myCategory = new Category();
		$myCategory->setName($categoryName);

		$myCategory->save();
		
		echo "#".$myCategory->getName()."#";
		return sfView::NONE;
  }
  
    public function executeRemoveCategory($request)
  {	
  	
  	$categoryId  = $request->getParameter('categoryId');
  	
  	 $category = CategoryPeer::retrieveByPk($categoryId);
	 $category->delete();
		return sfView::NONE;
  }
 
   public function executeAddBookToCategory($request)
  {	
  	 $categoryId = $request->getParameter('categoryId');
  	 $isbn10 = $request->getParameter('isbn10');
  	 
	 	$bookInCategory = new Bookincategory();
		$bookInCategory->setIsbn10($isbn10);
		$bookInCategory->setCategoryId($categoryId);
		$bookInCategory->save();
  		return sfView::NONE;
  }
 
}
