<?php

/**
 * student actions.
 *
 * @package    switcharoo
 * @subpackage student
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class studentComponents extends sfComponents
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeEditAccountMenu()
  {
  	$this->menuElements = array();
  	$this->loggedInId = $this->getUser()->getAttribute('loggedInId');
    
    //get the available categories
    $this->categories = CategoryPeer::doSelect(new Criteria());
    
  }
  
  public function executeRightContentWidgets()
  {
  	
  }
  
  public function executeUserSellList($request)
  {
  	$userID = ($request->getParameter('userID'));

  	
  	$c = new Criteria();
 	

    if(isset($userID ) )
    {
      $c->add(BooksforsalePeer::SELLER_ID, $userID);
      $c->addDescendingOrderByColumn(BooksforsalePeer::ADDED_ON);
      $c->addJoin(BookPeer::ISBN10, BooksforsalePeer::ISBN10);
    }

    $myBooks = BooksforsalePeer::doSelectJoinBook($c);
    $this->myBooks = $myBooks;
  	
  }
  
  //list of books that the user has sold
  public function executeUserBoughtList($request)
  {
  	$userID = ($request->getParameter('userID'));
  	
  	$c = new Criteria();
    if(isset($userID ) )
    {
      $c->add(SalesPeer::BUYER_ID, $userID);
      $c->addJoin(BookPeer::ISBN10, SalesPeer::ISBN10);
    }

    $myBooks = SalesPeer::doSelectJoinbook($c);
    $this->myBooks = $myBooks;
  	
    
    $sellerNames = array();
    foreach($myBooks as $book)
    {
      $sid = $book->getSellerId();
      $usr = UserPeer::retrieveByPK($sid);
      $name = $usr->getFname().' '.$usr->getLname();
      $sellerNames[] = $name;
    }
    $this->sellerNames = $sellerNames;
    $this->nr = count($myBooks);
  }
}
