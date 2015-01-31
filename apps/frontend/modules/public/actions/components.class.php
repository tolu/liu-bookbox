<?php

/**
 * menu actions.
 *
 * @package    switcharoo
 * @subpackage menu
 * @author     Your name here
 * @version    SVN: $Id: components.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class publicComponents extends sfComponents
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
 public function executeHome()
 {
    //get some newly added books
    $c = new Criteria();
    $c->setDistinct();
    $c->addJoin(BooksforsalePeer::ISBN10, BookPeer::ISBN10);
    $c->addDescendingOrderByColumn(BooksforsalePeer::ADDED_ON);
    $c->setLimit(10);
    $this->newlyAddedBooks = BookPeer::doSelect($c);
    
    // TODO : kolla så att de inte är utcheckade???
		
    //get popular books from sales
    $c3 = new Criteria();
    $c3->addJoin(SalesPeer::ISBN10, BookPeer::ISBN10); //joina med books
    $c3->addDescendingOrderByColumn(SalesPeer::ISBN10);//sortera efter hur många försäljningar som gjorts
    $c3->addGroupByColumn(SalesPeer::ISBN10);          //gruppera efter isbn för att slippa dubletter
    $c3->setLimit(10);
    $this->popularSales = BookPeer::doSelect($c3);
    
    //get possible bargains
    $c2 = new Criteria();
    $c2->addJoin(BooksforsalePeer::ISBN10, BookPeer::ISBN10);
    $c2->add(BooksforsalePeer::IS_CHECKED_OUT,0);
    //$bargains->addGroupByColumn(BooksforsalePeer::ISBN10);
    $c2->setLimit(10);
    $this->possibleBargains = BookPeer::doSelect($c2);
 }
}
