<?php

/**
 * student actions.
 *
 * @package    switcharoo
 * @subpackage student
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class adminComponents extends sfComponents
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeEditAccountMenu()
  {
  	$this->menuElements = array('Manage Accounts');
  }
  
  public function executeRightContentWidgets()
  {

  }
  
      public function executeCategoryListWidget($request)
  {

	//$userId = $this->getUser()->getAttribute('loggedInId');
	
			$c = new Criteria();


			$this->categoryList = CategoryPeer::doSelect($c);

  }
}
